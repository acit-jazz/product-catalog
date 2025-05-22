<?php

namespace AcitJazz\ProductCatalog\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AcitJazz\ProductCatalog\ProductCatalog
 */
class ProductCatalog extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AcitJazz\ProductCatalog\ProductCatalog::class;
    }
}
