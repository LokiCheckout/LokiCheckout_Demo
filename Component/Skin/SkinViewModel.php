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
        $skins = $this->getContext()->getXmlConfig()->getSkins();
        usort($skins, fn (Skin $a, Skin $b) => $a->getLabel() <=> $b->getLabel());
        return $skins;
    }

    public function getFieldLabel(): string
    {
        return 'Skin';
    }
}
