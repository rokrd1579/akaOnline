<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
#Rutas Auth (Registrar, iniciar sesión, recuperar cuenta)
Auth::routes();

// RUTAS SITIO WEB (Rutas públicas)
// RUTAS SITIO WEB
Route::get('/','Controller@index') ->name('index.sitio.web');
Route::group(['prefix' => 'cart'], function() {
    Route::get('/', 'CartController@cart')->name('cart');
    Route::post('/add', 'CartController@add')->name('cart.store');
    Route::get('/add', 'CartController@back');
    Route::get('/update', 'CartController@update')->name('cart.update');
    Route::post('/remove', 'CartController@remove')->name('cart.remove');
    Route::get('/remove', 'CartController@back');
    Route::post('/clear', 'CartController@clear')->name('cart.clear');
    Route::get('/clear', 'CartController@back');
});

Route::get('/product', 'Controller@product')->name('product');
Route::get('/search', 'ProductsController@search')->name('search');
Route::post('/receipts', 'OrdersController@receipts')->name('receipts');
Route::get('/receipts', 'OrdersController@receipts')->name('receipts');
Route::get('/about','Controller@about')->name('about');
Route::get('/show/{slug}','ProductsController@show')->name('show');
Route::get('/track/order','Controller@track_order')->name('track_order');
Route::get('/tracing','Controller@tracing')->name('tracing');

Route::get('/checkout/confirmation','CheckoutController@confirmation')->name('confirmation');
Route::post('/checkout/confirmation','CheckoutController@confirmation')->name('confirmation');
Route::post('/checkout/cco','CheckoutController@createCookies')->name('ccookies');
Route::get('/checkout/clear','CheckoutController@deleteCookies')->name('deleteCookies');

#-----------------------------------------------------------------------------------------------------------
Route::get('/menu-categories', 'controller@menucategories')->name('menucategories');
#-----------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------
Route::get('/product/bestsellers', 'controller@bestseller')->name('bestseller');
Route::get('/product/news', 'controller@news')->name('news');
Route::get('/product/promotions', 'controller@promotions')->name('promotions');
# #-----------------------------------------------------------------------------------------------------------
#--------------------Ruta del catálogo general--------------------------------------------------------------
Route::get('/categories/{category}', 'controller@catalogue_categories')->name('catalogue_categories');
#-----------------------------------------------------------------------------------------------------------
# #-----------------------------------------------------------------------------------------------------------
Route::get('/terms-and-conditions', 'controller@terms_conditions')->name('terms_conditions');
Route::get('/notice-privacy', 'controller@notice_privacy')->name('notice_privacy');
# #-----------------------------------------------------------------------------------------------------------

#   RUTAS  - Perfil ----------------------------------------------------------------------------------
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::post('/profile/store', 'ProfileController@profile_store')->name('profile_store');
Route::get('/profile/update', 'ProfileController@profile_update')->name('profile_update');
Route::get('/profile/address_update', 'ProfileController@address_update')->name('address_update');
Route::get('/profile/address_store', 'ProfileController@address_store')->name('address_store');
Route::get('/profile/usuario', 'ProfileController@user_update')->name('user_update');
Route::get('/profile/correo', 'ProfileController@email_update')->name('email_update');
Route::get('/profile/password', 'ProfileController@password_update')->name('password_update');

#----Ruta-Notificaiones---------------------------------------------------------------------------
Route::get('allmarks', 'NotificationController@allmarks')->name('allmarks');
Route::get('ordernotification/{notification_id}/{order_id}', 'NotificationController@ordernotification')->name('ordernotification');
# ----------------------------------------------------------------------------------------------------


Route::get('/help','HelpController@help')->name('help');
Route::get('/help/freq','HelpController@freq')->name('frequents');
Route::get('/ordenes','Controller@orden')->name('orden');


#Rutas para administración
Route::name('admin.')->prefix('admin')->middleware(['admin','auth'])->group(function () {
    Route::get('dash',function(){
        return view ('dashboard');
    })->name('dashboard');
    Route::resource('/users', 'admin\UsersController');
    Route::resource('/business', 'admin\BusinessController');
    Route::resource('/products', 'admin\ProductsController');
    Route::resource('/category', 'admin\CategoryController');
    Route::resource('/sales', 'admin\SalesController');
    Route::resource('/orders', 'admin\OrdersController');
    Route::resource('/promotions', 'admin\PromotionsController');
    //Route::delete('/deleteimage/{id}', 'admin\ProductsController')->name('admin.products');
});

#Rutas para admin sellers y buyers
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('index');
    Route::post('/checkout','CheckoutController@checkout')->name('checkout');
    Route::get('/checkout','CheckoutController@checkout')->name('checkout');
    Route::get('/history', 'OrdersController@history')->name('history');
    Route::post('/configuration/{config}', 'ConfigController@configuration')->name('configuration');   
    Route::post('/question','QuestionController@new')->name('question');
    Route::get('/question','CartController@back')->name('question');
    Route::get('/review', 'CartController@back')->name('review');
    Route::post('/review', 'ReviewController@consulta')->name('review');
    Route::post('/reviewdelete', 'ReviewController@delete')->name('reviewdelete');
    Route::get('/reviewdelete', 'CartController@back')->name('reviewdelete');
    Route::get('/reviewcreate', 'CartController@back')->name('reviewcreate');
    Route::post('/reviewcreate', 'ReviewController@create')->name('reviewcreate');
    Route::post('/help/returns','HelpController@returns')->name('returns');
    Route::get('/help/returns','HelpController@returns')->name('returns');
    Route::get('/help/returns/operation','HelpController@operacion')->name('operacion');
    Route::resource('/response','ResponseController');
});

