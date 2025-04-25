<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Component\Theme;

use Yireo\LokiCheckout\Config\XmlConfig\Value\Theme;
use Yireo\LokiFieldComponents\Component\Base\Field\FieldViewModel;

/**
 * @method ThemeContext getContext()
 */
class ThemeViewModel extends FieldViewModel
{
    /**
     * @return Theme[]
     */
    public function getThemes(): array
    {
        return $this->getContext()->getXmlConfig()->getThemes();
    }

    public function getFieldLabel(): string
    {
        return 'Theme';
    }
}
