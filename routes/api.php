<?php

use Illuminate\Http\Request;

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

/**
 * All routes related to the kfet table
 * @url .../api/kfet/...
 */
Route::prefix('kfet')->group(function () {

    /**
     * get kfet table record by it's ID
     *
     * @param id the id of the record
     */
    Route::get('{id}', 'KfetController@getById')->name('kfet.getById');

    /**
     * Get all kfet table records that had been recorded between 2 dates
     *
     * @param from the beginning of the period. Format : 'yyyy-MM-dd'
     * @param to   the end of the period. Format 'yyyy-MM-dd'
     */
    Route::get('{from}/{to}', 'KfetController@getFromTo')->name('kfet.getFromTo');

    /**
     * Get the last kfet table record
     */
    Route::get('last', 'KfetController@getLast')->name('kfet.getLast');

    /**
     * Get the first kfet table record
     */
    Route::get('first', 'KfetController@getFirst')->name('kfet.getFirst');
});

/**
 * All the routes directly related to the categories table and its relations
 * @url .../api/categories/...
 */
Route::prefix('categories')->group(function () {
    /**
     * Get all the categories table records
     */
    Route::get('/', 'CategoriesController@all')->name('categories.all');

    /**
     * Create a category
     */
    Route::post('/', 'CategoriesController@post')->name('categories.post');

    /**
     * search for a category
     * @urlParam field the field (ex: name, id etc...)
     * @urlParam value the value of the field
     */
    Route::get('search', 'CategoriesController@search')->name("categories.search");

    /**
     * The routes related to a specific categories table record
     * @url .../api/categories/{id}/...
     *
     * @param id the id or the name of the category
     */
    Route::prefix('{id}')->group(function () {
        /**
         * Get the specific category
         */
        Route::get('/', 'CategoriesController@getById')->name('categories.getById');

        /**
         * Update a specific category
         */
        Route::put('/', 'CategoriesController@put')->name('categories.put');

        /**
         * Delete a specific category
         */
        Route::delete('/', 'CategoriesController@delete')->name('categories.delete');


        /**
         * All routes related to the menus that accept this category
         * @url .../api/categories/{id}/menus/...
         */
        Route::prefix('menus')->group(function () {
            /**
             * Get all the menus that accept this categories
             */
            Route::get('/', 'CategoriesController@getMenus')->name('categories.getMenus');
        });


        /**
         * All routes related to the category's subcategories
         * @url .../api/categories/{id}/subcategories/...
         */
        Route::prefix('subcategories')->group(function () {
            /**
             * Get all the category's subcategories
             */
            Route::get('/', 'CategoriesController@getSubcategories')->name('categories.getSubcategories');
        });

        /**
         * All routes related to the products of this category
         * @url .../api/categories/{id}/products/...
         */
        Route::prefix('products')->group(function () {
            /**
             * Get all the category's products
             */
            Route::get('/', 'CategoriesController@getProducts')->name('categories.getProducts');
        });
    });
});

Route::prefix('subcategories')->group(function () {
    Route::get('/', 'SubcategoriesController@all')->name('subcategories.all');
    Route::post('/', 'SubcategoriesController@post')->name('subcategories.post');

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'SubcategoriesController@getById')->name('subcategories.getById');
        Route::put('/', 'SubcategoriesController@put')->name('subcategories.put');
        Route::delete('/', 'SubcategoriesController@delete')->name('subcategories.delete');

        Route::prefix('category')->group(function () {
            Route::get('/', 'SubcategoriesController@getCategory')->name('subcategories.getCategory');
        });

        Route::prefix('products')->group(function () {
            Route::get('/', 'SubcategoriesController@getProducts')->name('subcategories.getProducts');
        });
    });
});

Route::prefix('menus')->group(function () {
    Route::get('/', 'MenusController@all')->name('menus.all');
    Route::post('/', 'MenusController@post')->name('menus.post');

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'MenusController@getById')->name('menus.getById');
        Route::put('/', 'MenusController@put')->name('menus.put');
        Route::delete('/', 'MenusController@delete')->name('menus.delete');

        Route::prefix('categories')->group(function () {
            Route::get('/', 'MenusController@getCategories')->name('menus.getCategories');
        });

        Route::prefix('orders')->group(function () {
            Route::get('/', 'MenusController@getOrders')->name('menus.getOrders');
        });
    });
});

Route::prefix('staff')->group(function () {
    Route::get('/', 'StaffController@all')->name('staff.all');
    Route::get('customers', 'StaffController@getCustomers')->name('staff.getCustomers');
    Route::post('/', 'StaffController@post')->name('staff.post');


    Route::prefix('{id}')->group(function () {
        Route::get('/', 'StaffController@getById')->name('staff.getById');
        Route::put('/', 'StaffController@put')->name('staff.put');
        Route::delete('/', 'StaffController@delete')->name('staff.delete');

        Route::prefix('customer')->group(function () {
            Route::get('/', 'StaffController@getCustomer')->name('staff.getCustomer');
        });
    });
});

Route::prefix('customers')->group(function () {
    Route::get('/', 'CustomersController@all')->name('customers.all');
    Route::post('/', 'CustomersController@post')->name('customers.post');

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'CustomersController@getById')->name('customers.getById');
        Route::put('/', 'CustomersController@put')->name('customers.put');
        Route::delete('/', 'CustomersController@delete')->name('customers.delete');

        Route::prefix('staff')->group(function () {
            Route::get('/', 'CustomersController@getStaff')->name('customers.getStaff');
        });

        Route::prefix('orders')->group(function () {
            Route::post('/', 'CustomersController@addOrder')->name('customers.addOrder');

            Route::prefix('history')->group(function () {
                Route::get('/', 'CustomersController@orderHistory')->name('customers.orderHistory');
                Route::get('last', 'CustomersController@lastOrder')->name('customers.lastOrder');
                Route::get('{from}/{to}', 'CustomersController@orderHistoryFromTo')
                     ->name('customers.orderHistoryFromTo');
            });
        });
    });
});

Route::prefix('orders')->group(function () {
    Route::get('/', 'OrdersController@all')->name('orders.all');
    Route::post('/', 'OrdersController@post')->name('order.post');
    Route::get('{from}/{to}', 'OrdersController@getFromTo')->name('orders.getFromTo');

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'OrdersController@getById')->name('orders.getById');
        Route::put('/', 'OrdersController@put')->name('orders.put');
        Route::delete('/', 'OrdersController@delete')->name('orders.delete');
    });
});

Route::prefix('products')->group(function () {
    Route::get('/', 'ProductsController@all')->name('products.all');
    Route::post('/', 'ProductsController@post')->name('products.post');

    Route::prefix('{id}')->group(function () {
        Route::get('/', 'ProductsController@getById')->name('products.getById');
        Route::put('/', 'ProductsController@put')->name('products.put');
        Route::delete('/', 'ProductsController@delete')->name('products.delete');

        Route::prefix('orders')->group(function () {
            Route::get('/', 'ProductsController@getOrders')->name('products.getOrders');
            Route::get('{from}/{to}', 'ProductsController@getOrdersFromTo')
                 ->name('products.getOrdersFromTo');

            Route::post('/', 'ProductsController@addOrder')->name('products.addOrder');
        });

        Route::prefix('subcategory')->group(function () {
            Route::get('/', 'ProductsController@getSubcategory')->name('products.getSubcategory');
            Route::put('/', 'ProductsController@setSubcategory')->name('products.setSubcategory');
        });

        Route::prefix('category')->group(function () {
            Route::get('/', 'ProductsController@getCategory')->name('products.getCategory');
        });

        Route::prefix('menus')->group(function () {
            Route::get('/', 'ProductsController@getMenus')->name('products.getMenus');
        });
    });
});


Route::prefix('events')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::prefix('accessories', function () {
        });
        Route::prefix('products', function () {
        });
    });

    Route::prefix('{from}/{to}')->group(function () {
        Route::prefix('accessories', function () {
        });
        Route::prefix('products', function () {
        });
    });

    Route::prefix('accessories')->group(function()
    {

    });

    Route::prefix('products')->group(function()
    {
        
    });
});

Route::prefix('restockings')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::prefix('products')->group(function () {
        });
    });
    Route::prefix('{from}/{to}')->group(function () {
        Route::prefix('products')->group(function () {
        });
    });
    //    Route::prefix('products')
});

Route::prefix('money_addings')->group(function () {
    Route::prefix('{id}')->group(function () {
    });
    Route::prefix('{from}/{to}')->group(function () {
    });
});

Route::prefix('purchases')->group(function () {
    Route::prefix('{id}')->group(function () {
    });
    Route::prefix('{from}/{to}')->group(function () {
    });
});