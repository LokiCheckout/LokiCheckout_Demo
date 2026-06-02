<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Component\Skin;

use LokiCheckout\Core\Config\Config;
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
        private readonly Config $config
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
        if (empty($value)) {
            return;
        }

        $skin = (string)$value;
        $this->getContext()->getCheckoutSession()->setCurrentSkin($skin);

        $msg = 'Switching to '.$skin.' skin';
        $this->messageManager->addNoticeMessage($msg);

        $url = $this->getContext()->getUrlFactory()->create()->getUrl('checkout');
        throw (new RedirectException())->setUrl($url);
    }
}
