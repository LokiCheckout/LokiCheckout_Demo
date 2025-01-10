<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Component\Theme;

use Yireo\LokiComponents\Component\ComponentRepository;

/**
 * @method ThemeContext getContext()
 */
class ThemeRepository extends ComponentRepository
{
    public function getValue(): mixed
    {
        return (string)$this->getContext()->getCheckoutSession()->getCurrentTheme();
    }

    public function saveValue(mixed $value): void
    {
        $theme = (string)$data;
        $this->getContext()->getCheckoutSession()->setCurrentTheme($theme);
    }
}
