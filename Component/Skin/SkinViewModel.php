<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Component\Skin;

use LokiCheckout\Core\Config\XmlConfig\Value\Skin;
use Loki\Field\Component\Base\Field\FieldViewModel;

/**
 * @method SkinContext getContext()
 */
class SkinViewModel extends FieldViewModel
{
    /**
     * @return Skin[]
     */
    public function getSkins(): array
    {
        return $this->getContext()->getXmlConfig()->getSkins();
    }

    public function getFieldLabel(): string
    {
        return 'Skin';
    }
}
