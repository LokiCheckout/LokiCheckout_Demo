<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Component\Theme;

use LokiCheckout\Core\Config\Config;
use Magento\Framework\Message\ManagerInterface as MessageManager;
use Loki\Components\Component\ComponentRepository;
use Loki\Components\Exception\RedirectException;

/**
 * @method ThemeContext getContext()
 */
class ThemeRepository extends ComponentRepository
{
    public function __construct(
        private readonly MessageManager $messageManager,
        private readonly Config $config
    ) {
    }

    public function getValue(): mixed
    {
        $currentTheme = (string)$this->getContext()->getCheckoutSession()->getCurrentTheme();
        if (!empty($currentTheme)) {
            return $currentTheme;
        }

        return $this->config->getTheme();
    }

    public function saveValue(mixed $value): void
    {
        if (empty($value)) {
            return;
        }

        $theme = (string)$value;
        $this->getContext()->getCheckoutSession()->setCurrentTheme($theme);

        $msg = 'Switching to '.$theme.' theme';
        $this->messageManager->addNoticeMessage($msg);

        $url = $this->getContext()->getUrlFactory()->create()->getUrl('checkout');
        throw (new RedirectException())->setUrl($url);
    }
}
