<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Component\GridLayout;

use LokiCheckout\Core\Config\Config;
use Magento\Framework\Message\ManagerInterface as MessageManager;
use Loki\Components\Component\ComponentRepository;
use Loki\Components\Exception\RedirectException;

/**
 * @method GridLayoutContext getContext()
 */
class GridLayoutRepository extends ComponentRepository
{
    public function __construct(
        private readonly MessageManager $messageManager,
        private readonly Config $config
    ) {
    }

    public function getValue(): mixed
    {
        $currentGridLayout = (string)$this->getContext()->getCheckoutSession()->getCurrentGridLayout();
        if (!empty($currentGridLayout)) {
            return $currentGridLayout;
        }

        return $this->config->getGridLayoutName();
    }

    public function saveValue(mixed $value): void
    {
        if (empty($value)) {
            return;
        }

        $gridLayout = (string)$value;
        $this->getContext()->getCheckoutSession()->setCurrentGridLayout($gridLayout);

        $msg = 'Switching to '.$gridLayout.' grid layout';
        $this->messageManager->addNoticeMessage($msg);

        $url = $this->getContext()->getUrlFactory()->create()->getUrl('checkout');
        throw (new RedirectException())->setUrl($url);
    }
}
