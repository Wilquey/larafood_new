<?php


use App\Models\Client;
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

Route::get('wteste', function() {
    $client = Client::first();
    
    $token = $client->createToken('token-teste');

    dd($token->plainTextToken);
});

route::prefix('admin')
            ->namespace('Admin')
            ->middleware('auth')
            ->group(function(){
    /**
     * Documentation
    */

    Route::get('test-acl', function(){
        dd(auth()->user()->permissions());
    });

    /**
     * Routes Users x Role 
     */
    Route::get('roles/{id}/users/{idUser}/detach', 'ACL\RoleUserController@detachRoleUser')->name('roles.users.detach');
    Route::post('roles/{id}/users', 'ACL\RoleUserController@attachRolesUser')->name('roles.users.attach');
    Route::any('roles/{id}/users/create', 'ACL\RoleUserController@usersAvailable')->name('roles.users.available');
    Route::get('roles/{id}/users', 'ACL\RoleUserController@users')->name('roles.users');

    /**
     * Routes Role x Users
     */
    Route::get('users/{id}/roles/{idRole}/detach', 'ACL\RoleUserController@detachRoleUser')->name('users.roles.detach');
    Route::post('users/{id}/roles', 'ACL\RoleUserController@attachRolesUser')->name('users.roles.attach');
    Route::any('users/{id}/roles/create', 'ACL\RoleUserController@rolesAvailable')->name('users.roles.available');
    Route::get('users/{id}/roles', 'ACL\RoleUserController@roles')->name('users.roles');

    /**
     * Routes Roles x Permissions
     */
    Route::get('permissions/{id}/roles/{idPermission}/detach', 'ACL\PermissionRoleController@detachPermissionRole')->name('permissions.roles.detach');
    Route::post('permissions/{id}/roles', 'ACL\PermissionRoleController@attachPermissionsRole')->name('permissions.roles.attach');
    Route::any('permissions/{id}/roles/create', 'ACL\PermissionRoleController@rolesAvailable')->name('permissions.roles.available');
    Route::get('permissions/{id}/roles', 'ACL\PermissionRoleController@roles')->name('permissions.roles');

    /**
     * Routes Permission x Roles
     */
    Route::get('roles/{id}/permissions/{idPermission}/detach', 'ACL\PermissionRoleController@detachPermissionRole')->name('roles.permissions.detach');
    Route::post('roles/{id}/permissions', 'ACL\PermissionRoleController@attachPermissionsRole')->name('roles.permissions.attach');
    Route::any('roles/{id}/permissions/create', 'ACL\PermissionRoleController@permissionsAvailable')->name('roles.permissions.available');
    Route::get('roles/{id}/permissions', 'ACL\PermissionRoleController@permissions')->name('roles.permissions');


    /**
     * Routes Role
     */
    Route::any('roles/search', 'ACL\RoleController@search')->name('roles.search');
    Route::resource('roles', 'ACL\RoleController');

    /**
     * Routes Tenants
     */
    Route::any('tenants/search', 'TenantController@search')->name('tenants.search');
    Route::resource('tenants', 'TenantController');


    /**
     * Routes Tables
     */
    Route::any('tables/search', 'TableController@search')->name('tables.search');
    Route::resource('tables', 'TableController');

    /**
     * Routes Product x Category
     */
    Route::get('categories/{id}/products/{idProduct}/detach', 'CategoryProductController@detachProductCategory')->name('categories.products.detach');
    Route::post('categories/{id}/products', 'CategoryProductController@attachProductsCategory')->name('categories.products.attach');
    Route::any('categories/{id}/products/create', 'CategoryProductController@productsAvailable')->name('categories.products.available');
    Route::get('categories/{id}/products', 'CategoryProductController@products')->name('categories.products');

    /**
     * Routes Category x Product
     */
    Route::get('products/{id}/categories/{idCategory}/detach', 'CategoryProductController@detachCategoryProduct')->name('products.categories.detach');
    Route::post('products/{id}/categories', 'CategoryProductController@attachCategoriesProduct')->name('products.categories.attach');
    Route::any('products/{id}/categories/create', 'CategoryProductController@categoriesAvailable')->name('products.categories.available');
    Route::get('products/{id}/categories', 'CategoryProductController@categories')->name('products.categories');

     /**
     * Routes Products
     */
    Route::any('products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController');

     /**
     * Routes Categories
     */
    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController');

     /**
     * Routes Users
     */
    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController');

     /**
     * Routes Profile x Plan 
     */
    Route::get('profiles/{id}/plans/{idPlan}/detach', 'ACL\PlanProfileController@detachProfilePlan')->name('profiles.plans.detach');
    Route::post('profiles/{id}/plans', 'ACL\PlanProfileController@attachPlansProfile')->name('profiles.plans.attach');
    Route::any('profiles/{id}/plans/create', 'ACL\PlanProfileController@plansAvailable')->name('profiles.plans.available');
    Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');


     /**
     * Routes Plan x Profile
     */
    Route::get('plans/{id}/profiles/{idProfile}/detach', 'ACL\PlanProfileController@detachPlanProfile')->name('plans.profiles.detach');
    Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');
    Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
    Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');


    /**
     * Routes Profile x Permission
     */
    Route::get('permissions/{id}/profiles/{idProfile}/detach', 'ACL\PermissionProfileController@detachProfilePermission')->name('permissions.profiles.detach');
    Route::post('permissions/{id}/profiles', 'ACL\PermissionProfileController@attachProfilesPermission')->name('permissions.profiles.attach');
    Route::any('permissions/{id}/profiles/create', 'ACL\PermissionProfileController@profilesAvailable')->name('permissions.profiles.available');
    Route::get('permissions/{id}/profiles', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');

    /**
     * Routes Permission x Profile
     */
    Route::get('profiles/{id}/permissions/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionProfile')->name('profiles.permissions.detach');
    Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');


     /**
     * Routes Permission
     */
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');

    /**
     * Routes Profile
     */
    Route::get('profiles/create', 'ACL\ProfileController@create')->name('profiles.create');
    Route::put('profiles/{id}', 'ACL\ProfileController@update')->name('profiles.update');
    Route::get('profiles/{id}/edit', 'ACL\ProfileController@edit')->name('profiles.edit');
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::delete('profiles/{id}', 'ACL\ProfileController@destroy')->name('profiles.destroy');
    Route::get('profiles/{id}', 'ACL\ProfileController@show')->name('profiles.show');
    Route::post('profiles/store', 'ACL\ProfileController@store')->name('profiles.store');
    Route::get('profiles', 'ACL\ProfileController@index')->name('profiles.index')->middleware('can:profiles');

    /**
     * Routes Details Plans
    */
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
    Route::put('plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');

    /**
     * Routes Plans
     */
    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::post('plans/store', 'PlanController@store')->name('plans.store');
    Route::get('plans', 'PlanController@index')->name('plans.index');

    /**
     * Home Dashboard
     */
    Route::get('/', 'PlanController@index')->name('admin.index');

});

/**
* Site
**/
Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

/**
* Auth routes
**/
Auth::routes();

