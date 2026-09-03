# LokiCheckout_Demo

<!-- badges.specs.start -->
![Magento version](https://img.shields.io/badge/Magento-2.4.6%20%7C%202.4.9-orange)
![PHP version](https://img.shields.io/badge/PHP-8.2%E2%80%938.5-777BB4)
![License](https://img.shields.io/badge/License-OSL--3.0-blue)
![Latest Version](https://gitlab.yireo.com/loki-checkout/LokiCheckout_Demo/-/badges/release.svg)
<!-- badges.specs.end -->


**This is an internal package used for creating a demo site for the LokiCheckout. It includes a demo tour, a selector for picking a theme and other dependencies. Do not use this in production (unless you are running a demo site).**

## Installation
Install this package via composer:
```bash
composer require loki-checkout/magento2-demo
```

Next, enable this module:
```bash
bin/magento module:enable LokiCheckout_Demo
```



## Current status

<!-- badges.test.start -->
[![Static Tests](https://gitlab.yireo.com/loki-checkout/LokiCheckout_Demo/badges/main/pipeline.svg?job=static-tests)](https://gitlab.yireo.com/loki-checkout/LokiCheckout_Demo/-/pipelines)
[![Unit Tests](https://gitlab.yireo.com/loki-checkout/LokiCheckout_Demo/badges/main/pipeline.svg?job=unit-tests)](https://gitlab.yireo.com/loki-checkout/LokiCheckout_Demo/-/pipelines)
[![Integration Tests](https://gitlab.yireo.com/loki-checkout/LokiCheckout_Demo/badges/main/pipeline.svg?job=integration-tests)](https://gitlab.yireo.com/loki-checkout/LokiCheckout_Demo/-/pipelines)
[![Playwright](https://gitlab.yireo.com/loki-checkout/LokiCheckout_Demo/badges/main/pipeline.svg?job=playwright)](https://gitlab.yireo.com/loki-checkout/LokiCheckout_Demo/-/pipelines)
[![DI Compilation](https://gitlab.yireo.com/loki-checkout/LokiCheckout_Demo/badges/main/pipeline.svg?job=compile)](https://gitlab.yireo.com/loki-checkout/LokiCheckout_Demo/-/pipelines)
<!-- badges.test.end -->
