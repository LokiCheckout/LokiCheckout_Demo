<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Controller\Index;

use Exception;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use LokiCheckout\Demo\Service\AddToCartManager;
use Magento\Framework\Controller\Result\RedirectFactory;
class Addtocart implements HttpGetActionInterface
{
    public function __construct(
        private RequestInterface $request,
        private AddToCartManager $addToCartManager,
        private RedirectFactory $redirectFactory
    ) {
    }

    public function execute()
    {
        try {
            $this->addToCartManager->execute($this->request->getParams());
        } catch (Exception $e) {
        }


        return $this->redirectFactory->create()->setUrl('/checkout');
    }
}

