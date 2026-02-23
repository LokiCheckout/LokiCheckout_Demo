<?php

declare(strict_types=1);

namespace LokiCheckout\Demo\Test\Unit\Component\GridLayout;

use Loki\Components\Component\AbstractComponentContext;
use Loki\Components\Component\ComponentInterface;
use Loki\Components\Exception\RedirectException;
use LokiCheckout\Core\Config\Config;
use LokiCheckout\Core\Test\Unit\Stub\CheckoutSessionStub;
use LokiCheckout\Demo\Component\GridLayout\GridLayoutContext;
use LokiCheckout\Demo\Component\GridLayout\GridLayoutRepository;
use Magento\Checkout\Model\Session;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\UrlFactory;
use Magento\Framework\UrlInterface;
use PHPUnit\Framework\TestCase;
use Loki\Components\Test\Unit\Mock\ComponentContextMock;

final class GridLayoutRepositoryTest extends TestCase
{
    use ComponentContextMock;

    final public function testGetValue()
    {
        $checkoutSession = $this->createMock(CheckoutSessionStub::class);
        $checkoutSession->method('getCurrentGridLayout')->willReturn('foobar');

        $context = $this->createMock(GridLayoutContext::class);
        $context->method('__call')->willReturn($checkoutSession);

        $component = $this->createMock(ComponentInterface::class);
        $component->method('getContext')->willReturn($context);

        $messageManager = $this->createMock(ManagerInterface::class);
        $config = $this->createMock(Config::class);
        $repository = new GridLayoutRepository($messageManager, $config);
        $repository->setComponent($component);

        $this->assertEquals('foobar', $repository->getValue());
    }

    final public function testSaveValue()
    {
        $checkoutSession = $this->createMock(Session::class);

        $url = $this->createMock(UrlInterface::class);
        $url->method('getUrl')->willReturn('foobar');

        $urlFactory = $this->createMock(UrlFactory::class);
        $urlFactory->method('create')->willReturn($url);

        $context = $this->getComponentContextMock([
            'getCheckoutSession' => $checkoutSession,
            'getUrlFactory' => $urlFactory,
        ]);

        $component = $this->createMock(ComponentInterface::class);
        $component->method('getContext')->willReturn($context);

        $messageManager = $this->createMock(ManagerInterface::class);
        $config = $this->createMock(Config::class);
        $repository = new GridLayoutRepository($messageManager, $config);
        $repository->setComponent($component);

        $this->expectException(RedirectException::class);
        $repository->saveValue('foobar');
    }
}
