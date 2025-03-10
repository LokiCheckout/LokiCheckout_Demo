<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Plugin;

use Magento\Checkout\Model\Session as CheckoutSession;
use Yireo\LokiCheckout\Config\Config;

class OverrideConfigFromSessionPlugin
{
    public function __construct(
        private readonly CheckoutSession $checkoutSession,
    ) {
    }

    public function afterGetGridLayout(Config $subject, string $result): string
    {
        $gridLayout = (string)$this->checkoutSession->getCurrentGridLayout();
        if (!empty($gridLayout)) {
            return $gridLayout;
        }

        return $result;
    }

    public function afterGetTheme(Config $subject, string $result): string
    {
        $sessionTheme = (string)$this->checkoutSession->getCurrentTheme();
        if (!empty($sessionTheme)) {
            return $sessionTheme;
        }

        return $result;
    }
}
