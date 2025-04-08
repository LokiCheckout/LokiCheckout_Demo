<?php

declare(strict_types=1);

namespace Yireo\LokiCheckoutDemo\Test\Unit\Component\GridLayout;

use Magento\Checkout\Model\Session;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\UrlFactory;
use Magento\Framework\UrlInterface;
use PHPUnit\Framework\TestCase;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\GetObjectManager;
use Yireo\LokiCheckout\Test\Unit\Stub\CheckoutSessionStub;
use Yireo\LokiCheckoutDemo\Component\GridLayout\GridLayoutContext;
use Yireo\LokiCheckoutDemo\Component\GridLayout\GridLayoutRepository;
use Yireo\LokiComponents\Component\ComponentInterface;
use Yireo\LokiComponents\Exception\RedirectException;

final class GridLayoutRepositoryTest extends TestCase
{
    use GetObjectManager;

    final public function testGetValue()
    {
        $checkoutSession = $this->createMock(CheckoutSessionStub::class);
        $checkoutSession->method('getCurrentGridLayout')->willReturn('foobar');

        $context = $this->createMock(GridLayoutContext::class);
        $context->method('getCheckoutSession')->willReturn($checkoutSession);

        $component = $this->createMock(ComponentInterface::class);
        $component->method('getContext')->willReturn($context);

        $messageManager = $this->createMock(ManagerInterface::class);
        $repository = new GridLayoutRepository($messageManager);
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

        $context = $this->createMock(GridLayoutContext::class);
        $context->method('getCheckoutSession')->willReturn($checkoutSession);
        $context->method('getUrlFactory')->willReturn($urlFactory);

        $component = $this->createMock(ComponentInterface::class);
        $component->method('getContext')->willReturn($context);

        $messageManager = $this->createMock(ManagerInterface::class);
        $repository = new GridLayoutRepository($messageManager);
        $repository->setComponent($component);

        $this->expectException(RedirectException::class);
        $repository->saveValue('foobar');
    }
}
