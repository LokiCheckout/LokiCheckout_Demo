<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Component\GridLayout;

use LokiCheckout\Core\Config\XmlConfig\Value\GridLayout;
use Loki\Field\Component\Base\Field\FieldViewModel;

/**
 * @method GridLayoutContext getContext()
 */
class GridLayoutViewModel extends FieldViewModel
{
    /**
     * @return GridLayout[]
     */
    public function getGridLayouts(): array
    {
        return $this->getContext()->getXmlConfig()->getGridLayouts();
    }

    public function getFieldLabel(): string
    {
        return 'Grid Layout';
    }
}
