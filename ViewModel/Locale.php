<?php declare(strict_types=1);

namespace LokiCheckout\Demo\ViewModel;

use Loki\Components\Util\Block\TemplateRenderer;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\Locale\ResolverInterface;
use Magento\Framework\View\Element\Template\File\Resolver;

class Locale implements ArgumentInterface
{
    public function __construct(
        private ResolverInterface $localeResolver,
        private Resolver $fileResolver,
        private TemplateRenderer $templateRenderer
    ) {
    }

    public function render(AbstractBlock $block, string $templateId): string
    {
        $locale = $this->getLocale();
        $template ='LokiCheckout_Demo::'.$locale.'/'.$templateId.'.phtml';

        if (false === $this->templateExists($template)) {
            $template ='LokiCheckout_Demo::en_us/'.$templateId.'.phtml';
        }

        return $this->templateRenderer->html($block, $template);
    }

    private function getLocale(): string
    {
        return strtolower((string)$this->localeResolver->getLocale());
    }

    private function templateExists(string $template): bool
    {
        return false !== $this->fileResolver->getTemplateFileName($template);
    }
}
