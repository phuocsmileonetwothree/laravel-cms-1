<?php

use App\Http\Controllers\CMS\API\ModuleController;
use App\Http\Controllers\CMS\API\PageController;
use App\Http\Controllers\CMS\API\Category\BaseController;
use App\Http\Controllers\CMS\API\CategoryTypeController;
use App\Http\Controllers\CMS\API\DesignController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CMS\API\Category\CollectionController;
use App\Http\Controllers\CMS\API\Category\AssetController;
use App\Http\Controllers\CMS\API\Category\NavigationController;
use App\Http\Controllers\CMS\API\Category\ClassificationController;
use App\Http\Controllers\CMS\API\Category\FormController;
use App\Http\Controllers\CMS\API\Category\GlobalController;
use App\Http\Controllers\CMS\API\TemplateController;
use App\Models\CMS\Page;
// Import Below Here




use App\Http\Controllers\CMS\API\Item\ProductController;


use App\Http\Controllers\CMS\API\Item\FormContactController;

use App\Http\Controllers\CMS\API\Item\FormTestController;

use App\Http\Controllers\CMS\API\Item\FormSaleController;

use App\Http\Controllers\CMS\API\Item\PostController;

use App\Http\Controllers\CMS\API\Item\DịchVụController;
// const BREAKPOINT_USE = 'DO NOT DELETE OR MOVE';



// Lấy danh sách các trang từ CmsPage kèm theo thông tin của template
$pages = Page::with('template')->get();

// Đăng ký route cho từng trang
foreach ($pages as $page) {
    if ($page->is_homepage) {
        Route::get('/', function () use ($page) {
            return dispatchPage($page);
        })->name('cms.page.home');
    } else {
        Route::get('/' . $page->slug, function () use ($page) {
            return dispatchPage($page);
        })->name('cms.page.'.$page->slug);
    }
}

Route::prefix('cms/api')->name('cms.api.')->group(function () {
    Route::apiResources([
        'template' => TemplateController::class,
        'category-type' => CategoryTypeController::class,
        'category' => BaseController::class,
        'design' => DesignController::class,
        'page' => PageController::class,
        'module' => ModuleController::class,
        'collection' => CollectionController::class,
        'navigation' => NavigationController::class,
        'classification' => ClassificationController::class,
        'asset' => AssetController::class,
        'form' => FormController::class,
        'global' => GlobalController::class,
    ]);


    
Route::name('item.')->prefix('item')->group(function () {
    Route::get('product/category', [ProductController::class, 'category'])->name('product.category');
    Route::apiResources([
        'product' => ProductController::class,
    ]);
});

Route::name('item.')->prefix('item')->group(function () {
    Route::get('form-contact/category', [FormContactController::class, 'category'])->name('form-contact.category');
    Route::post('form-contact/store-and-send-mail', [FormContactController::class, 'storeAndSendMail'])->name('form-contact.store-and-send-mail');
    Route::apiResources([
        'form-contact' => FormContactController::class,
    ]);
});


Route::name('item.')->prefix('item')->group(function () {
    Route::get('form-sale/category', [FormSaleController::class, 'category'])->name('form-sale.category');
    Route::post('form-sale/store-and-send-mail', [FormSaleController::class, 'storeAndSendMail'])->name('form-sale.store-and-send-mail');
    Route::apiResources([
        'form-sale' => FormSaleController::class,
    ]);
});

Route::name('item.')->prefix('item')->group(function () {
    Route::get('post/category', [PostController::class, 'category'])->name('post.category');
    Route::apiResources([
        'post' => PostController::class,
    ]);
});
// const BREAKPOINT_ROUTE = 'DO NOT DELETE OR MOVE';
});


Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
// Route bắt tất cả các yêu cầu cho cms
Route::get('/cms/{any?}', function () {
    return view('cms.layout');
})->where('any', '.*');

