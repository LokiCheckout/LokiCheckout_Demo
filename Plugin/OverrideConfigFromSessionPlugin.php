<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Plugin;

use LokiCheckout\Core\Config\Config;
use LokiCheckout\Core\Config\XmlConfig;
use LokiCheckout\Demo\Config\Config as DemoConfig;
use Magento\Checkout\Model\Session as CheckoutSession;

class OverrideConfigFromSessionPlugin
{
    public function __construct(
        private readonly CheckoutSession $checkoutSession,
        private readonly XmlConfig $xmlConfig,
        private readonly DemoConfig $demoConfig,
    ) {
    }

    public function afterGetGridLayoutName(Config $subject, string $result): string
    {
        if (false === $this->demoConfig->isEnabled()) {
            return $result;
        }

        $gridLayout = (string)$this->checkoutSession->getCurrentGridLayout();
        if (!empty($gridLayout) && array_key_exists($gridLayout, $this->xmlConfig->getGridLayouts())) {
            return $gridLayout;
        }

        return $result;
    }

    public function afterGetSkin(Config $subject, string $result): string
    {
        if (false === $this->demoConfig->isEnabled()) {
            return $result;
        }

        $currentSkin = (string)$this->checkoutSession->getCurrentSkin();
        if (!empty($currentSkin) && array_key_exists($currentSkin, $this->xmlConfig->getSkins())) {
            return $currentSkin;
        }

        return $result;
    }
}
