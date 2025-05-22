# Product Catalog With Categories
Laravel - Inertia - Vue3

## Support us


## Installation

You can install the package via composer:

```bash
composer require acitjazz/product-catalog
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="product-catalog-migrations"
php artisan migrate
```
or

```bash
php artisan migrate --path=vendor/acitjazz/product-catalog/database/migrations
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="product-catalog-config"
```

This is the contents of the published config file:

```php
return [
];
```

Publish the Inertia Views

```bash
php artisan vendor:publish --tag=product-catalog-assets --force
```

## Usage

```php
$productCatalog = new AcitJazz\ProductCatalog();
echo $productCatalog->echoPhrase('Hello, AcitJazz!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [AcitJazz](https://github.com/AcitJazz)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
