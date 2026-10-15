<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Component\Skin;

use LokiCheckout\Core\Config\Config;
use LokiCheckout\Core\Config\XmlConfig;
use Magento\Framework\Message\ManagerInterface as MessageManager;
use Loki\Components\Component\ComponentRepository;
use Loki\Components\Exception\RedirectException;

/**
 * @method SkinContext getContext()
 */
class SkinRepository extends ComponentRepository
{
    public function __construct(
        private readonly MessageManager $messageManager,
        private readonly Config $config,
        private readonly XmlConfig $xmlConfig,
    ) {
    }

    public function getValue(): mixed
    {
        $currentSkin = (string)$this->getContext()->getCheckoutSession()->getCurrentSkin();
        if (!empty($currentSkin)) {
            return $currentSkin;
        }

        return $this->config->getSkin();
    }

    public function saveValue(mixed $value): void
    {
        if (empty($value) || false === is_string($value)) {
            return;
        }

        $skins = $this->xmlConfig->getSkins();
        if (false === array_key_exists($value, $skins)) {
            $this->messageManager->addErrorMessage(__('Unknown skin'));
            return;
        }

        $this->getContext()->getCheckoutSession()->setCurrentSkin($value);
        $this->messageManager->addNoticeMessage(__('Switching to %1 skin', $value));

        $url = $this->getContext()->getUrlFactory()->create()->getUrl('checkout');
        throw (new RedirectException())->setUrl($url);
    }
}
