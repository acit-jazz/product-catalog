<?php

namespace AcitJazz\ProductCatalog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pipeline\Pipeline;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;
use App\Traits\GetSet;

class ProductCategory extends Model
{
    use SoftDeletes;
    use HasSlug;
    use GetSet;


    protected $table = 'product_categories';
    protected $dates = ['deleted_at', 'published_at'];
    protected $casts = [
        'deleted_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'slug',
        'color',
        'text_color',
        'summary',
        'description',
        'images',
        'meta',
        'published_at',
        'deleted_at',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('slug')
            ->saveSlugsTo('slug');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public static function paginateWithFilters($limit)
    {
        return app(Pipeline::class)
            ->send(ProductCategory::query())
            ->through([
                \App\QueryFilters\SortBy::class,
                \App\QueryFilters\Type::class,
                \App\QueryFilters\Trash::class,
                \App\QueryFilters\Except::class,
                \App\QueryFilters\Published::class,
                \App\QueryFilters\SearchTitle::class,
                \App\QueryFilters\SearchTitleDesc::class,
            ])
            ->thenReturn()
            ->paginate($limit)->withQueryString();
    }

    public static function allWithFilters()
    {
        return app(Pipeline::class)
            ->send(ProductCategory::query())
            ->through([
                \App\QueryFilters\SortBy::class,
                \App\QueryFilters\Type::class,
                \App\QueryFilters\Trash::class,
                \App\QueryFilters\Except::class,
                \App\QueryFilters\Published::class,
                \App\QueryFilters\SearchTitle::class,
                \App\QueryFilters\SearchTitleDesc::class,
            ])
            ->thenReturn()
            ->get();
    }
}
