<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Plugin;

use Magento\Checkout\Model\Session as CheckoutSession;
use Yireo\LokiCheckout\Config\Config;

class UpdateThemeFromConfigPlugin
{
    public function __construct(
        private readonly CheckoutSession $checkoutSession,
    ) {
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
