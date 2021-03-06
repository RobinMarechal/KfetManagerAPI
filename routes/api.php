<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('kfet')->group(function () {

    Route::get('/', 'KfetController@all')->name('kfet.all'); // 200
    Route::get('{id}', 'KfetController@getById')->name('kfet.getById'); // 200
    Route::get('last', 'KfetController@getLast')->name('kfet.getLast'); // 200
    Route::get('first', 'KfetController@getFirst')->name('kfet.getFirst'); // 200
});

Route::prefix('categories')->group(function () {
    Route::get('/', 'CategoriesController@all')->name('categories.all'); // 200
    Route::post('/', 'CategoriesController@post')->name('categories.post'); // 200

    Route::prefix('menus')->group(function()
    {
        Route::get('/', 'CategoryMenusController@all')->name('categories.menus.all');
        Route::post('/', 'CategoryMenusController@post')->name('categories.menus.post'); // 200

        Route::prefix('{id}')->group(function () {
            Route::get('/', 'CategoryMenusController@getById')->name('categories.menus.getById'); // 200
            Route::put('/', 'CategoryMenusController@put')->name('categories.menus.put'); // 200
            Route::delete('/', 'CategoryMenusController@delete')->name('categories.menus.delete'); // 200

            Route::get('menu', 'CategoryMenusController@getMenu')->name('categories.menus.getMenu');

            Route::get('category', 'CategoryMenusController@getCategory')->name('categories.menus.getCategory');
        });
        
    });

    Route::prefix('{id}')->group(function () {

        Route::get('/', 'CategoriesController@getById')->name('categories.getById'); // 200
        Route::put('/', 'CategoriesController@put')->name('categories.put'); // 200
        Route::delete('/', 'CategoriesController@delete')->name('categories.delete'); // 200


        Route::prefix('menus')->group(function () {
            Route::get('/{menuId?}', 'CategoriesController@getMenus')->name('categories.getMenus'); // 200
        });

        Route::prefix('subcategories')->group(function () {
            Route::get('/{subcategoryId?}', 'CategoriesController@getSubcategories')->name('categories.getSubcategories'); // 200
        });

        Route::prefix('products')->group(function () {
            Route::get('/{productId?}', 'CategoriesController@getProducts')->name('categories.getProducts'); // 200
        });
    });
});

Route::prefix('subcategories')->group(function () {
    Route::get('/', 'SubcategoriesController@all')->name('subcategories.all'); // 200
    Route::post('/', 'SubcategoriesController@post')->name('subcategories.post'); // 200

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'SubcategoriesController@getById')->name('subcategories.getById'); // 200
        Route::put('/', 'SubcategoriesController@put')->name('subcategories.put'); // 200
        Route::delete('/', 'SubcategoriesController@delete')->name('subcategories.delete'); // 200

        Route::prefix('category')->group(function () {
            Route::get('/', 'SubcategoriesController@getCategory')->name('subcategories.getCategory'); // 200
        });

        Route::prefix('products/{productId?}')->group(function () {
            Route::get('/', 'SubcategoriesController@getProducts')->name('subcategories.getProducts'); // 200
        });
    });
});

Route::prefix('menus')->group(function () {
    Route::get('/', 'MenusController@all')->name('menus.all'); // 200
    Route::post('/', 'MenusController@post')->name('menus.post'); // 200

    Route::prefix('categories')->group(function()
    {
        Route::get('/', 'CategoryMenusController@all')->name('menus.categories.all');
        Route::post('/', 'CategoryMenusController@post')->name('menus.categories.post'); // 200

        Route::prefix('{id}')->group(function () {
            Route::get('/', 'CategoryMenusController@getById')->name('menus.categories.getById'); // 200
            Route::put('/', 'CategoryMenusController@put')->name('menus.categories.put'); // 200
            Route::delete('/', 'CategoryMenusController@delete')->name('menus.categories.delete'); // 200

            Route::get('menu', 'CategoryMenusController@getMenu')->name('menus.categories.getMenu');

            Route::get('category', 'CategoryMenusController@getCategory')->name('menus.categories.getCategory');
        });
    });

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'MenusController@getById')->name('menus.getById'); // 200
        Route::put('/', 'MenusController@put')->name('menus.put'); // 200
        Route::delete('/', 'MenusController@delete')->name('menus.delete'); // 200

        Route::prefix('categories')->group(function () {
            Route::get('/{categoryId?}', 'MenusController@getCategories')->name('menus.getCategories'); // 200
        });

        Route::prefix('orders')->group(function () {
            Route::get('/{orderId?}', 'MenusController@getOrders')->name('menus.getOrders'); // 200
        });

        Route::prefix('customers')->group(function () {
            Route::get('/{customerId?}', 'MenusController@getCustomers')->name('menus.getCustomers');
        });
    });
});

Route::prefix('staff')->group(function () {
    Route::get('/', 'StaffController@all')->name('staff.all'); // 200
    Route::post('/', 'StaffController@post')->name('staff.post'); // 200


    Route::prefix('{id}')->group(function () {
        Route::get('/', 'StaffController@getById')->name('staff.getById'); // 200
        Route::put('/', 'StaffController@put')->name('staff.put'); // 200
        Route::delete('/', 'StaffController@delete')->name('staff.delete'); // 200

        Route::prefix('customer')->group(function () {
            Route::get('/', 'StaffController@getCustomer')->name('staff.getCustomer'); // 200
        });
    });
});

Route::prefix('customers')->group(function () {
    Route::get('/', 'CustomersController@all')->name('customers.all'); // 200
    Route::post('/', 'CustomersController@post')->name('customers.post'); // 200

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'CustomersController@getById')->name('customers.getById'); // 200
        Route::put('/', 'CustomersController@put')->name('customers.put'); // 200
        Route::delete('/', 'CustomersController@delete')->name('customers.delete'); // 200

        Route::prefix('staff')->group(function () {
            Route::get('/', 'CustomersController@getStaff')->name('customers.getStaff'); // 200
        });

        Route::prefix('orders')->group(function () {
            Route::get('/{orderId?}', 'CustomersController@getOrders')->name('customers.getOrders'); // 200
            Route::get('last', 'CustomersController@lastOrder')->name('customers.lastOrder'); // 200
        });

        Route::prefix('menus')->group(function () {
            Route::get('/{menuId?}', 'CustomersController@getMenus')->name('customers.getMenus');
        });
    });
});

Route::prefix('orders')->group(function () {
    Route::get('/', 'OrdersController@all')->name('orders.all'); // 200
    Route::post('/', 'OrdersController@post')->name('order.post'); // 200


    Route::prefix('products')->group(function()
    {
        Route::get('/', 'OrderProductsController@all')->name('orders.products.all');
        Route::post('/', 'OrderProductsController@post')->name('orders.products.post'); // 200

        Route::prefix('{id}')->group(function () {
            Route::get('/', 'OrderProductsController@getById')->name('orders.products.getById'); // 200
            Route::put('/', 'OrderProductsController@put')->name('orders.products.put'); // 200
            Route::delete('/', 'OrderProductsController@delete')->name('orders.products.delete'); // 200

            Route::get('order', 'OrderProductsController@getOrder')->name('orders.products.getOrder');

            Route::get('product', 'OrderProductsController@getProduct')->name('orders.products.getCategory');
        });
    });

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'OrdersController@getById')->name('orders.getById'); // 200
        Route::put('/', 'OrdersController@put')->name('orders.put'); // 200
        Route::delete('/', 'OrdersController@delete')->name('orders.delete'); // 200

        Route::get('customer', 'OrdersController@getCustomer')->name('orders.getCustomer'); // 200

        Route::get('menu', 'OrdersController@getMenu')->name('orders.getMenu'); // 200

        Route::prefix('products')->group(function()
        {
            Route::get('/{productId?}', 'OrdersController@getProducts')->name('orders.getProducts'); // 200
        });

        Route::prefix('detail')->group(function() // ALIAS
        {
            Route::get('/{orderProductId?}', 'OrdersController@getOrderProducts')->name('order.getOrderProduct_alias'); // 200
        });

        Route::prefix('orderProducts')->group(function()
        {
            Route::get('/{orderProductId?}', 'OrdersController@getOrderProducts')->name('order.getOrderProduct'); // 200
        });
    });
});

Route::prefix('products')->group(function () {
    Route::get('/', 'ProductsController@all')->name('products.all'); // 200
    Route::post('/', 'ProductsController@post')->name('products.post'); // 200


    Route::prefix('orders')->group(function()
    {
        Route::get('/', 'OrderProductsController@all')->name('products.orders.all');
        Route::post('/', 'OrderProductsController@post')->name('products.orders.post'); // 200

        Route::prefix('{id}')->group(function () {
            Route::get('/', 'OrderProductsController@getById')->name('products.orders.getById'); // 200
            Route::put('/', 'OrderProductsController@put')->name('products.orders.put'); // 200
            Route::delete('/', 'OrderProductsController@delete')->name('products.orders.delete'); // 200

            Route::get('order', 'OrderProductsController@getOrder')->name('products.orders.getOrder');

            Route::get('product', 'OrderProductsController@getProduct')->name('products.orders.getProduct');
        });
    });


    Route::prefix('restockings')->group(function()
    {
        Route::get('/', 'ProductRestockingsController@all')->name('products.restockings.all');
        Route::post('/', 'ProductRestockingsController@post')->name('products.restockings.post'); // 200

        Route::prefix('{id}')->group(function () {
            Route::get('/', 'ProductRestockingsController@getById')->name('products.restockings.getById'); // 200
            Route::put('/', 'ProductRestockingsController@put')->name('products.restockings.put'); // 200
            Route::delete('/', 'ProductRestockingsController@delete')->name('products.restockings.delete'); // 200

            Route::get('product', 'ProductRestockingsController@getProduct')->name('products.restockings.getProduct');

            Route::get('restocking', 'ProductRestockingsController@getRestocking')->name('products.restockings.getRestocking');
        });
    });

    Route::prefix('events')->group(function()
    {
        Route::get('/', 'EventProductsController@all')->name('products.events.all');
        Route::post('/', 'EventProductsController@post')->name('products.events.post');

        Route::prefix('{id}')->group(function () {
            Route::get('/', 'EventProductsController@getById')->name('products.events.getById'); // 200
            Route::put('/', 'EventProductsController@put')->name('products.events.put'); // 200
            Route::delete('/', 'EventProductsController@delete')->name('products.events.delete'); // 200

            Route::get('event', 'EventProductsController@getEvent')->name('products.events.getEvent'); // 200
            Route::get('product', 'EventProductsController@getProduct')->name('products.events.getProduct'); // 200
        });
    });

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'ProductsController@getById')->name('products.getById'); // 200
        Route::put('/', 'ProductsController@put')->name('products.put'); // 200
        Route::delete('/', 'ProductsController@delete')->name('products.delete'); // 200

        Route::prefix('orders')->group(function () {
            Route::get('/{orderId?}', 'ProductsController@getOrders')->name('products.getOrders'); // 200
        });

        Route::prefix('orderProducts')->group(function()
        {
            Route::get('/{orderProductId?}', 'OrdersController@getOrderProducts')->name('order.getOrderProduct'); // 200
        });

        Route::prefix('subcategory')->group(function () {
            Route::get('/', 'ProductsController@getSubcategory')->name('products.getSubcategory'); // 200
        });

        Route::prefix('category')->group(function () {
            Route::get('/', 'ProductsController@getCategory')->name('products.getCategory'); // 200
        });

        Route::prefix('restockings')->group(function () {
            Route::get('/{restockingId?}', 'ProductsController@getRestockings')->name('products.getRestockings'); // 200
        });

        Route::prefix('events')->group(function()
        {
            Route::get('/{eventId?}', 'ProductsController@getEvents')->name('products.getEvents');
        });


    });
});


Route::prefix('events')->group(function () {
    Route::get('/', 'EventsController@all')->name('events.all'); // 200
    Route::post('/', 'EventsController@post')->name('events.post'); // 200

    Route::prefix('accessories')->group(function()
    {
        Route::get('/', 'EventAccessoriesController@all')->name('events.accessories.all');
        Route::post('/', 'EventAccessoriesController@post')->name('events.accessories.post');

        Route::prefix('{id}')->group(function () {
            Route::get('/', 'EventAccessoriesController@getById')->name('events.accessories.getById'); // 200
            Route::put('/', 'EventAccessoriesController@put')->name('events.accessories.put'); // 200
            Route::delete('/', 'EventAccessoriesController@delete')->name('events.accessories.delete'); // 200

            Route::get('event', 'EventAccessoriesController@getEvent')->name('events.accessories.getEvent'); // 200
        });
    });

    Route::prefix('products')->group(function()
    {
        Route::get('/', 'EventProductsController@all')->name('events.products.all');
        Route::post('/', 'EventProductsController@post')->name('events.products.post');

        Route::prefix('{id}')->group(function () {
            Route::get('/', 'EventProductsController@getById')->name('events.products.getById'); // 200
            Route::put('/', 'EventProductsController@put')->name('events.products.put'); // 200
            Route::delete('/', 'EventProductsController@delete')->name('events.products.delete'); // 200

            Route::get('event', 'EventProductsController@getEvent')->name('events.products.getEvent'); // 200
            Route::get('product', 'EventProductsController@getProduct')->name('events.products.getProduct'); // 200
        });
    });

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'EventsController@getById')->name('events.getById'); // 200
        Route::put('/', 'EventsController@put')->name('events.put'); // 200
        Route::delete('/', 'EventsController@delete')->name('events.delete'); // 200

        Route::prefix('accessories')->group(function () {
            Route::get('/{accessoryId?}', 'EventsController@getAccessories')->name('events.getAccessories');  // 200
        });

        Route::prefix('products')->group(function () {
            Route::get('/{productId?}', 'EventsController@getProducts')->name('events.getProducts'); // 200
        });

        Route::prefix('event_products')->group(function () {
            Route::get('/{eventProductId?}', 'EventsController@getEventProducts')->name('events.getEventProducts'); // 200
        });

        Route::prefix('eventProducts')->group(function () {
            Route::get('/{eventProductId?}', 'EventsController@getEventProducts')->name('events.getEventProducts_alias'); // 200
        });
    });
});

Route::prefix('restockings')->group(function () {
    Route::get('/', 'RestockingsController@all')->name('restockings.all'); // 200
    Route::post('/', 'RestockingsController@post')->name('restockings.post'); // 200

    Route::prefix('products')->group(function()
    {
        Route::get('/', 'ProductRestockingsController@all')->name('restockings.products.all');
        Route::post('/', 'ProductRestockingsController@post')->name('restockings.products.post'); // 200

        Route::prefix('{id}')->group(function () {
            Route::get('/', 'ProductRestockingsController@getById')->name('restockings.products.getById'); // 200
            Route::put('/', 'ProductRestockingsController@put')->name('restockings.products.put'); // 200
            Route::delete('/', 'ProductRestockingsController@delete')->name('restockings.products.delete'); // 200

            Route::get('product', 'ProductRestockingsController@getProduct')->name('restockings.products.getProduct');

            Route::get('restocking', 'ProductRestockingsController@getRestocking')->name('restockings.products.getRestocking');
        });
    });

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'RestockingsController@getById')->name('restockings.getById'); // 200
        Route::put('/', 'RestockingsController@put')->name('restockings.put'); // 200
        Route::delete('/', 'RestockingsController@delete')->name('restockings.delete'); // 200

        Route::prefix('products')->group(function () {
            Route::get('/{productId?}', 'RestockingsController@getProducts')->name('restockings.getProducts'); // 200
        });
    });
});

Route::prefix('money_addings')->group(function () {
    Route::get('/', 'MoneyAddingsController@all')->name('money_addings.all'); // 200
    Route::post('/', 'MoneyAddingsController@post')->name('money_addings.post'); // 200

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'MoneyAddingsController@getById')->name('money_addings.getById'); // 200
        Route::put('/', 'MoneyAddingsController@put')->name('money_addings.put'); // 200
        Route::delete('/', 'MoneyAddingsController@delete')->name('money_addings.delete'); // 200
    });
});

Route::prefix('purchases')->group(function () {
    Route::get('/', 'PurchasesController@all')->name('purchases.all'); // 200
    Route::post('/', 'PurchasesController@post')->name('purchases.post'); // 200

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'PurchasesController@getById')->name('purchases.getById'); // 200
        Route::put('/', 'PurchasesController@put')->name('purchases.put'); // 200
        Route::delete('/', 'PurchasesController@delete')->name('purchases.delete'); // 200
    });
});