<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Plugin;

use Magento\Checkout\Model\Session as CheckoutSession;
use LokiCheckout\Core\Config\Config;

class OverrideConfigFromSessionPlugin
{
    public function __construct(
        private readonly CheckoutSession $checkoutSession,
    ) {
    }

    public function afterGetGridLayoutName(Config $subject, string $result): string
    {
        $gridLayout = (string)$this->checkoutSession->getCurrentGridLayout();
        if (!empty($gridLayout)) {
            return $gridLayout;
        }

        return $result;
    }

    public function afterGetSkin(Config $subject, string $result): string
    {
        $currentSkin = (string)$this->checkoutSession->getCurrentSkin();
        if (!empty($currentSkin)) {
            return $currentSkin;
        }

        return $result;
    }
}
