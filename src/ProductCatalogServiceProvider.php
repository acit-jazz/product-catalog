<?php

namespace AcitJazz\ProductCatalog;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AcitJazz\ProductCatalog\Commands\ProductCatalogCommand;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class ProductCatalogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('product-catalog')
            ->hasRoutes('web')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations([
                    'create_products_table',
                    'create_product_categories_table',
                    'create_category_product_table'
                ])
            ->hasCommand(ProductCatalogCommand::class);
    }

    public function packageBooted()
    {
        // Publish JS/Vue resources to the main app
        $this->publishes([
            __DIR__ . '/../resources/js/admin/product/' => resource_path('js/admin/product'),
            __DIR__ . '/../resources/js/admin/product-category/' => resource_path('js/admin/product-category'),
        ], 'product-catalog-assets');
    }
}
