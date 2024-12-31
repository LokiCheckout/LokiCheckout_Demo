<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Component\Theme;

use Yireo\LokiCheckout\Config\XmlConfig\Value\Theme;
use Yireo\LokiComponents\Component\ComponentViewModel;

/**
 * @method ThemeContext getContext()
 */
class ThemeViewModel extends ComponentViewModel
{
    /**
     * @return Theme[]
     */
    public function getThemes(): array
    {
        return $this->getContext()->getXmlConfig()->getThemes();
    }

    public function getJsComponentName(): ?string
    {
        return 'LokiCheckoutDemoThemeSwitcher';
    }
}
