<?php

use AcitJazz\ProductCatalog\Http\Controllers\Backend\ProductController;
use AcitJazz\ProductCatalog\Http\Controllers\Backend\ProductCategoryController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web', 'auth.admin'])->prefix('backend')->group(function () {

    // Product
    Route::post('/product/destroy-all', [ProductController::class, 'destroyAll'])->name('product.destroy-all')->middleware('admin_permission:Master|Editor|Delete Product');
    Route::post('/product/{product}/delete', [ProductController::class, 'delete'])->name('product.delete')->middleware('admin_permission:Master|Editor|Delete Product');
    Route::post('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.forceDelete')->middleware('admin_permission:Master|Editor|Delete Product');
    Route::post('/product/{product}/restore', [ProductController::class, 'restore'])->name('product.restore')->middleware('admin_permission:Master|Editor|Delete Product');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index')->middleware('admin_permission:Master|Editor|View Product');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create')->middleware('admin_permission:Master|Editor|Create Product');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store')->middleware('admin_permission:Master|Editor|Create Product');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit')->middleware('admin_permission:Master|Editor|Edit Product');
    Route::patch('/product/{product}', [ProductController::class, 'update'])->name('product.update')->middleware('admin_permission:Master|Editor|Edit Product');

    // ProductCategory
    Route::post('/product-category/destroy-all', [ProductCategoryController::class, 'destroyAll'])->name('product-category.destroy-all')->middleware('admin_permission:Master|Editor|Delete Product Category');
    Route::post('/product-category/{product_category}/delete', [ProductCategoryController::class, 'delete'])->name('product-category.delete')->middleware('admin_permission:Master|Editor|Delete Product Category');
    Route::post('/product-category/{product_category}/destroy', [ProductCategoryController::class, 'destroy'])->name('product-category.forceDelete')->middleware('admin_permission:Master|Editor|Delete Product Category');
    Route::post('/product-category/{product_category}/restore', [ProductCategoryController::class, 'restore'])->name('product-category.restore')->middleware('admin_permission:Master|Editor|Delete Product Category');
    Route::get('/product-category', [ProductCategoryController::class, 'index'])->name('product-category.index')->middleware('admin_permission:Master|Editor|View Product Category');
    Route::get('/product-category/create', [ProductCategoryController::class, 'create'])->name('product-category.create')->middleware('admin_permission:Master|Editor|Create Product Category');
    Route::post('/product-category', [ProductCategoryController::class, 'store'])->name('product-category.store')->middleware('admin_permission:Master|Editor|Create Product Category');
    Route::get('/product-category/{product_category}/edit', [ProductCategoryController::class, 'edit'])->name('product-category.edit')->middleware('admin_permission:Master|Editor|Edit Product Category');
    Route::patch('/product-category/{product_category}', [ProductCategoryController::class, 'update'])->name('product-category.update')->middleware('admin_permission:Master|Editor|Edit Product Category');

});