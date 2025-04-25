<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Component\GridLayout;

use Yireo\LokiCheckout\Config\XmlConfig\Value\GridLayout;
use Yireo\LokiFieldComponents\Component\Base\Field\FieldViewModel;

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
