<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Component\Theme;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\App\ResponseFactory;
use Magento\Framework\UrlFactory;
use LokiCheckout\Core\Config\XmlConfig;
use Loki\Components\Component\ComponentContextInterface;

class ThemeContext implements ComponentContextInterface
{
    public function __construct(
        private readonly CheckoutSession $checkoutSession,
        private readonly XmlConfig $xmlConfig,
        private readonly ResponseFactory $responseFactory,
        private readonly UrlFactory $urlFactory,
    ) {
    }

    public function getXmlConfig(): XmlConfig
    {
        return $this->xmlConfig;
    }

    public function getResponseFactory(): ResponseFactory
    {
        return $this->responseFactory;
    }

    public function getUrlFactory(): UrlFactory
    {
        return $this->urlFactory;
    }

    public function getCheckoutSession(): CheckoutSession
    {
        return $this->checkoutSession;
    }
}
