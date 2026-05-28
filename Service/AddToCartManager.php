<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Service;

use LokiCheckout\FunctionalTests\Util\ProductFromConfig;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\Manager;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Stdlib\Cookie\CookieSizeLimitReachedException;
use Magento\Framework\Stdlib\Cookie\FailureToSendException;
use Magento\Quote\Api\CartRepositoryInterface;
use LokiCheckout\Core\ViewModel\CheckoutState;
use LokiCheckout\DevProfiles\Profile\ProfileListing;
use LokiCheckout\DevProfiles\Service\ProfileManager;

class AddToCartManager
{
    public function __construct(
        private CheckoutSession $checkoutSession,
        private CartRepositoryInterface $cartRepository,
        private ProductRepositoryInterface $productRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder,
        private ProductFromConfig $productFromConfig,
        private ProfileListing $profileListing,
        private ProfileManager $profileManager,
        private CheckoutState $checkoutState,
        private Manager $messageManager,
        private SessionManagerInterface $sessionManager,
        private FormKey $formKey,
    ) {
    }

    /**
     * @throws NoSuchEntityException
     * @throws FailureToSendException
     * @throws CookieSizeLimitReachedException
     * @throws InputException
     * @throws LocalizedException
     */
    public function execute(array $config = []): void
    {
        $this->sessionManager->start();
        $this->formKey->getFormKey();

        $quote = $this->checkoutSession->getQuote();
        $quote->getId();

        $product = $this->getProduct();
        $productQty = isset($config['qty']) ? $config['qty'] : 1;
        $quote->addProduct($product, (float)$productQty);

        $this->cartRepository->save($quote);

        $this->checkoutSession->setQuoteId($quote->getId());
        $this->checkoutSession->replaceQuote($quote);
        $this->checkoutState->setQuoteId((int)$quote->getId());
        $this->checkoutState->setQuote($quote);

        if (isset($config['profile'])) {
            $profile = $this->profileListing->getProfileByCode($config['profile']);
            $this->profileManager->switch($profile);
        }

        $quote->setTotalsCollectedFlag(false);
        $quote->collectTotals();
        $this->cartRepository->save($quote);

        $message = __('Product "%1" has been added to your cart.', $product->getName());
        $this->messageManager->addSuccessMessage($message);
    }

    private function getProduct(): ProductInterface
    {
        $this->searchCriteriaBuilder->addSortOrder(new SortOrder(['field' => 'entity_id', 'direction' => 'ASC']));
        $this->searchCriteriaBuilder->setCurrentPage(1);
        $this->searchCriteriaBuilder->setPageSize(1);
        $results = $this->productRepository->getList($this->searchCriteriaBuilder->create());
        $items = $results->getItems();
        return array_shift($items);
    }
}
