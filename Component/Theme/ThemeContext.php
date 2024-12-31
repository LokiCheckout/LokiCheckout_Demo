<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Component\Theme;

use Yireo\LokiCheckout\Component\Base\Generic\GenericContext;
use Yireo\LokiCheckout\Config\XmlConfig;

class ThemeContext extends GenericContext
{
    public function getXmlConfig(): XmlConfig
    {
        return $this->get(XmlConfig::class);
    }
}
