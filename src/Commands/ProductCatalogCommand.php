<?php

namespace AcitJazz\ProductCatalog\Commands;

use Illuminate\Console\Command;

class ProductCatalogCommand extends Command
{
    public $signature = 'product-catalog';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
