<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Service;

use LokiCheckout\Demo\Util\ProductFromConfig;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\Escaper;
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
use RuntimeException;

class AddToCartManager
{
    public function __construct(
        private CheckoutSession $checkoutSession,
        private CartRepositoryInterface $cartRepository,
        private ProductFromConfig $productFromConfig,
        private ProfileListing $profileListing,
        private ProfileManager $profileManager,
        private CheckoutState $checkoutState,
        private Manager $messageManager,
        private SessionManagerInterface $sessionManager,
        private FormKey $formKey,
        private Escaper $escaper,
    ) {
    }

    /**
     * @param array{qty?: int, profile?: string} $config
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

        $product = $this->productFromConfig->execute([]);
        $productQty = isset($config['qty']) ? max(1, (int)$config['qty']) : 1;
        $result = $quote->addProduct($product, (float)$productQty);
        if (is_string($result)) {
            throw new LocalizedException(__($result));
        }

        $this->cartRepository->save($quote);

        $this->checkoutSession->setQuoteId($quote->getId());
        $this->checkoutSession->replaceQuote($quote);
        $this->checkoutState->setQuoteId((int)$quote->getId());
        $this->checkoutState->setQuote($quote);

        if (isset($config['profile']) && is_string($config['profile'])) {
            try {
                $profile = $this->profileListing->getProfileByCode($config['profile']);
                $this->profileManager->switch($profile);
            } catch (RuntimeException $e) {
                $this->messageManager->addWarningMessage(__('Unknown profile "%1"', $config['profile']));
            }
        }

        $quote->setTotalsCollectedFlag(false);
        $quote->collectTotals();
        $this->cartRepository->save($quote);

        $productName = $this->escaper->escapeHtml((string)$product->getName());
        $message = __('Product "%1" has been added to your cart.', $productName);
        $this->messageManager->addSuccessMessage($message);
    }
}
