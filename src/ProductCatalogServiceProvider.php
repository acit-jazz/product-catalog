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
            ->hasMigration('create_products_table')
            ->hasCommand(ProductCatalogCommand::class);
    }

    public function packageBooted()
    {
        // Publish JS/Vue resources to the main app
        $this->publishes([
            __DIR__ . '/../resources/js/admin/product/' => resource_path('js/admin/product'),
        ], 'product-catalog-assets');
    }
}
