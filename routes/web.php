<?php

use AcitJazz\ProductCatalog\Http\Controllers\ProductController;
use AcitJazz\ProductCatalog\Http\Controllers\ProductCategoryController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web', 'auth.admin'])->prefix('backend')->group(function () {

    // Product
    Route::post('/product/destroy-all', [ProductController::class, 'destroyAll'])->name('product.destroy-all')->middleware('role_or_permission_admin:Master|Editor|Delete Product');
    Route::post('/product/{product}/delete', [ProductController::class, 'delete'])->name('product.delete')->middleware('role_or_permission_admin:Master|Editor|Delete Product');
    Route::post('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.forceDelete')->middleware('role_or_permission_admin:Master|Editor|Delete Product');
    Route::post('/product/{product}/restore', [ProductController::class, 'restore'])->name('product.restore')->middleware('role_or_permission_admin:Master|Editor|Delete Product');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index')->middleware('role_or_permission_admin:Master|Editor|View Product');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create')->middleware('role_or_permission_admin:Master|Editor|Create Product');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store')->middleware('role_or_permission_admin:Master|Editor|Create Product');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit')->middleware('role_or_permission_admin:Master|Editor|Edit Product');
    Route::patch('/product/{product}', [ProductController::class, 'update'])->name('product.update')->middleware('role_or_permission_admin:Master|Editor|Edit Product');

    // ProductCategory
    Route::post('/product-category/destroy-all', [ProductCategoryController::class, 'destroyAll'])->name('product-category.destroy-all')->middleware('role_or_permission_admin:Master|Editor|Delete Product Category');
    Route::post('/product-category/{product_category}/delete', [ProductCategoryController::class, 'delete'])->name('product-category.delete')->middleware('role_or_permission_admin:Master|Editor|Delete Product Category');
    Route::post('/product-category/{product_category}/destroy', [ProductCategoryController::class, 'destroy'])->name('product-category.forceDelete')->middleware('role_or_permission_admin:Master|Editor|Delete Product Category');
    Route::post('/product-category/{product_category}/restore', [ProductCategoryController::class, 'restore'])->name('product-category.restore')->middleware('role_or_permission_admin:Master|Editor|Delete Product Category');
    Route::get('/product-category', [ProductCategoryController::class, 'index'])->name('product-category.index')->middleware('role_or_permission_admin:Master|Editor|View Product Category');
    Route::get('/product-category/create', [ProductCategoryController::class, 'create'])->name('product-category.create')->middleware('role_or_permission_admin:Master|Editor|Create Product Category');
    Route::post('/product-category', [ProductCategoryController::class, 'store'])->name('product-category.store')->middleware('role_or_permission_admin:Master|Editor|Create Product Category');
    Route::get('/product-category/{product_category}/edit', [ProductCategoryController::class, 'edit'])->name('product-category.edit')->middleware('role_or_permission_admin:Master|Editor|Edit Product Category');
    Route::patch('/product-category/{product_category}', [ProductCategoryController::class, 'update'])->name('product-category.update')->middleware('role_or_permission_admin:Master|Editor|Edit Product Category');

});