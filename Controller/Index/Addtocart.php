<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Controller\Index;

use LokiCheckout\Demo\Config\Config;
use LokiCheckout\Demo\Service\AddToCartManager;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Message\ManagerInterface as MessageManager;
use Psr\Log\LoggerInterface;
use Throwable;

/**
 * POST-only: Magento validates the form key for POST requests to non-CsrfAware frontend actions
 */
class Addtocart implements HttpPostActionInterface
{
    private const MAX_QTY = 100;

    public function __construct(
        private RequestInterface $request,
        private AddToCartManager $addToCartManager,
        private RedirectFactory $redirectFactory,
        private Config $config,
        private MessageManager $messageManager,
        private LoggerInterface $logger,
    ) {
    }

    public function execute()
    {
        if (false === $this->config->isEnabled()) {
            throw new NotFoundException(__('Page not found.'));
        }

        try {
            $this->addToCartManager->execute($this->getConfigFromRequest());
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (Throwable $e) {
            $this->logger->error('LokiCheckout_Demo: Failed to add product to cart', ['exception' => $e]);
            $this->messageManager->addErrorMessage(__('Unable to add a product to your cart.'));
        }

        return $this->redirectFactory->create()->setPath('checkout');
    }

    private function getConfigFromRequest(): array
    {
        $config = [];

        $qty = $this->request->getParam('qty');
        if (is_scalar($qty) && is_numeric($qty)) {
            $config['qty'] = max(1, min(self::MAX_QTY, (int)$qty));
        }

        $profile = $this->request->getParam('profile');
        if (is_string($profile) && preg_match('/^[a-zA-Z0-9_-]{1,64}$/', $profile)) {
            $config['profile'] = $profile;
        }

        return $config;
    }
}
