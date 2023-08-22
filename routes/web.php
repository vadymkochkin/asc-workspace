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
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
//Route::get('/', 'HomeController@home');
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
Route::get('/newhome', ['as' => 'newhome', 'uses' => 'HomeController@newhome']);

//Temporary News Route
Route::get('/article', ['as' => 'article', 'uses' => 'NewsController@article']);
Route::get('/news', ['as' => 'news', 'uses' => 'NewsController@board']);
    Route::post('/news/{id}/respond', ['as' => 'respond_to_news', 'uses' => 'NewsController@respondToNews']);
Route::get('/detail/{slug}', ['as' => 'detail', 'uses' => 'NewsController@displayNews']);
Route::get('/terms-of-service', ['as' => 'terms-of-service', 'uses' => 'TermsOfServiceController@tos']);
Route::get('/command', 'store\CartController@command');
Route::get('/watch', ['as' => 'watch', 'uses' => 'MediaController@watch']);

//Temporary Support Route
Route::get('/contact', ['as' => 'contact', 'uses' => 'SupportController@contact']);

//Temporary UCP Route
Route::get('/ucpnew/index', ['as' => 'ucp', 'uses' => 'UserNewController@index']);

// Authentication Routes
Auth::routes();
Route::group(['middleware' => ['web', 'activity']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);
Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');

});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/user', ['as' => 'public.home', 'uses' => 'UserController@index']);
    Route::get('/user_list', ['as' => 'user.list', 'uses' => 'UserController@Users']);
    Route::post('/user-list-report', ['as' => 'user_list_report', 'uses' => 'UserController@userReport']);
    Route::post('/change-user-role', ['as' => 'change_user_role', 'uses' => 'UserController@setAccessLevel']);
    Route::get('/display/{id}', ['as' => 'display', 'uses' => 'UserController@displayUserView']);
    Route::get('/transactions', ['as' => 'transaction.home', 'uses' => 'TransactionsController@index']);
    Route::get('/newsmanage', ['as' => 'news.home', 'uses' => 'NewsController@index']);
    Route::get('/faqmanage', ['as' => 'faq.home', 'uses' => 'FaqController@index']);
    Route::get('/editnews/{id}', ['as' => 'news.edit', 'uses' => 'NewsController@edit']);
    Route::get('/editfaq/{id}', ['as' => 'faq.edit', 'uses' => 'FaqController@edit']);
    Route::get('/create-news/{id}', ['as' => 'create_news', 'uses' => 'NewsController@createNews']);
    Route::get('/create-faq/{id}', ['as' => 'create_faq', 'uses' => 'FaqController@createFaq']);
    Route::get('/cart_history', ['as' => 'cart.history', 'uses' => 'TransactionsController@cartHistory']);
    Route::get('/privacy-policy', ['as' => 'privacy-policy', 'uses' => 'Acknowledgement\AcknowledgementController@privacyPolicy']);
    Route::get('/refund-policy', ['as' => 'refund-policy', 'uses' => 'Acknowledgement\AcknowledgementController@refundPolicy']);
    // Show users profile - viewable by other users.
    Route::get('profile/{username}/view', [
        'as' => '{username}',
        'uses' => 'ProfilesController@show',
    ]);

    Route::get('profile/{username}/change-password', [
        'as' => '{username}',
        'uses' => 'ProfilesController@change_password',
    ]);

    Route::get('profile/{username}/delete-account', [
        'as' => '{username}',
        'uses' => 'ProfilesController@delete_account',
    ]);
});
// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as' => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as' => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as' => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index' => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index' => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');
});

// user control route
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'https_check', 'activity']], function () {

    Route::group(['prefix' => 'store', 'as' => 'store.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'store\StoreController@index']);
        Route::post('display-api', ['as' => 'display_api', 'uses' => 'TransactionsController@requestReports']);
        Route::post('display-cart-report', ['as' => 'display_cart_report', 'uses' => 'TransactionsController@cartReport']);
        Route::post('display-cart', ['as' => 'display_cart', 'uses' => 'TransactionsController@display_cart']);
        Route::get('/cart', ['as' => 'cart', 'uses' => 'store\CartController@openCart']);
        Route::post('/item-preview', ['as' => 'item_preview', 'uses' => 'store\StoreController@itemPreview']);
        Route::post('/item-update', ['as' => 'item_update', 'uses' => 'store\AdminController@updateItem']);
        Route::post('/item-add', ['as' => 'item_add', 'uses' => 'store\AdminController@addItem']);
        Route::post('/purchase_again', ['as' => 'purchase_again', 'uses' => 'store\CartController@PurchaseAgain']);
        Route::get('/{realm}', [
            'as' => 'realm',
            'uses' => 'store\StoreController@ItemMenu',
        ]);
        Route::get('/{realm}/{menu}', [
            'as' => 'menu',
            'uses' => 'store\StoreController@GetAllItem',
        ]);
        Route::get('/{realm}/{menu}/{item_id}', [
            'as' => 'item',
            'uses' => 'store\StoreController@GetSingleItem',
        ]);

    });

    Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
        Route::get('/get_news', ['as' => 'get_news', 'uses' => 'NewsController@get_news_list']);
        Route::post('/save_news', ['as' => 'save_news', 'uses' => 'NewsController@save_news']);
        Route::delete('/del_news', ['as' => 'del_news', 'uses' => 'NewsController@del_news']);
        Route::post('/toggle_lock', ['as' => 'toggle_lock', 'uses' => 'NewsController@toggleLock']);
        Route::get('/accept_news/{id}', ['as' => 'accept_news', 'uses' => 'NewsController@active_news']);
        Route::get('/reject_news/{id}', ['as' => 'reject_news', 'uses' => 'NewsController@rejected_news']);
        Route::post('/news-search', ['as' => 'news_search', 'uses' => 'NewsController@newsSearch']);
        Route::post('/like-comment', ['as' => 'like_comment', 'uses' => 'NewsController@likeComment']);
    });

    /*
    Route::group(['prefix' => 'donation', 'as' => 'donation.'], function () {
        Route::get('/hub', ['as' => 'hub', 'uses' => 'donation\DonationController@hub']);
    });*/
    Route::get('/donate', ['as' => 'donate', 'uses' => 'donation\DonationController@donate']);


    Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {
        Route::get('/get_faq', ['as' => 'get_faq', 'uses' => 'FaqController@get_faq_list']);
        Route::post('/save_faq', ['as' => 'save_faq', 'uses' => 'FaqController@save_faq']);
        Route::post('/save_category', ['as' => 'save_category', 'uses' => 'FaqController@save_category']);
        Route::delete('/del_category', ['as' => 'del_category', 'uses' => 'FaqController@del_faq_category']);
        Route::put('/reorder_category', ['as' => 'reorder', 'uses' => 'FaqController@reorder_category']);
        Route::get('/get_category', ['as' => 'get_category', 'uses' => 'FaqController@get_category']);
        Route::delete('/del_faq', ['as' => 'del_faq', 'uses' => 'FaqController@del_faq']);
        Route::get('/accept_faq/{id}', ['as' => 'accept_faq', 'uses' => 'FaqController@active_faq']);
        Route::get('/reject_faq/{id}', ['as' => 'reject_faq', 'uses' => 'FaqController@rejected_faq']);
    });

    // sample route ,need to be optimized
    Route::post('/checkout', 'store\CartController@checkOut');
    Route::get('/show', 'store\CartController@show');
    Route::post('/char', 'DBInjector\CharacterController@SelfCharacters');
    Route::post('/other', 'DBInjector\CharacterController@OthersCharacter');
    Route::post('/save', 'store\CartController@saveCart');
    Route::post('/add', ['uses' => 'store\CartController@addToCart']);


});

// admin activity route for shop

Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'https_check', 'activity']], function () {

    Route::group(['prefix' => 'manage_store', 'as' => 'manage_store.'], function () {
        Route::post('/item-edit', ['as' => 'item_edit', 'uses' => 'store\AdminController@editItem']);
        Route::post('/add-to-featured', ['as' => 'add-to-featured', 'uses' => 'store\AdminController@addFeatureItem']);
        Route::post('/edit-feature', ['as' => 'edit_feature', 'uses' => 'store\AdminController@edit_feature']);
        Route::post('/feature-save', ['as' => 'feature_save', 'uses' => 'store\AdminController@feature_save']);
        Route::post('/item-delete', ['as' => 'item_delete', 'uses' => 'store\AdminController@deleteItem']);
        Route::post('/realm-info', ['as' => 'realm_info', 'uses' => 'store\AdminController@realmInfo']);
        Route::post('/realm-add', ['as' => 'realm_add', 'uses' => 'store\AdminController@addRealm']);
        Route::post('/realm-edit', ['as' => 'realm_edit', 'uses' => 'store\AdminController@editRealm']);
        Route::post('/realm-delete', ['as' => 'realm_delete', 'uses' => 'store\AdminController@deleteRealm']);
        Route::post('/realms-item-search', ['as' => 'realms_item_search', 'uses' => 'store\StoreController@realmItemSearch']);

    });
});
//build
Route::get('/builds', ['as' => 'builds', 'uses' => 'BuildController@index']);
//faq
Route::get('/faq', ['as' => 'faq.index', 'uses' => 'FaqController@board']);
// change logs
Route::group(['prefix' => 'changelog', 'as' => 'changelog.'], function () {
    Route::get('/', ['as' => 'view', 'uses' => 'ChangelogController@index']);
    Route::post('load-more', ['as' => 'load_more', 'uses' => 'ChangelogController@loadMoreChangelog']);

    Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'https_check', 'activity']], function () {
        Route::get('manage', ['as' => 'manage', 'uses' => 'ChangelogController@manage']);
        Route::post('add-catagory', ['as' => 'add_catagory', 'uses' => 'ChangelogController@addCatagory']);
        Route::post('add-changelog', ['as' => 'add_changelog', 'uses' => 'ChangelogController@addChangelog']);
        Route::post('save-changelog', ['as' => 'save_changelog', 'uses' => 'ChangelogController@saveChangelog']);
        Route::get('list', ['as' => 'list', 'uses' => 'ChangelogController@getChangelog']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ChangelogController@editChangelogView']);
        Route::get('display/{id}', ['as' => 'display', 'uses' => 'ChangelogController@displayChangelog']);
        Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'ChangelogController@deleteChangelog']);
    });
});

//bugtracker
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'https_check', 'activity']], function () {
    Route::group(['prefix' => 'bugtracker', 'as' => 'bugtracker.'], function () {

        Route::get('/', ['as' => 'index', 'uses' => 'BugtrackerController@index']);
        Route::get('display/{id}', ['as' => 'display', 'uses' => 'BugtrackerController@display']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'BugtrackerController@edit']);
        Route::post('update', ['as' => 'update', 'uses' => 'BugtrackerController@update']);
        Route::get('add-new', ['as' => 'add_new', 'uses' => 'BugtrackerController@create']);
        Route::post('save', ['as' => 'save', 'uses' => 'BugtrackerController@save']);
        Route::post('rating', ['as' => 'rating', 'uses' => 'BugtrackerController@userReportRating']);
        Route::post('save-comment', ['as' => 'save_comment', 'uses' => 'BugtrackerController@saveComment']);
        Route::post('update-comment', ['as' => 'update_comment', 'uses' => 'BugtrackerController@updateComment']);
        Route::post('request-report', ['as' => 'request_report', 'uses' => 'BugtrackerController@requestReport']);
    });
});

Route::post('deploy', 'DeployController@deploy');

Route::get('download', ['as' => 'public.download', 'uses' => 'DownloadController@index']);

Route::get('swal/docs', function() {
    return Redirect::to('https://sweetalert2.github.io/');
});

Route::redirect('/php', '/phpinfo', 301);
