<?php

namespace AcitJazz\ProductCatalog\Http\Controllers;

use AcitJazz\ProductCatalog\Http\Requests\ProductRequest;
use Illuminate\Routing\Controller;
use Facades\AcitJazz\ProductCatalog\Http\Repositories\ProductRepository;
use Facades\AcitJazz\ProductCatalog\Http\Repositories\ProductCategoryRepository;
use AcitJazz\ProductCatalog\Http\Resources\Backend\ProductResource;
use AcitJazz\ProductCatalog\Http\Resources\Frontend\FeProductResource;
use AcitJazz\ProductCatalog\Models\Product;
use AcitJazz\ProductCatalog\Http\Resources\Frontend\ListCategoryResource;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
 
class ProductController extends Controller
{
 
    public function index()
    {

        $products = ProductRepository::paginate(20);

        return Inertia::render('product/index', [
            'products' => FeProductResource::collection($products),
            'type' => type(),
            // 'tags' => $tags,
            'title' => request('trash') ? 'Trash' : 'Product',
            'locale' => app()->getLocale(),
            'trash' => request('trash') ? true : false,
            'search_title' => request('search_title'),
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard.index'),
                ],
                [
                    'text' => 'Product',
                    'url' => route('product.index'),
                ],
            ],
        ]);
    }

    /**
     * create view.
     */
    public function create()
    {
        $product = new Product();
        $product = ProductResource::make($product)->resolve();
        $categories = ProductCategoryRepository::all();
        $categories = ListCategoryResource::collection($categories)->resolve();
        // dd($tags);

        return Inertia::render(''.vueFormExist(type(), 'product', 'form'), [
            'product' => $product,
            'categories' => $categories,
            'type' => type(),
            'method' => 'store',
            'title' => 'Create '.'Product',
            'locale' => app()->getLocale(),
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard.index'),
                ],
                [
                    'text' => 'Product',
                    'url' => route('product.index'),
                ],
            ],
        ]);
    }

    /**
     * store data.
     */
    public function store(ProductRequest $request)
    {

        $product = Product::create($request->all());

        // Sync categories
        if($request->categories){
            $product->categories()->sync($request->categories); // array of category_id
        }

        Cache::tags(['products'])->flush();

        return redirect()->back()->with('message', toTitle($product->title).' has been updated');
    }

    /**
     * Edit view.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategoryRepository::all();
        $categories = ListCategoryResource::collection($categories)->resolve();
        return Inertia::render(vueFormExist(type(), 'product', 'form'), [
            'product' => ProductResource::make($product)->resolve(),
            'categories' => $categories,
            'type' => type(),
            'method' => 'update',
            'title' => 'Edit '.'Product',
            'locale' => app()->getLocale(),
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard.index'),
                ],
                [
                    'text' => 'Product',
                    'url' => route('product.index'),
                ],
            ],
        ]);
    }

    /**
     * Update Data.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        // Sync categories
        if($request->categories){
            $product->categories()->sync(collect($request->categories)->pluck('id')); // array of category_id
        }


        Cache::tags(['products'])->flush();

        return redirect()->back()->with('message', toTitle($product->title).' has been updated');
    }

    /**
     * Remove the specified resource from storage temporary.
     */
    public function delete($product)
    {
        $product = Product::find($product);
        if (!$product) {
            return abort(404);
        }
        $product->delete();

        Cache::tags(['products'])->flush();

        return redirect()->route('product.index')->with('message', toTitle($product->title.' hase been deleted'));
    }

    /**
     * Remove data permanently.
     */
    public function destroy($product)
    {
        $product = Product::withTrashed()->find($product);
        if (!$product) {
            return abort(404);
        }
        $product->forceDelete();

        Cache::tags(['products'])->flush();

        return redirect()->route('product.index')->with('message', toTitle($product->title.' hase been destroyed'));
    }

    public function destroyAll()
    {
        $ids = explode(',', request('selected'));
        $products = Product::whereIn('_id', $ids)->withTrashed()->get();
        foreach ($products as $product) {
            $product->forceDelete();
        }
        Cache::tags(['products'])->flush();

        return redirect()->route('product.index')->with('message', toTitle($product->title).' has been destroyed');
    }

    /**
     * Restore Data from trash.
     */
    public function restore($product)
    {
        $product = Product::withTrashed()->find($product);
        if (!$product) {
            return abort(404);
        }
        $product->restore();
        Cache::tags(['products'])->flush();

        return redirect()->route('product.index')->with('message', toTitle($product->title).' has been restored');
    }
 
}