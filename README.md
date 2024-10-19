# TagManagerBundle

TagManagerBundle: A Simplified Integration for Cross-Domain Measurement.

The TagManagerBundle offers a streamlined approach to tracking user activity across multiple websites.

By enabling cross-domain measurement, you can seamlessly monitor user behavior as they navigate between related sites on different domains. Google tags play a crucial role in facilitating this process, allowing supported products to accurately capture user interactions across various domains.

This feature is applicable to all Google products, including Google Analytics, Google Ads conversion tracking, and Floodlight conversions.

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Applications that use Symfony Flex

#### Step 1: Configure Access to Recipes

Update `composer.json` file with an extra Symfony Flex endpoint to allow the execution of the recipes.

Execute the following command:

```console
composer config extra.symfony.endpoint \
    '["https://api.github.com/repos/specter-global/symfony-recipes/contents/index.json?ref=flex/main", "flex://defaults"]' \
    --json \
    --merge
```

The updated `composer.json` file should now have the following contents:

```json
{
    "extra": {
        "symfony": {
            "endpoint": [
                "https://api.github.com/repos/specter-global/symfony-recipes/contents/index.json?ref=flex/main",
                "flex://defaults"
            ]
        }
    }
}
```

#### Step 2: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
composer require specter-global/tag-manager-bundle
```

### Applications that don't use Symfony Flex

#### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
composer require specter-global/tag-manager-bundle
```

#### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    SpecterGlobal\Bundle\TagManagerBundle\SpecterGlobalTagManagerBundle::class => ['all' => true],
];
```

#### Step 3: Configure the Bundle

Copy the default config to your `config/packages/` directory:

```console
cp vendor/specter-global/tag-manager-bundle/config/packages/specter_global_tag_manager.yaml config/packages/
```

## Configuration

The configuration of this bundle is quite simple, take a look:

```yaml
specter_global_tag_manager:
    # Enable or Disable TagManagerBundle for the current environment
    enabled: true
    tag_id: 'DUMMY_TAG_MANAGER_ID'
    cookie_flags:
        - 'Flag=Value'
    linker:
        # If the destination domain is not configured to automatically link domains, you can instruct the destination 
        # page to look for linker parameters. Set the accept_incoming property to true.
        accept_incoming: false
        # To measure form data that is sent between multiple domains, set the decorate_forms property to true.
        decorate_forms: false
        # Certain content applications require you to use a fragment/hash character (#) as the delimiter in URL strings 
        # instead of the more commonly used question mark character (?) to indicate query parameters. To configure 
        # the linker parameter to appear in the URL after a # character (e.g. https://example.org#_gl=1~abcde5~), 
        # set url_position to fragment.
        url_position: query
        # An array of one or more domains to be linked.
        domains:
            - 'example.org'

when@dev:
    specter_global_tag_manager:
        # Enable or Disable TagManagerBundle for the dev environment
        enabled: false

when@test:
    specter_global_tag_manager:
        # Enable or Disable TagManagerBundle for the test environment
        enabled: false

when@prod:
    specter_global_tag_manager:
        # Enable or Disable TagManagerBundle for the prod environment
        enabled: true
```

## Usage

Place the `specter_global_tag_manager()` twig function immediately after the opening <head> HTML tag on every page you 
want to measure.

```html
<!DOCTYPE html>
<html>
<head>
    {{ specter_global_tag_manager() }}
</head>
<body>
    {# ... #}
</body>
</html>
```

# Tests

Running the tests is simple:

```console
composer dev:test
```

## Support

For complete instructions on using the TagManagerBundle, see the 
[Specter.Global TagManagerBundle documentation](https://developer.specter.global/docs/tag-manager-bundle).

## Security Vulnerabilities

Please review [our security policy](https://github.com/specter-global/tag-manager-bundle/security/policy) on how to 
report security vulnerabilities.

## License

This software is published under the [MIT License](LICENSE)
