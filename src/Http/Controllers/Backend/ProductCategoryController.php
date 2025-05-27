<?php

namespace AcitJazz\ProductCatalog\Http\Controllers\Backend;

use AcitJazz\ProductCatalog\Http\Requests\ProductCategoryRequest;
use Illuminate\Routing\Controller;
use Facades\AcitJazz\ProductCatalog\Http\Repositories\ProductCategoryRepository;
use AcitJazz\ProductCatalog\Http\Resources\Backend\ProductCategoryResource;
use AcitJazz\ProductCatalog\Models\ProductCategory;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
 
class ProductCategoryController extends Controller
{
 
    public function index()
    {

        $product_categories = ProductCategoryRepository::paginate(20);

        return Inertia::render('product-category/index', [
            'product_categories' => ProductCategoryResource::collection($product_categories),
            'title' => request('trash') ? 'Trash' : 'Product Category',
            'trash' => request('trash') ? true : false,
            'request' => request()->all(),
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard.index'),
                ],
                [
                    'text' => 'Product Category',
                    'url' => route('product-category.index'),
                ],
            ],
        ]);
    }

    /**
     * create view.
     */
    public function create()
    {
        $product_category = new ProductCategory();
        $product_category = ProductCategoryResource::make($product_category)->resolve();
        // dd($tags);
        return Inertia::render(''.vueFormExist(type(), 'product-category', 'form'), [
            'product_category' => $product_category,
            'type' => type(),
            'method' => 'post',
            'title' => 'Create '.'Product Category',
            'locale' => app()->getLocale(),
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard.index'),
                ],
                [
                    'text' => 'Product Category',
                    'url' => route('product-category.index'),
                ],
            ],
        ]);
    }

    /**
     * store data.
     */
    public function store(ProductCategoryRequest $request)
    {

        $product_category = ProductCategory::create($request->all());

        Cache::tags(['product_categories'])->flush();

        return redirect()->back()->with('message', toTitle($product_category->title).' has been updated');
    }

    /**
     * Edit view.
     */
    public function edit(ProductCategory $product_category)
    {
        return Inertia::render(vueFormExist(type(), 'product-category', 'form'), [
            'product_category' => ProductCategoryResource::make($product_category)->resolve(),
            'type' => type(),
            'method' => 'patch',
            'title' => 'Edit '.'Product Category',
            'locale' => app()->getLocale(),
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard.index'),
                ],
                [
                    'text' => 'Product Category',
                    'url' => route('product-category.index'),
                ],
            ],
        ]);
    }

    /**
     * Update Data.
     */
    public function update(ProductCategoryRequest $request, ProductCategory $product_category)
    {
        $product_category->update($request->all());


        Cache::tags(['product_categories'])->flush();

        return redirect()->back()->with('message', toTitle($product_category->title).' has been updated');
    }

    /**
     * Remove the specified resource from storage temporary.
     */
    public function delete($product_category)
    {
        $product_category = ProductCategory::find($product_category);
        if (!$product_category) {
            return abort(404);
        }
        $product_category->delete();

        Cache::tags(['product_categories'])->flush();

        return redirect()->route('product-category.index')->with('message', toTitle($product_category->title.' hase been deleted'));
    }

    /**
     * Remove data permanently.
     */
    public function destroy($product_category)
    {
        $product_category = ProductCategory::withTrashed()->find($product_category);
        if (!$product_category) {
            return abort(404);
        }
        $product_category->forceDelete();

        Cache::tags(['product_categories'])->flush();

        return redirect()->route('product-category.index')->with('message', toTitle($product_category->title.' hase been destroyed'));
    }

    public function destroyAll()
    {
        $ids = explode(',', request('selected'));
        $product_categories = ProductCategory::whereIn('_id', $ids)->withTrashed()->get();
        foreach ($product_categories as $product_category) {
            $product_category->forceDelete();
        }
        Cache::tags(['product_categories'])->flush();

        return redirect()->route('product-category.index')->with('message', toTitle($product_category->title).' has been destroyed');
    }

    /**
     * Restore Data from trash.
     */
    public function restore($product_category)
    {
        $product_category = ProductCategory::withTrashed()->find($product_category);
        if (!$product_category) {
            return abort(404);
        }
        $product_category->restore();
        Cache::tags(['product_categories'])->flush();

        return redirect()->route('product-category.index')->with('message', toTitle($product_category->title).' has been restored');
    }
 
}