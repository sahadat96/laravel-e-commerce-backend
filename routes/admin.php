<?php

use Illuminate\Support\Facades\Route;

//Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderBackendController;

//Vendor
use App\Http\Controllers\Vendor\VendorController;


// Admin
   // Admin Routes without login
   
   Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
   
   

 Route::get('/', [AdminController::class, 'login'])->name('admin.login');

// admin with login

Route::middleware(['auth'])->group(function (){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
   Route::post('/admin/profile/update{id}', [AdminController::class, 'updateprofile'])->name('admin.profile.update');

    // category managment
    Route::group(['prefix' => '/admin/category'], function(){
        Route::get('/add', [CategoryController::class, 'index'])->name('category');
        Route::post('/store', [CategoryController::class, 'store'])->name('add.category');
        Route::get('/manage', [CategoryController::class, 'show'])->name('manage.category');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update.category');
        Route::get('/delete/{id}',[CategoryController::class,'destroy'])->name('delete.category');

    });

    // Sub Category managment
    Route::group(['prefix' => '/admin/subcategory'], function(){
        Route::get('/add', [SubCategoryController::class, 'index'])->name('subcategory');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('add.subcategory');
        Route::get('/manage', [SubCategoryController::class, 'show'])->name('manage.subcategory');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('edit.subcategory');
        Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('update.subcategory');
        Route::get('/delete/{id}',[SubCategoryController::class,'destroy'])->name('delete.subcategory');

    });

    // Brands managment
    Route::group(['prefix' => '/admin/brand'], function(){
        Route::get('/add', [BrandController::class, 'index'])->name('brand');
        Route::post('/store', [BrandController::class, 'store'])->name('add.brand');
        Route::get('/manage', [BrandController::class, 'show'])->name('manage.brand');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('edit.brand');
        Route::post('/update/{id}', [BrandController::class, 'update'])->name('update.brand');
        Route::get('/delete/{id}',[BrandController::class,'destroy'])->name('delete.brand');

    });

    //  Product managment 
    Route::group(['prefix' => '/admin/product'], function(){
        Route::get('/add', [ProductController::class, 'index'])->name('product');
        Route::post('/store', [ProductController::class, 'store'])->name('add.product');
        Route::get('/manage', [ProductController::class, 'show'])->name('manage.product');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product_edite');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('update.product');
        Route::get('/delete/{id}',[ProductController::class,'productDelete'])->name('product_delete');

    });

    //Route for review revie management by admin
    Route::group(['prefix' => '/admin/product/review'], function(){
        Route::get('/pending/review', [ReviewController::class, 'pending_review'])->name('pending.review');
        Route::get('/updated/review/{id}', [ReviewController::class, 'update_review'])->name('updated.review');
        Route::get('/review/published', [ReviewController::class, 'published_review'])->name('published.review');
        Route::get('/delete/review/{id}', [ReviewController::class, 'delete_review'])->name('delete.review');
        
    });

    //Shipping Area Mangement
    Route::group(['prefix' => '/admin/shippingarea'], function(){
        //for division
        Route::get('/division', [ShippingAreaController::class, 'index'])->name('shipping.division');
        Route::post('/add/division', [ShippingAreaController::class, 'create'])->name('add.division');
        Route::get('/division/Manage', [ShippingAreaController::class, 'showDivision'])->name('show_division');
        Route::get('/division/delete/{id}', [ShippingAreaController::class, 'deleteDivision'])->name('delete_division');

    //for distric
        Route::get('/distric', [ShippingAreaController::class, 'distric'])->name('distric');
        Route::post('/distric/add', [ShippingAreaController::class, 'addDistric'])->name('add_distric');
        Route::get('/distric/show', [ShippingAreaController::class, 'showDistric'])->name('showDistric');
        Route::get('/distric/delete/{id}', [ShippingAreaController::class, 'deletDistric'])->name('deleteDistric');
    //For State
        Route::get('/state', [ShippingAreaController::class, 'state'])->name('distric_state');
        Route::post('/add/state', [ShippingAreaController::class, 'addState'])->name('add_state');
        Route::get('/show/state', [ShippingAreaController::class, 'showState'])->name('show_state');
        Route::get('/deletstate/{id}', [ShippingAreaController::class, 'deleteState'])->name('state_delete');

        });

        Route::get('/district/ajax/{division_id}', [ShippingAreaController::class, 'getDistrict'])->name('district.ajax');

        //Order Mangement

        Route::group(['prefix' => '/admin/order/management'], function(){
            Route::get('/pending/order', [OrderBackendController::class, 'showOrder'])->name('pending.order');
            Route::get('/pending/order/details/{order_id}', [OrderBackendController::class, 'orderDetails'])->name('order_details');
            Route::get('/order/confirm/{id}', [OrderBackendController::class, 'confirm'])->name('confirm.order');
            Route::get('/confirmed/order', [OrderBackendController::class, 'get_confirmed_order'])->name('confirmed.order');
            Route::get('/proccessing/order', [OrderBackendController::class, 'get_proccesing_order'])->name('proccessing.order');
            Route::get('/shiped/order', [OrderBackendController::class, 'get_shiped_order'])->name('shiped.order');
            Route::get('/delivered/order', [OrderBackendController::class, 'get_delivered_order'])->name('delivered.order');
            Route::get('/received/order', [OrderBackendController::class, 'get_received_order'])->name('received.order');
            
        });


        //Route for Slider managment
        Route::group(['prefix' => '/admin/slider'], function(){
            Route::get('/add/slider', [SliderController::class, 'index'])->name('add.slider');
            Route::post('/store/slider', [SliderController::class,'create'])->name('create.slider');
            Route::get('/manage/slider', [SliderController::class, 'manage'])->name('slider.manage');
            Route::get('/delete/slider/{id}', [SliderController::class, 'delete'])->name('delete.slider');
            
        });
        

 });




// Vendor Routes
     //with login
    //  Route::middleware('vendor', )->group(function () {
    //     Route::get('/vendor/dashboard',[VendorController::class, 'dashboard'])->name('vendor.dashboard');
    //     Route::post('/vendor/logout', [VendorController::class, 'logout'])->name('vendor.logout');
        
    // });
    
    
    // Route::post('/vregister',[VendorController::class, 'registration'])->name('vendor.register');
    
    //  //Route::get('/vendor',[VendorRegisterController::class, 'create']);
    // Route::get('/vendor/register',[VendorController::class, 'index']);
       
    // Route::get('/vendor/login',[VendorController::class, 'loginpage'])->name('vendor_login_page');
    // Route::post('/vendor',[VendorController::class, 'login'])->name('vendor_login');