<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Component\Theme;

use Magento\Framework\Message\ManagerInterface as MessageManager;
use Yireo\LokiComponents\Component\ComponentRepository;
use Yireo\LokiComponents\Exception\RedirectException;

/**
 * @method ThemeContext getContext()
 */
class ThemeRepository extends ComponentRepository
{
    public function __construct(
        private readonly MessageManager $messageManager
    ) {
    }

    public function getValue(): mixed
    {
        return (string)$this->getContext()->getCheckoutSession()->getCurrentTheme();
    }

    public function saveValue(mixed $value): void
    {
        if (empty($value)) {
            return;
        }

        $theme = (string)$value;
        $this->getContext()->getCheckoutSession()->setCurrentTheme($theme);

        $this->messageManager->addNoticeMessage('Switching to '.$theme.' theme');

        $url = $this->getContext()->getUrlFactory()->create()->getUrl('checkout');
        throw new RedirectException($url);
    }
}
