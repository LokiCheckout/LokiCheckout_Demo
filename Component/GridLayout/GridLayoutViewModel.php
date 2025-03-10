<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Component\GridLayout;

use Yireo\LokiCheckout\Config\XmlConfig\Value\GridLayout;
use Yireo\LokiComponents\Component\ComponentViewModel;

/**
 * @method GridLayoutContext getContext()
 */
class GridLayoutViewModel extends ComponentViewModel
{
    /**
     * @return GridLayout[]
     */
    public function getGridLayouts(): array
    {
        return $this->getContext()->getXmlConfig()->getGridLayouts();
    }
}
