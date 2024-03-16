<?php

use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\AminityController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\TestimonialController;
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
Route::get('/agent/details/{id}', [IndexController::class, 'agentDetails'])->name('agent.details');
Route::post('agent/details/message', [IndexController::class, 'agentDetailsMessage'])->name("agent.details.message");
Route::get('/rent/property', [IndexController::class, 'rentProperty'])->name('rent.property');
Route::get('/buy/property', [IndexController::class, 'buyProperty'])->name('buy.property');
Route::get('/type/property/{id}', [IndexController::class, 'typeProperty'])->name('property.type');
Route::get('/state/details/{id}', [IndexController::class, 'stateProperty'])->name('state.details');
Route::post('/buy/property/search', [IndexController::class, 'buyPropertySearch'])->name('buy.property.search');
Route::post('/rent/property/search', [IndexController::class, 'rentPropertySearch'])->name('rent.property.search');
Route::post('/all/property/search', [IndexController::class, 'allPropertySearch'])->name('all.property.search');
Route::get('/blog/details/{slug}', [BlogController::class, 'blogDetails']);
Route::get('/blog/category/list/{id}', [BlogController::class, 'blogCategoryList']);
Route::get('/blog/list', [BlogController::class, 'blogList'])->name('blog.list');
Route::post('/store/comment', [BlogController::class, 'storeComment'])->name('store.comment');
Route::post('/store/schedule', [IndexController::class, 'storeSchedule'])->name('store.schedule');


Route::middleware('auth')->group(function () {
    Route::get('user/profile', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::post('user/profile', [UserController::class, 'update'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'destroy'])->name("user.logout");
    Route::post('/user/password/update', [UserController::class, 'updatePassword'])->name("user.password.update");
    Route::get('/user/password/update', [UserController::class, 'editPassword'])->name("user.password.edit");
    Route::get('/user/schedule/request', [UserController::class, 'userScheduleRequest'])->name("user.schedule.request");



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

Route::middleware(['auth', 'roles:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name("admin.dashboard");
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name("admin.profile");
    Route::post('/admin/profile/store', [AdminController::class, 'update'])->name("admin.profile.store");
    Route::post('/admin/password/update', [AdminController::class, 'updatePassword'])->name("admin.password.update");
    Route::get('/admin/password/update', [AdminController::class, 'editPassword'])->name("admin.password.edit");
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name("admin.logout");

    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type', 'allType')->name('all.type')->middleware('permission:all.type');
        Route::get('/add/type', 'addType')->name('add.type')->middleware('permission:add.type');
        Route::post('/store/type', 'storeType')->name('store.type')->middleware('permission:add.type');
        Route::get('/edit/type/{id}', 'editType')->name('edit.type')->middleware('permission:edit.type');
        Route::post('/edit/type', 'updateType')->name('update.type')->middleware('permission:edit.type');
        Route::get('/delete/type/{id}', 'deleteType')->name('delete.type')->middleware('permission:delete.type');
    });



    Route::controller(AminityController::class)->group(function () {
        Route::get('/all/Aminity', 'allAminity')->name('all.aminity')->middleware('permission:all.amenities');
        Route::get('/add/Aminity', 'addAminity')->name('add.aminity')->middleware('permission:add.amenities');
        Route::post('/store/Aminity', 'storeAminity')->name('store.aminity')->middleware('permission:add.amenities');
        Route::get('/edit/Aminity/{id}', 'editAminity')->name('edit.aminity')->middleware('permission:edit.amenities');
        Route::post('/edit/Aminity', 'updateAminity')->name('update.aminity')->middleware('permission:edit.amenities');
        Route::get('/delete/Aminity/{id}', 'deleteAminity')->name('delete.aminity')->middleware('permission:delete.amenities');
    });

    Route::controller(StateController::class)->group(function () {
        Route::get('/all/state', 'allState')->name('all.state')->middleware('permission:all.state');
        Route::get('/add/state', 'addState')->name('add.state')->middleware('permission:add.state');;
        Route::post('/store/state', 'storeState')->name('store.state')->middleware('permission:add.state');;
        Route::get('/edit/state/{id}', 'editState')->name('edit.state')->middleware('permission:edite.state');;
        Route::post('/edit/state', 'updateState')->name('update.state')->middleware('permission:edit.state');;
        Route::get('/delete/state/{id}', 'deleteState')->name('delete.state')->middleware('permission:delete.state');;
    });


    Route::controller(TestimonialController::class)->group(function () {
        Route::get('/all/testimonial', 'allTestimonial')->name('all.testimonial')->middleware('permission:all.testimonial');
        Route::get('/add/testimonial', 'addTestimonial')->name('add.testimonial')->middleware('permission:add.testimonial');
        Route::post('/store/testimonial', 'storeTestimonial')->name('store.testimonial')->middleware('permission:add.testimonial');
        Route::get('/edit/testimonial/{id}', 'editTestimonial')->name('edit.testimonial')->middleware('permission:edite.testimonial');
        Route::post('/edit/testimonial', 'updateTestimonial')->name('update.testimonial')->middleware('permission:edit.testimonial');
        Route::get('/delete/testimonial/{id}', 'deleteTestimonial')->name('delete.testimonial')->middleware('permission:delete.testimonial');
    });

    Route::controller(\App\Http\Controllers\Backend\BlogController::class)->group(function () {
        Route::get('/all/blog/category', 'allBlogCategory')->name('all.blog.category')->middleware('permission:category.menu');
        Route::post('/store/blog/category', 'storeBlogCategory')->name('store.blog.category')->middleware('permission:category.menu');
        Route::get('/blog/category/{id}', 'editBlogCategory')->name('edit.blog.category')->middleware('permission:category.menu');
        Route::post('/edit/blog/category', 'updateBlogCategory')->name('update.blog.category')->middleware('permission:category.menu');
        Route::get('/delete/blog/category/{id}', 'deleteBlogCategory')->name('delete.blog.category')->middleware('permission:category.menu');

        Route::get('/all/post', 'allPost')->name('all.post')->middleware('permission:post.menu');
        Route::get('/add/post', 'addPost')->name('add.post')->middleware('permission:post.menu');
        Route::post('/store/post', 'storePost')->name('store.post')->middleware('permission:post.menu');
        Route::get('/edit/post/{id}', 'editPost')->name('edit.post')->middleware('permission:post.menu');
        Route::post('/edit/post', 'updatePost')->name('update.post')->middleware('permission:post.menu');
        Route::get('/delete/post/{id}', 'deletePost')->name('delete.post')->middleware('permission:post.menu');


        Route::get('admin/blog/comment','adminBlogComment')->name('admin.blog.comment')->middleware('permission:comment.menu');
        Route::get('admin/blog/comment/reply/{id}','adminCommentReply')->name('admin.comment.reply')->middleware('permission:comment.menu');
        Route::post('reply/comment','commentReply')->name('store.reply')->middleware('permission:comment.menu');
    });


    Route::controller(PropertyController::class)->group(function () {
        Route::get('/all/property', 'allProperty')->name('all.property')->middleware('permission:all.property');
        Route::get('/add/property', 'addProperty')->name('add.property')->middleware('permission:add.property');
        Route::post('/store/property', 'storeProperty')->name('store.property')->middleware('permission:add.property');
        Route::get('/edit/property/{id}', 'editProperty')->name('edit.property')->middleware('permission:edite.property');
        Route::put('/edit/property', 'updateProperty')->name('update.property')->middleware('permission:edit.property');
        Route::post('/edit/property/thumbnail', 'updatePropertyThumbnail')->name('update.property.thumbnail');
        Route::post('/edit/property/multi-image', 'updatePropertyMultiImage')->name('update.property.multiimage');
        Route::get('/delete/property/multi-image/{id}', 'deletePropertyMultiImage')->name('delete.property.multiimage');
        Route::post('/store/property/multi-image', 'storePropertyMultiImage')->name('store.property.multiimage');
        Route::post('/edit/property/facilities', 'updatePropertyFacilities')->name('update.property.facilities');
        Route::get('/delete/property/{id}', 'deleteProperty')->name('delete.property')->middleware('permission:delete.property');
        Route::get('/show/property/{id}', 'showProperty')->name('show.property');
        Route::get('/inactive/property/{id}', 'inactiveProperty')->name('inactive.property');
        Route::get('/active/property/{id}', 'activeProperty')->name('active.property');


        Route::get('/admin/package/history', 'PackageHistory')->name('admin.package.history')->middleware('permission:package.menu');
        Route::get('/admin/package/invoice/{id}', 'PackageInvoice')->name('package.invoice')->middleware('permission:package.menu');

        Route::get('/admin/peroperty/message', 'adminPropertyMessage')->name('admin.property.message')->middleware('permission:message.menu');
        Route::get('/admin/message/details/{id}', 'adminMessageDetails')->name('admin.message.details')->middleware('permission:message.menu');



    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/agents', 'getAgents')->name('all.agent')->middleware('permission:all.agent');
        Route::get('/add/agent', 'addAgent')->name('add.agent')->middleware('permission:add.agent');
        Route::post('/store/agent', 'storeAgent')->name('store.agent')->middleware('permission:add.agent');
        Route::get('/edit/agent/{id}', 'editAgent')->name('edit.agent')->middleware('permission:edite.agent');
        Route::post('/edit/agent', 'updateAgent')->name('update.agent')->middleware('permission:edit.agent');
        Route::get('/delete/agent/{id}', 'deleteAgent')->name('delete.agent')->middleware('permission:delete.agent');
        Route::get('/changeStatus', 'changeStatus')->middleware('permission:edite.agent');


    });


    Route::controller(SettingController::class)->group(function () {
        Route::get('/smtp/setting', 'smtpSetting')->name('smtp.setting')->middleware('permission:smtp.menu');
        Route::post('/update/smtp/setting', 'updateSmtpSetting')->name('update.smtp.setting')->middleware('permission:smtp.menu');

    });

//site setting
    Route::controller(SettingController::class)->group(function () {
        Route::get('/site/setting', 'siteSetting')->name('site.setting')->middleware('permission:site.menu');
        Route::post('/update/site/setting', 'updateSiteSetting')->name('update.site.setting')->middleware('permission:site.menu');

    });



    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'AllPermission')->name('all.permission')->middleware('permission:role.menu');
        Route::get('/add/permission', 'addPermission')->name('add.permission')->middleware('permission:role.menu');
        Route::post('/store/permission', 'storePermission')->name('store.permission')->middleware('permission:role.menu');
        Route::get('/edit/permission/{id}', 'editPermission')->name('edit.permission')->middleware('permission:role.menu');
        Route::post('/edit/permission', 'updatePermission')->name('update.permission')->middleware('permission:role.menu');
        Route::get('/delete/permission/{id}', 'deletePermission')->name('delete.permission')->middleware('permission:role.menu');
        Route::get('/import/permission', 'importPermission')->name('import.permission');
        Route::get('/export', 'Export')->name('export');
        Route::post('/import', 'Import')->name('import');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/role', 'AllRole')->name('all.role')->middleware('permission:role.menu');
        Route::get('/add/role', 'addRole')->name('add.role')->middleware('permission:role.menu');
        Route::post('/store/role', 'storeRole')->name('store.role')->middleware('permission:role.menu');
        Route::get('/edit/role/{id}', 'editRole')->name('edit.role')->middleware('permission:role.menu');
        Route::post('/edit/role', 'updateRole')->name('update.role')->middleware('permission:role.menu');
        Route::get('/delete/role/{id}', 'deleteRole')->name('delete.role')->middleware('permission:role.menu');

        Route::get('/add/role/permission', 'addRolePermission')->name('add.role.permission')->middleware('permission:role.menu');
        Route::post('/store/role/permission', 'rolePermissionStore')->name('role.permission.store')->middleware('permission:role.menu');
        Route::get('/all/role/permission', 'AllRolePermission')->name('all.role.permission')->middleware('permission:role.menu');
        Route::get('/edit/role/permission/{id}', 'editRolePermission')->name('admin.edit.role')->middleware('permission:role.menu');
        Route::post('/update/role/permission/{id}', 'updateRolePermission')->name('role.permission.update')->middleware('permission:role.menu');
        Route::get('/delete/role/permission/{id}', 'deleteRolePermission')->name('admin.delete.role')->middleware('permission:role.menu');

    });


    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/admin' , 'allAdmin')->name('all.admin')->middleware('permission:admin.menu');
        Route::get('/add/admin' , 'addAdmin')->name('add.admin')->middleware('permission:admin.menu');
        Route::post('/store/admin' , 'storeAdmin')->name('store.admin')->middleware('permission:admin.menu');
        Route::get('/edit/admin/{id}' , 'editAdmin')->name('edit.admin')->middleware('permission:admin.menu');
        Route::post('/update/admin' , 'updateAdmin')->name('update.admin')->middleware('permission:admin.menu');
        Route::get('/delete/admin/{id}' , 'deleteAdmin')->name('delete.admin')->middleware('permission:admin.menu');
    });
});

Route::middleware(['auth', 'roles:agent'])->group(function () {

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

        Route::get('/agent/property/message', 'agentPropertyMessage')->name('agent.property.message');
        Route::get('/agent/message/details/{id}', 'agentMessageDetails')->name('agent.message.details');

        Route::get('/agent/schedule/request', 'agentScheduleRequest')->name('agent.schedule.request');
        Route::get('/agent/schedule/details/{id}', 'agentScheduleDetails')->name('show.details.schedule');
        Route::post('/agent/schedule/update', 'agentUpdateSchedule')->name('update.schedule.status');


    });


});
Route::get('/agent/login', [AgentController::class, 'login'])->middleware(RedirectIfAuthenticated::class)->name("agent.login");
Route::post('/agent/register', [AgentController::class, 'register'])->middleware(RedirectIfAuthenticated::class)->name("agent.register");

