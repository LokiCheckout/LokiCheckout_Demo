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

    public function afterGetTheme(Config $subject, string $result): string
    {
        $sessionTheme = (string)$this->checkoutSession->getCurrentTheme();
        if (!empty($sessionTheme)) {
            return $sessionTheme;
        }

        return $result;
    }
}
