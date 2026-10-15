<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Util;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\ResourceModel\Product\Collection as ProductCollection;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\Data\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

class ProductFromConfig
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ProductCollectionFactory $productCollectionFactory,
        private StoreManagerInterface $storeManager,
        private Visibility $visibility,
    ) {
    }

    /**
     * Only returns products that are enabled, visible, assigned to the current website and salable
     *
     * @throws NoSuchEntityException
     */
    public function execute(array $config): ProductInterface
    {
        $storeId = (int)$this->storeManager->getStore()->getId();

        if (isset($config['sku']) && is_scalar($config['sku'])) {
            $product = $this->loadAllowedProduct(
                fn () => $this->productRepository->get((string)$config['sku'], false, $storeId)
            );
            if ($product instanceof ProductInterface) {
                return $product;
            }
        }

        if (isset($config['id']) && is_numeric($config['id'])) {
            $product = $this->loadAllowedProduct(
                fn () => $this->productRepository->getById((int)$config['id'], false, $storeId)
            );
            if ($product instanceof ProductInterface) {
                return $product;
            }
        }

        $product = $this->getFirstAllowedProduct($this->getCollection(true));
        if ($product instanceof ProductInterface) {
            return $product;
        }

        $product = $this->getFirstAllowedProduct($this->getCollection(false));
        if ($product instanceof ProductInterface) {
            return $product;
        }

        throw new NoSuchEntityException(__('No product found.'));
    }

    private function getCollection(bool $filterByStockItem): ProductCollection
    {
        $store = $this->storeManager->getStore();

        $collection = $this->productCollectionFactory->create();
        $collection->setStoreId((int)$store->getId());
        $collection->addStoreFilter($store);
        $collection->addWebsiteFilter([(int)$store->getWebsiteId()]);
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter(ProductInterface::STATUS, Status::STATUS_ENABLED);
        $collection->addAttributeToFilter(
            ProductInterface::VISIBILITY,
            ['in' => $this->visibility->getVisibleInSiteIds()]
        );

        if ($filterByStockItem) {
            $collection->joinField(
                'is_in_stock',
                'cataloginventory_stock_item',
                'is_in_stock',
                'product_id=entity_id',
                '{{table}}.stock_id=1',
                'left'
            );
            $collection->addFieldToFilter('is_in_stock', 1);
        }

        $collection->setOrder('entity_id', Collection::SORT_ORDER_ASC);
        $collection->setPageSize(10);
        $collection->setCurPage(1);

        return $collection;
    }

    private function loadAllowedProduct(callable $loader): ?ProductInterface
    {
        try {
            $product = $loader();
        } catch (NoSuchEntityException $e) {
            return null;
        }

        return $this->isAllowed($product) ? $product : null;
    }

    private function getFirstAllowedProduct(ProductCollection $collection): ?ProductInterface
    {
        foreach ($collection as $product) {
            /** @var Product $product */
            if ($product->isSalable()) {
                return $product;
            }
        }

        return null;
    }

    private function isAllowed(ProductInterface $product): bool
    {
        if (false === $product instanceof Product) {
            return false;
        }

        if ((int)$product->getStatus() !== Status::STATUS_ENABLED) {
            return false;
        }

        if (false === in_array((int)$product->getVisibility(), $this->visibility->getVisibleInSiteIds(), true)) {
            return false;
        }

        $websiteId = (int)$this->storeManager->getStore()->getWebsiteId();
        if (false === in_array($websiteId, array_map('intval', $product->getWebsiteIds()), true)) {
            return false;
        }

        return $product->isSalable();
    }
}
