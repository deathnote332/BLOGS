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

// Authentication Routes...
$this->get('/', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

Route::get('/switch-ajax-transaction'                 ,        'KitchenController@loadajaxPage');

Route::group(['prefix' => 'kitchen','middleware' => 'isKitchen'], function(){
    Route::get('/orders'                             ,         'KitchenController@kitchenPage');

    Route::get('/ingredients'                         ,         'AdministratorController@ingredientPage');
    Route::get('/switch-ajax-ingredient'              ,         'AdministratorController@loadIngredient');
    Route::get('/ingredient/{id}'                   ,        'AdministratorController@viewIngredient');

    Route::get('/menus'                               ,        'AdministratorController@menuPage');
    Route::get('/switch-ajax-menu'                    ,        'AdministratorController@loadMenu');

    Route::get('/menu/{id}'                         ,        'AdministratorController@viewMenu');

    Route::post('/finish_order'                     ,         'KitchenController@finishOrder');


});

Route::group(['prefix' => 'admin','middleware' => 'isAdmin'], function(){

    Route::get('/graphs'                            ,         'AdministratorController@graphPage');
    Route::post('/loadGraph'                        ,        'AdministratorController@loadGraph');
    Route::post('/loadGraph_new'                    ,        'AdministratorController@loadGraph_new');


    Route::get('/ingredients'                       ,        'AdministratorController@ingredientPage');
    Route::get('/switch-ajax-ingredient'            ,        'AdministratorController@loadIngredient');
    Route::post('/add-ingredient'                   ,        'AdministratorController@addIngredient');
    Route::post('/delete-ingredient'                ,        'AdministratorController@deleteIngredient');
    Route::get('/ingredient/{id}'                   ,        'AdministratorController@viewIngredient');
    Route::post('/update-ingredient'                     ,        'AdministratorController@updateIngredient');

    Route::get('/users'                           ,        'AdministratorController@clientPage');
    Route::get('/switch-ajax-user'                  ,        'AdministratorController@loadUser');
    Route::post('/add-user'                         ,        'AdministratorController@addUser');

    Route::get('/menus'                             ,        'AdministratorController@menuPage');
    Route::get('/menu/{id}'                         ,        'AdministratorController@viewMenu');
    Route::get('/switch-ajax-menu'                  ,        'AdministratorController@loadMenu');
    Route::post('/add-menu'                         ,        'AdministratorController@addMenu');
    Route::post('/update-menu'                      ,        'AdministratorController@updateMenu');
    Route::post('/delete-menu'                      ,        'AdministratorController@deleteMenu');


    Route::get('/recipies'                            ,         'AdministratorController@recipePage');
    Route::get('/recipies/{id}'            ,        'AdministratorController@viewRecipe');
    Route::get('/switch-ajax-recipe'            ,        'AdministratorController@loadRecipe');

    Route::post('/savers'            ,        'AdministratorController@saveRecipe');

    Route::get('/list_order'            ,        'AdministratorController@loadlistOrder');
    Route::get('/switch-ajax-order'              ,        'AdministratorController@loadOrder');

    Route::get('/list_order/{id}'            ,        'AdministratorController@loadviewlistOrder');

    Route::post('/add-purchase'                   ,        'AdministratorController@addPurchase');
    Route::get('/getBestSeller'                   ,        'AdministratorController@getBestSeller');

    Route::get('/tables'                        ,        'AdministratorController@tablePage');
    Route::get('/switch-ajax-table'                  ,        'AdministratorController@loadTable');
    Route::post('/addtable'                  ,        'AdministratorController@addTable');

});

Route::group(['prefix' => 'cashier','middleware' => 'isCashier'], function(){
    Route::get('/cashier'                             ,         'CashierController@cashierPage');
    Route::get('/paidorders'                             ,         'CashierController@paidOrders');
    Route::get('/transaction/{id}'                    ,         'CashierController@transactionPage');
    Route::post('/changeToPaid'                    ,         'CashierController@changeToPaid');
    Route::get('/order-list'                    ,         'CashierController@loadajaxPage');
    Route::get('/paidorder-list'                    ,         'CashierController@loadajaxPagePaid');

    Route::get('/transaction/print/{id}'      ,   'CashierController@pdf');
});


Route::group(['prefix' => 'waiter'], function(){
    //authentication for waiter
    Route::post('/loginWaiter'             ,        'MenuController@loginWaiter');
    //registration for waiter
    Route::post('/createWaiter'             ,     'MenuController@createWaiter');
    Route::post('/updateWaiter'            ,        'MenuController@updateWaiter');

    Route::get('/getTable'             ,     'MenuController@getTable');


    Route::get('/getMenu'                 ,        'MenuController@getMenu');
    Route::post('/getMenuList'            ,        'MenuController@getMenuList');

    Route::post('/getTemporaryCart'            ,        'MenuController@getTemporaryCart');

    Route::post('/insertOrder'            ,        'MenuController@insertOrder');

    Route::post('/updateFoodCart'            ,        'MenuController@updateFoodCart');
    Route::post('/deleteFoodCart'            ,        'MenuController@deleteFoodCart');

    Route::post('/createOrder'            ,        'MenuController@createOrder');
    Route::post('/getOrder'            ,        'MenuController@getOrder');
    Route::post('/updateToken'            ,        'MenuController@updateToken');
    Route::get('/sendNoti'            ,        'MenuController@sendNoti');


});


