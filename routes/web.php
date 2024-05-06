<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;

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

// route for login with facebook, git or twitter more
Route::get('redirect/{driver}', [LoginController::class, 'redirectToProvider'])->name('loginWithProvider');
Route::get('{driver}/callback', [LoginController::class, 'handleProviderCallback'])->name('ProviderCallack');
// end route for login with facebook more
Route::get('', [HomeController::class, 'welcome'])->name('welcome');
Route::get('service', [HomeController::class, 'service'])->name('service');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

//Auth::routes();
Auth::routes(['verify' => true]);

//start all route for admin side
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
    //start route Category in admin side
    Route::group(['as' => 'categories.', 'prefix' => 'categories'], function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::get('search', [SearchController::class, 'CategorySearch'])->name('search');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::group(['prefix' => '{category}'], function () {
            // Route::get('show', [CategoryController::class, 'show'])->name('show');
            Route::get('edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('update', [CategoryController::class, 'update'])->name('update');
            Route::delete('destroy', [CategoryController::class, 'destroy'])->name('destroy');
        });
    });
    //end route Category in admin side
    // start route Post in admin side
    Route::group(['as' => 'posts.', 'prefix' => 'posts'], function () {
        Route::get('', [PostController::class, 'index'])->name('index');
        Route::get('reported', [PostController::class, 'showReported'])->name('reported');
        Route::get('search', [SearchController::class, 'PostSearch'])->name('search');
        Route::post('store', [PostController::class, 'store'])->name('store');
        Route::group(['prefix' => '{post}'], function () {
            Route::get('show', [PostController::class, 'show'])->name('show');
            Route::put('setFree', [PostController::class, 'setFree'])->name('setFree');
            Route::post('like/store', [PostController::class, 'LikePostStore'])->name('LikePostStore');
            Route::delete('{like}/dislike', [PostController::class, 'PostDislike'])->name('dislike');
            Route::delete('{comment}/delete', [PostController::class, 'delete'])->name('delete');
            Route::put('update', [PostController::class, 'update'])->name('update');
            Route::delete('destroy', [PostController::class, 'destroy'])->name('destroy');
        });
    });
    // end route Post in admin side
    //start route User in admin side
    Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('search', [SearchController::class, 'UserSearch'])->name('search');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::group(['prefix' => '{user}'], function () {
            Route::get('show', [UserController::class, 'show'])->name('show');
            Route::get('comments', [UserController::class, 'comments'])->name('comments');
            Route::get('friends', [UserController::class, 'friends'])->name('friends');
            Route::delete('unfriend', [FriendController::class, 'destroy'])->name('destroyFriendship');
            Route::put('update', [UserController::class, 'update'])->name('update');
            Route::delete('destroy', [UserController::class, 'destroy'])->name('destroy');
            Route::delete('comments/{comment}/delete', [UserController::class, 'delete'])->name('delete');
            Route::get('search', [SearchController::class, 'UserPostSearch'])->name('postSearch');
        });
    });
    //start route for privacy in admin side
    Route::group(['as' => 'privacies.', 'prefix' => 'privacies'], function () {
        Route::get('', [PrivacyController::class, 'index'])->name('index');
        Route::get('search', [SearchController::class, 'PrivacySearch'])->name('search');
        Route::post('store', [PrivacyController::class, 'store'])->name('store');
        Route::group(['prefix' => '{privacy}'], function () {
            Route::get('edit', [PrivacyController::class, 'edit'])->name('edit');
            Route::put('update', [PrivacyController::class, 'update'])->name('update');
            Route::delete('destroy', [PrivacyController::class, 'destroy'])->name('destroy');
        });
    });
    //end route for privacy in admin side
    //end route User in admin side
});
//end all route for admin side
Route::get('search', [SearchController::class, 'openSearch'])->name('search');
// start route for category in landingPage without Auth(not logging)
Route::group(['as' => 'categories.', 'prefix' => 'categories'], function () {
    Route::get('', [CategoryController::class, 'Categories'])->name('index');
    Route::get('search', [SearchController::class, 'UserCategorySearch'])->name('search');
    Route::group(['prefix' => '{category:name}'], function () {
        Route::get('show', [CategoryController::class, 'CategoryShow'])->name('CategoryShow');
        Route::get('private', [CategoryController::class, 'CategoryPrivateShow'])->name('CategoryPrivateShow');

        Route::get('{post}', [PostController::class, 'showPost'])->name('showPost');
    });
});
// end route for category in landingPage without Auth(not logging)
//start route for checking user profile without log in
Route::group(['as' => 'profile.', 'prefix' => 'profile'], function () {
    Route::get('user/{user:name}', [UserController::class, 'userIndex'])->name('user');
    Route::get('user/{user:name}/comments', [UserController::class, 'userComments'])->name('comments');
    Route::get('user/{user:name}/friendships', [UserController::class, 'userFriends'])->name('friendships');
});
//end route for cheking user profile without login

//start all route for user side with Auth(must be logged)
//start route for user profile in user side (must be logged)
Route::group(['as' => 'profile.', 'prefix' => 'profile', 'middleware' => ['auth', 'verified']], function () {


    Route::group(['prefix' => '{user:name}'], function () {
        Route::get('', [UserController::class, 'profileIndex'])->name('profile');
        Route::get('settings', [UserController::class, 'ProfileEdit'])->name('settings');
        Route::get('shared', [UserController::class, 'ProfileShared'])->name('shared');
        Route::put('update', [UserController::class, 'ProfileUpdate'])->name('update');
        Route::put('privacy/update', [PrivacyController::class, 'updatePrivacy'])->name('updatePrivacy');
        Route::get('friends', [UserController::class, 'ProfileFriends'])->name('friends');
        Route::get('requests', [UserController::class, 'ProfileRequests'])->name('requests');
        Route::get('likes', [UserController::class, 'ProfileLikes'])->name('likes');
        Route::delete('delete', [UserController::class, 'ProfileDestroy'])->name('ProfileDestroy');
    });
    Route::group(['as' => 'friends.', 'prefix' => 'friends'], function () {
        Route::get('', [FriendController::class, 'index'])->name('index');
        Route::post('store', [FriendController::class, 'store'])->name('store');
        Route::group(['prefix' => '{friend}'], function () {
            Route::put('update', [FriendController::class, 'update'])->name('update');
            Route::get('unfriend', [FriendController::class, 'destroy'])->name('destroy');
        });
    });
});
//end route for user profile in user side (must be logged)

//start route for post in user side (Auth)
Route::group(['as' => 'posts.', 'prefix' => 'posts', 'middleware' => ['auth', 'verified']], function () {
    Route::get('', [PostController::class, 'PostIndex'])->name('index');
    Route::get('search', [SearchController::class, 'PostSearch'])->name('search');
    Route::post('store', [PostController::class, 'PostStore'])->name('store');
    Route::post('store', [PostController::class, 'CategoryPostStore'])->name('storePost');
    Route::group(['prefix' => '{post}'], function () {
        Route::post('share', [PostController::class, 'sharePost'])->name('share');
        Route::put('report', [PostController::class, 'reportPost'])->name('report');
        Route::post('like/store', [PostController::class, 'LikePostStore'])->name('LikePostStore');
        Route::delete('{like}/dislike', [PostController::class, 'PostDislike'])->name('dislikePost');
        Route::put('update', [PostController::class, 'PostUpdate'])->name('update');
        Route::delete('destroy', [PostController::class, 'PostDestroy'])->name('destroy');

        // start route for comments in post
        Route::group(['as' => 'comments.', 'prefix' => 'comments'], function () {
            Route::post('store', [PostController::class, 'CommentStore'])->name('store');
            Route::group(['prefix' => '{comment}'], function () {
                Route::put('update', [PostController::class, 'CommentUpdate'])->name('update');
                Route::delete('delete', [PostController::class, 'CommentDestroy'])->name('delete');
            });
        });
        //end route for comments in posts
    });
});
//end route for post in user side (Auth)
// end all route for user side with Auth(must be logged)
