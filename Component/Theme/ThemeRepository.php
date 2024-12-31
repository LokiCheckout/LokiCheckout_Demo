<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Component\Theme;

use Yireo\LokiComponents\Component\ComponentRepository;

/**
 * @method ThemeContext getContext()
 */
class ThemeRepository extends ComponentRepository
{
    protected function getData(): mixed
    {
        return (string)$this->getContext()->getCheckoutSession()->getCurrentTheme();
    }

    protected function saveData(mixed $data): void
    {
        $this->getContext()->getCheckoutSession()->setCurrentTheme((string)$data);
    }
}
