# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.37] - 16 October 2026
### Fixed
- Escape URLs properly and remove double escaping
- Validate skin and grid layout against XML configuration
- Make demo add-to-cart POST-only with validated input
- Only add enabled, visible and salable products to the cart
- Add demo mode setting to gate all demo features
- Fix wrong escaping of HTML

### Security
- Demo features are now disabled by default and require `loki_checkout/demo/enabled`
- Add-to-cart controller is POST-only with form key validation and validated parameters
- Skin and grid layout values are validated against the XML configuration
- Only enabled, visible, salable products of the current website are added to the cart
- Fix escaping of URLs and double-escaping of customer data in templates

## [2.0.36] - 12 August 2026
### Fixed
- Styling changes
- Add translations of homepage content

## [2.0.35] - 14 July 2026
### Fixed
- Remove dep with MSI

## [2.0.34] - 14 July 2026
### Fixed
- Remove dep with LokiCheckout_FunctionalTests

## [2.0.33] - 01 July 2026
### Fixed
- Increment `loki/magento2-components` to 2.6
- Remove gender options for NL because they suck
- Implement JsProperty attribute
- Add icon to tablerates method

## [2.0.32] - 17 June 2026
### Fixed
- Enable payment method lazy loading in the OneStep Demo skin

## [2.0.31] - 11 June 2026
### Fixed
- Add demo of custom gender
- Fix CSP issue with inline event handler with tourguide button

## [2.0.30] - 02 June 2026
### Fixed
- Beautify homepage settings
- Add-to-cart button from homepage
- Add new demo homepage image
- Alphabetically sort skins
- Add label within border of input for `onestep_demo` skin
- Rename `onestepdemo` skin to `onestep_demo`
- Rename `theme` to `skin`

## [2.0.29] - 19 May 2026
### Fixed
- Load tourguide CSS with fetchpriority=low

## [2.0.28] - 11 May 2026
### Fixed
- Simplify gaps
- Make Loki icon on homepage white again

## [2.0.27] - 05 May 2026
### Fixed
- Enhance colors of methods
- Add round checkbox on completed fields
- Optimize icons
- Add new theme `onestepdemo`

## [2.0.26] - 29 April 2026
### Fixed
- Only display agreements block if enabled in config
- Do not scale active buttons
- Enhance animation of method selection
- Fix broken active CSS

## [2.0.25] - 22 April 2026
### Fixed
- Add message to RedirectException
- Remove dep with `Yireo_IntegrationTestHelper`

## [2.0.24] - 24 February 2026
### Fixed
- Rewrite ComponentContext to AbstractComponentContext

## [2.0.23] - 21 November 2025
### Fixed
- Replace `$block->getChildHtml()` with `$childRenderer->all()` including better sorting
- Add plan-trial keyword to composer file

## [2.0.22] - 03 November 2025
### Fixed
- Update composer keywords
- Loose constraint with `yireo/magento2-additional-block-template`

## [2.0.21] - 22 October 2025
### Fixed
- Do not escape `$css()` with `escapeHtmlAttr()` but `escapeHtml()`

## [2.0.20] - 17 October 2025
### Fixed
- Adjust text
- Optimize demo build
- Allow overriding SVG attributes if they already exist

## [2.0.19] - 10 October 2025
### Fixed
- Implement new x-tooltip directive
- Add translations
- Restyle demo login message for WCAG compliance

## [2.0.18] - 08 October 2025
### Fixed
- Move agreements to billing step

## [2.0.17] - 08 October 2025
### Fixed
- Beuatify positioning of agreements in Optimized Theme of demo
- Change green color of valid form fields into b1c2b1

## [2.0.16] - 06 October 2025
### Fixed
- Fix hover on payment method item to cause little bump in demo-module

## [2.0.15] - 27 September 2025
### Fixed
- Fix escaping again

## [2.0.14] - 27 September 2025
### Fixed
- Fix wrong escaping

## [2.0.13] - 25 September 2025
### Fixed
- Undo escaping of images via imageRenderer

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
