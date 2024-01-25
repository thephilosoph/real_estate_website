<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\AminityController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\Backend\PropertyTypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name("home");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('property/details/{id}/{slug}', [IndexController::class, 'propertyDetails']);
Route::get('add-to-wishlist/{property_id}', [WishlistController::class, 'AddToWishList']);
Route::post('property/message', [IndexController::class, 'propertyMessage'])->name("property.message");



Route::middleware('auth')->group(function () {
    Route::get('user/profile', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::post('user/profile', [UserController::class, 'update'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'destroy'])->name("user.logout");
    Route::post('/user/password/update', [UserController::class, 'updatePassword'])->name("user.password.update");
    Route::get('/user/password/update', [UserController::class, 'editPassword'])->name("user.password.edit");

Route::controller(WishlistController::class)->group(function(){

Route::get('user/wishlist', "userWishlist")->name('user.wishlist');
Route::get('/getWishListProperty', "getWishListProperty");
Route::get('/wishlistRemove/{id}',"wishlistRemove");
});


Route::controller(CompareController::class)->group(function(){

    Route::get('addToCompare/{id}', "addToCompare");
    Route::get('user/compare', "userCompare")->name('user.compare');

    Route::get('/getCompareProperty', "getCompareProperty");
    Route::get('/compareRemove/{id}',"compareRemove");
    });
    


});

require __DIR__ . '/auth.php';

Route::get('/admin/login', [AdminController::class, 'login'])->middleware(RedirectIfAuthenticated::class)->name("admin.login");

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name("admin.dashboard");
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name("admin.profile");
    Route::post('/admin/profile/store', [AdminController::class, 'update'])->name("admin.profile.store");
    Route::post('/admin/password/update', [AdminController::class, 'updatePassword'])->name("admin.password.update");
    Route::get('/admin/password/update', [AdminController::class, 'editPassword'])->name("admin.password.edit");
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name("admin.logout");

    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type', 'allType')->name('all.type');
        Route::get('/add/type', 'addType')->name('add.type');
        Route::post('/store/type', 'storeType')->name('store.type');
        Route::get('/edit/type/{id}', 'editType')->name('edit.type');
        Route::post('/edit/type', 'updateType')->name('update.type');
        Route::get('/delete/type/{id}', 'deleteType')->name('delete.type');
    });



    Route::controller(AminityController::class)->group(function () {
        Route::get('/all/Aminity', 'allAminity')->name('all.aminity');
        Route::get('/add/Aminity', 'addAminity')->name('add.aminity');
        Route::post('/store/Aminity', 'storeAminity')->name('store.aminity');
        Route::get('/edit/Aminity/{id}', 'editAminity')->name('edit.aminity');
        Route::post('/edit/Aminity', 'updateAminity')->name('update.aminity');
        Route::get('/delete/Aminity/{id}', 'deleteAminity')->name('delete.aminity');
    });




    Route::controller(PropertyController::class)->group(function () {
        Route::get('/all/property', 'allProperty')->name('all.property');
        Route::get('/add/property', 'addProperty')->name('add.property');
        Route::post('/store/property', 'storeProperty')->name('store.property');
        Route::get('/edit/property/{id}', 'editProperty')->name('edit.property');
        Route::put('/edit/property', 'updateProperty')->name('update.property');
        Route::post('/edit/property/thumbnail', 'updatePropertyThumbnail')->name('update.property.thumbnail');
        Route::post('/edit/property/multi-image', 'updatePropertyMultiImage')->name('update.property.multiimage');
        Route::get('/delete/property/multi-image/{id}', 'deletePropertyMultiImage')->name('delete.property.multiimage');
        Route::post('/store/property/multi-image', 'storePropertyMultiImage')->name('store.property.multiimage');
        Route::post('/edit/property/facilities', 'updatePropertyFacilities')->name('update.property.facilities');
        Route::get('/delete/property/{id}', 'deleteProperty')->name('delete.property');
        Route::get('/show/property/{id}', 'showProperty')->name('show.property');
        Route::get('/inactive/property/{id}', 'inactiveProperty')->name('inactive.property');
        Route::get('/active/property/{id}', 'activeProperty')->name('active.property');


        Route::get('/admin/package/history', 'PackageHistory')->name('admin.package.history');
        Route::get('/admin/package/invoice/{id}', 'PackageInvoice')->name('package.invoice');

        Route::get('/admin/peroperty/message', 'adminPropertyMessage')->name('admin.property.message');
        Route::get('/admin/message/details/{id}', 'adminMessageDetails')->name('admin.message.details');
       
        
        
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/agents', 'getAgents')->name('all.agent');
        Route::get('/add/agent', 'addAgent')->name('add.agent');
        Route::post('/store/agent', 'storeAgent')->name('store.agent');
        Route::get('/edit/agent/{id}', 'editAgent')->name('edit.agent');
        Route::post('/edit/agent', 'updateAgent')->name('update.agent');
        Route::get('/delete/agent/{id}', 'deleteAgent')->name('delete.agent');
        Route::get('/changeStatus', 'changeStatus');
        

    });


    
});

Route::middleware(['auth', 'role:agent'])->group(function () {

    Route::get('/agent/dashboard', [AgentController::class, 'agentDashboard'])->name("agent.dashboard");
    Route::get('/agent/logout', [AgentController::class, 'destroy'])->name("agent.logout");
    Route::get('/agent/profile', [AgentController::class, 'agentProfile'])->name("agent.profile");
    Route::post('/agent/profile/store', [AgentController::class, 'update'])->name("agent.profile.store");
    Route::post('/agent/password/update', [AgentController::class, 'updatePassword'])->name("agent.password.update");
    Route::get('/agent/password/update', [AgentController::class, 'editPassword'])->name("agent.password.edit");


    Route::controller(AgentPropertyController::class)->group(function () {
        Route::get('/all/agent/property', 'allProperty')->name('all.agent.property');
        Route::get('/add/agent/property', 'addProperty')->name('add.agent.property');
        Route::post('/store/agent/property', 'storeProperty')->name('store.agent.property');


        Route::get ('/edit/agent/property/{id}', 'editProperty')->name('edit.agent.property');
        Route::post ('/edit/agent/property', 'updateProperty')->name('update.agent.property');
        Route::post('/edit/agent/property/thumbnail', 'updatePropertyThumbnail')->name('update.agent.property.thumbnail');
        Route::post('/edit/agent/property/multi-image', 'updatePropertyMultiImage')->name('update.agent.property.multiimage');
        Route::get ('/delete/agent/property/multi-image/{id}', 'deletePropertyMultiImage')->name('delete.agent.property.multiimage');
        Route::post('/store/agent/property/multi-image', 'storePropertyMultiImage')->name('store.agent.property.multiimage');
        Route::post('/edit/agent/property/facilities', 'updatePropertyFacilities')->name('update.agent.property.facilities');
        Route::get ('/delete/agent/property/{id}', 'deleteProperty')->name('delete.agent.property');
        Route::get('/show/agent/property/{id}', 'showProperty')->name('show.agent.property');

        Route::get('/buy/package', 'buyPackage')->name('buy.package');
        Route::get('/buy/plan/business', 'buyBusinessPlan')->name('buy.business.plan');
        Route::post('/store/plan/business', 'storeBusinessPlan')->name('store.business.plan');
        Route::get('/buy/plan/professional', 'buyProfessionalPlan')->name('buy.professional.plan');
        Route::post('/store/plan/professional', 'storeProfessionalPlan')->name('store.professional.plan');

        Route::get('/package/history', 'packageHistory')->name('package.history');
        Route::get('/agent/package/invoice/{id}', 'agentPackageInvoice')->name('agent.package.invoice');
        
        Route::get('/agent/peroperty/message', 'agentPropertyMessage')->name('agent.property.message');
        Route::get('/agent/message/details/{id}', 'agentMessageDetails')->name('agent.message.details');
        
    });


});
Route::get('/agent/login', [AgentController::class, 'login'])->middleware(RedirectIfAuthenticated::class)->name("agent.login");
Route::post('/agent/register', [AgentController::class, 'register'])->middleware(RedirectIfAuthenticated::class)->name("agent.register");

