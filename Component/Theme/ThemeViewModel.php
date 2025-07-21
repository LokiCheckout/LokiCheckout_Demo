<?php declare(strict_types=1);

namespace LokiCheckout\Demo\Component\Theme;

use LokiCheckout\Core\Config\XmlConfig\Value\Theme;
use Loki\Field\Component\Base\Field\FieldViewModel;

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
