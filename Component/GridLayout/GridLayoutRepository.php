<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Component\GridLayout;

use LokiCheckout\Core\Config\Config;
use LokiCheckout\Core\Config\XmlConfig;
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
        private readonly Config $config,
        private readonly XmlConfig $xmlConfig,
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
        if (empty($value) || false === is_string($value)) {
            return;
        }

        $gridLayouts = $this->xmlConfig->getGridLayouts();
        if (false === array_key_exists($value, $gridLayouts)) {
            $this->messageManager->addErrorMessage(__('Unknown grid layout'));
            return;
        }

        $this->getContext()->getCheckoutSession()->setCurrentGridLayout($value);
        $this->messageManager->addNoticeMessage(__('Switching to %1 grid layout', $value));

        $url = $this->getContext()->getUrlFactory()->create()->getUrl('checkout');
        throw (new RedirectException())->setUrl($url);
    }
}
