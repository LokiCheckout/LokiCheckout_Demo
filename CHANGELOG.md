# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.12] - 24 September 2025
### Fixed
- Add proper ID
- Implement new imageRenderer
- Autoswitch imageRenderer::get() for SVG or other image
- Output SVG with given XML attributes properly
- Move sort order of steps from XML layout into `loki_checkout.xml`
- Rename loki-scripts to loki.script

## [2.0.11] - 16 September 2025
### Fixed
- Split up loki-container from utilities below
- Add PHPStan levels
- Undo grid
- Reapply blue border to current payment method
- Mobile fix
- Show payment methods in grid of 2 for optimized theme
- Fix unit test
- Copy generic CI/CD files

## [2.0.10] - 02 September 2025
### Fixed
- Make sure default theme and grid layout are selected in toggle-boxes

## [2.0.9] - 02 September 2025
### Fixed
- Add optimized images
- Add Flatpickr to demo

## [2.0.8] - 30 August 2025
### Fixed
- Add new homepage content
- Add CI files
- Replace yireo/opensearch with yireo/opensearch-dummy in Gitlab CI

## [2.0.7] - 26 August 2025
### Fixed
- 419dfb7 Additional translations
- 3d762e4 Add Gitlab CI/CD files
- c0e173c Fix gap for mobile

## [2.0.6] - 21 August 2025
### Fixed
- Add dependency with loki/magento2-css-utils
- Re-ordering blocks
- Re-ordering blocks
- Formatting
- Declare used PHP namespaces
- Convert multi-line phpdoc block into single blocks
- Convert multi-line phpdoc block into single blocks
- Formatting
- Convert multi-line phpdoc block into single blocks
- Convert multi-line phpdoc block into single blocks
- Convert multi-line phpdoc block into single blocks
- Replace LokiComponentsUtilBlockCssClass with LokiCssUtilsUtilCssClass
- Declare used PHP namespaces
- Document latest version of template
- Add missing strict_types declaration

## [2.0.5] - 19 August 2025
### Fixed
- Remove obsolete todos
- Reset robots tag
- Upda

## [2.0.4] - 18 August 2025
### Fixed
- Prevent escaping of SVGs

## [2.0.3] - 18 August 2025
### Fixed
- Lower requirements to PHP 8.1
- Implement optimized login-logout flow
- Rename "Multi Step Checkout" to "Optimized Checkout (demo)"
- Do not show newsletter box as switch, but as checkbox
- Set META tags in demo
- Add Dutch translation
- Remove colors in favor of a11y
- Fixes for radio buttons
- Use switch for newsletter
- Override login and email field

## [2.0.2] - 15 August 2025
### Fixed
- Mark input field with [data-valid] also on page load when it is valid and not-empty

## [2.0.1] - 07 August 2025
### Fixed
- Lower PHP requirement to PHP 8.2+

## [2.0.0] - 22 July 2025
### Fixed
- Rename PHP namespace from `Yireo_Loki*` to `Loki*`
- Rename composer package from `yireo/magento2-loki*` to `loki/magento2*`
- Bump loki/magento2-components to major 2.0
- Bump loki/magento2-field-components to major 2.0
- Bump `LokiCheckout_Core` to 2.0.0
- Rewrite grid layouts to include sub-entity grid

## [1.0.0] - 26 May 2025
### Fixed
- Add `account_type` to grid
- Generate new MODULE.json with simple test count
- Add LokiCheckout as page title
- Spread Postcode NL fields properly
- Make sure to hook into right method getGridLayoutName
- Allow PHP 8.4 in CI
- Optimize layout for Hyva
- Update composer and module deps

## [0.0.8] - 25 April 2025
### Fixed
- Remove x-model because of CSP compliance
- Remove gridClass, add colSpan and mdColSpan in grid layouts
- Allow switching of grid layout per country ID
- Fix demo selectors not working for Hyva

## [0.0.7] - 16 April 2025
### Fixed
- Move scripts from "before.body.end" to new "loki-scripts" container
- Fix Luma loading of scripts in Hyva
- Implement label for gridlayouts
- Add optional countryId to grid XML
- Add label to grid
- Move `loki_checkout.xml` of Nl and PostcodeNl module to Demo module

## [0.0.6] - 09 April 2025
### Fixed
- Fix font on homepage
- Fix look and feel of demo module
- Restructure loki classes for Luma
- Remove unneeded identifier
- Handle error better

## [0.0.5] - 09 April 2025
### Fixed
- Add Tailwind to Luma homepage

## [0.0.4] - 08 April 2025
### Fixed
- Add little powered-by block
- Fix hover
- Adjust homepage styling
- Resolving of shipping method icons
- Housekeeping changes
- Restyling in Breeze

## [0.0.3] - 11 March 2025
### Fixed
- Move GridLayout from XML layout to config
- Add styling of shipping methods
- Accessibiity fixes

## [0.0.2] - 22 February 2025
- Change deps

## [0.0.1] - 21 January 2025
- Initial release
