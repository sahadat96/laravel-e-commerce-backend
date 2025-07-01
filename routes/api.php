<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\ProductControllerFrontend;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Frontend\AreaControlleFrontend;
use App\Http\Controllers\Frontend\ProductOrderController;
// use App\Http\Controllers\Backend\OrderBackendController;

// Apply CORS middleware to all API routes
// Route::middleware([
//     \Illuminate\Http\Middleware\HandleCors::class,
//     // other middleware...
// ])->group(function () {
   


// });


Route::get('/slider', [SliderController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'getCategories']);
Route::get('/getallproducts', [ProductControllerFrontend::class, 'getAllProducts']);
Route::get('/special_deals', [ProductControllerFrontend::class, 'special_deals']);
Route::get('/search_products', [ProductControllerFrontend::class, 'search_products']);

//category wize product page
Route::get('/category/{slug}/products', [ProductControllerFrontend::class, 'getCategoryProducts']);
Route::get('/subcategory/{slug}/products', [ProductControllerFrontend::class, 'getSubCategoryProducts']);

//Product Details
Route::get('/getproductdetails/{id}', [ProductControllerFrontend::Class, 'productDetails']);

//User Management
Route::post('/userlogin', [UsersController::Class, 'login']);
Route::post('/userregistration', [UsersController::Class, 'registration']);
Route::post('/logout', [UsersController::Class, 'logout']);

// User Management with authenticated
Route::middleware(['auth:api'])->group(function () {
    Route::get('/getauthuser', [UsersController::Class, 'getAuthUser']);
}); 

// Product Management
Route::middleware(['auth:api'])->group(function () {
    Route::post('/addtocart', [ProductControllerFrontend::Class, 'addtocart']);
    Route::get('/getcart', [ProductControllerFrontend::Class, 'getcart']);
    Route::delete('/cartdelete/{cartId}', [ProductControllerFrontend::Class, 'removeCart']);
    Route::get('/getauthuser', [UsersController::Class, 'getAuthUser']);
    Route::post('/place-order', [ProductOrderController::Class, 'place_order']);
    Route::get('get_order', [ProductOrderController::Class, 'order_show']);
    Route::get('getOrderDetails/{id}', [ProductOrderController::class, 'orderDetails']);
}); 

// Get division
Route::get('/divisions', [AreaControlleFrontend::Class, 'getDivision']);
Route::get('/districts/{division_id}', [AreaControlleFrontend::Class, 'get_districts']);
Route::get('/states/{district_id}', [AreaControlleFrontend::Class, 'get_states']);







// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
