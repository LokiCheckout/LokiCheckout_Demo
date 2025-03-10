<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Component\GridLayout;

use Magento\Framework\Message\ManagerInterface as MessageManager;
use Yireo\LokiComponents\Component\ComponentRepository;
use Yireo\LokiComponents\Exception\RedirectException;

/**
 * @method GridLayoutContext getContext()
 */
class GridLayoutRepository extends ComponentRepository
{
    public function __construct(
        private readonly MessageManager $messageManager
    ) {
    }

    public function getValue(): mixed
    {
        return (string)$this->getContext()->getCheckoutSession()->getCurrentGridLayout();
    }

    public function saveValue(mixed $value): void
    {
        if (empty($value)) {
            return;
        }

        $gridLayout = (string)$value;
        $this->getContext()->getCheckoutSession()->setCurrentGridLayout($gridLayout);

        $this->messageManager->addNoticeMessage('Switching to '.$gridLayout.' grid layout');

        $url = $this->getContext()->getUrlFactory()->create()->getUrl('checkout');
        throw new RedirectException($url);
    }
}
