<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Util;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\InventoryCatalog\Model\ResourceModel\AddStockDataToCollection;

class ProductFromConfig
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder,
        private ProductCollectionFactory $productCollectionFactory,
        private AddStockDataToCollection $addStockDataToCollection
    ) {
    }

    public function execute(array $config): ProductInterface
    {
        if (isset($config['sku'])) {
            try {
                return $this->productRepository->get((string)$config['sku']);
            } catch (NoSuchEntityException $e) {
            }
        }

        if (isset($config['id'])) {
            try {
                return $this->productRepository->getById((int)$config['id']);
            } catch (NoSuchEntityException $e) {
            }
        }


        $collection = $this->productCollectionFactory->create();

        $collection->addAttributeToSelect('*');
        $collection->joinField(
            'is_in_stock',
            'cataloginventory_stock_item',
            'is_in_stock',
            'product_id=entity_id',
            '{{table}}.stock_id=1',
            'left'
        );

        $collection->addFieldToFilter('is_in_stock', 1);
        $collection->setPageSize(1);

        if ($collection->getSize() > 0) {
            /** @var ProductInterface $product */
            $product = $collection->getFirstItem();
            return $product;
        }

        $this->searchCriteriaBuilder->addSortOrder(new SortOrder(['attribute' => 'entity_id', 'direction' => 'ASC']));
        $this->searchCriteriaBuilder->setCurrentPage(1);
        $this->searchCriteriaBuilder->setPageSize(1);
        $results = $this->productRepository->getList($this->searchCriteriaBuilder->create());
        $items = $results->getItems();
        if (count($items)> 0) {
            return array_shift($items);
        }

        throw new NoSuchEntityException(__('No product found.'));
    }
}
