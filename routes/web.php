<?php

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

Route::post('/login', 'LoginController@DoLogin');
Route::get('/login', 'LoginController@Index');

Route::get('/reset-password/', 'LoginController@ResetView');
Route::post('/reset-password', 'LoginController@ResetAction');

Route::get('/reset-password/{email}', 'LoginController@ResetViewToken');
Route::post('/reset-password/{email}', 'LoginController@ResetViewTokenDo');

Route::get('/logout', function(){
  Auth::logout();
  return redirect('/login');
});

Route::get('/', function(){
  return redirect('/dashboard/');
});

Route::get('/register', 'RegisterController@Index');
Route::post('/register', 'RegisterController@CreateUser');


Route::group(['middleware' => ['auth']], function () {

  Route::get('/dashboard', 'HomeController@Index');

  /* Profile section */
  Route::get('/profile/{profileId}/', 'ProfileController@ViewProfile')->where(['profileId' => '[0-9]+']);
  Route::get('/profile/edit/', 'ProfileController@EditProfile');
  Route::post('/profile/edit/', 'ProfileController@UpdateProfile');
  Route::get('/profile/removeCertificate/{count}/', 'ProfileController@RemoveCertificate');

  /* Demand section */
  Route::get('/demand/create/', 'DemandController@CreateDemand');
  Route::post('/demand/create/', 'DemandController@SubmitDemand');
  Route::get('/demand/{demandId}/', 'DemandController@ViewDemand');
  Route::post('demand/addcomment/', 'DemandController@AddComment');
  Route::get('/mydemands', 'DemandController@MyDemands');


  Route::post('/demand/{demandId}/', 'DemandController@DemandDo');
  Route::get('/place-bid/{demandId}/{price}', 'DemandController@placeBid');
  Route::post('/place-bid/{demandId}/{price}', 'DemandController@placeBidStore');
  Route::get('/order-completed/{orderId}/', 'DemandController@orderCompleted');






  // Route::get('/customer/home', 'CustomerController@Index');
  // Route::get('/customer/profile/{customerId}', 'CustomerController@Profile')->where(['customerId' => '[0-9]']);
  // Route::get('/customer/profile/edit', 'CustomerController@EditProfile');
  // Route::post('/customer/profile/edit', 'ProfileController@Update');
  //
  // Route::get('/customer/orders', 'CustomerController@Index');

  /* Supplier */
  // Route::get('/supplier/profile/{supplierId}', 'SuppliersController@Profile')->where(['supplierId' => '[0-9]']);
  // Route::get('/supplier/profile/edit', 'SuppliersController@EditProfile');
  // Route::post('/supplier/profile/edit', 'ProfileController@Update');
  // Route::get('/supplier/profile/{supplierId}', 'CustomerController@Index');

});

// Route::get('/home', 'HomeController@index')->name('home');
