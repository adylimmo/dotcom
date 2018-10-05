<?php

//use App\Models\MenuItem;
use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    // return redirect('home');
    return view('welcome');
});


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', function () {
//     return MenuItem::renderAsHtml();
// });

Route::get('/admin', function () {
    // if(Laratrust::hasRole(['administrator','superadministrator'])) {
        return redirect('dashboard');
    // } else {
    //     return redirect('home');
    // }
});

Route::group(['middleware' => 'auth'], function () {    
    Route::get('oauth-admin', function() {
        return view('oauth.index');
    });
});

Route::get('edit-profile', function(ProfileRepository $profileRepository) {
    return view('profiles.edit')->with('profile', $profileRepository->findWhere(['user_id' => Auth::user()->id])->first());
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'HomeController@index');

    Route::get('menu-manager', function () {
        return view('menu::index');
    });

    Route::group(['middleware' => ['role:superadministrator|administrator']], function () {
        Route::resource('users', 'UserController');

        Route::resource('profiles', 'ProfileController');

        Route::resource('roles', 'RoleController');

        Route::resource('permissions', 'PermissionController');

        Route::resource('settings', 'SettingController');
    });
});

Route::get('/img/{path}', function(Filesystem $filesystem, $path) {
    $server = ServerFactory::create([
        'response' => new LaravelResponseFactory(app('request')),
        'source' => $filesystem->getDriver(),
        'cache' => $filesystem->getDriver(),
        'cache_path_prefix' => '.cache',
        'base_url' => 'img',
    ]);

    return $server->getImageResponse($path, request()->all());

})->where('path', '.*');

Route::get('admin/products', ['as'=> 'admin.products.index', 'uses' => 'Admin\ProductController@index']);
Route::post('admin/products', ['as'=> 'admin.products.store', 'uses' => 'Admin\ProductController@store']);
Route::get('admin/products/create', ['as'=> 'admin.products.create', 'uses' => 'Admin\ProductController@create']);
Route::put('admin/products/{products}', ['as'=> 'admin.products.update', 'uses' => 'Admin\ProductController@update']);
Route::patch('admin/products/{products}', ['as'=> 'admin.products.update', 'uses' => 'Admin\ProductController@update']);
Route::delete('admin/products/{products}', ['as'=> 'admin.products.destroy', 'uses' => 'Admin\ProductController@destroy']);
Route::get('admin/products/{products}', ['as'=> 'admin.products.show', 'uses' => 'Admin\ProductController@show']);
Route::get('admin/products/{products}/edit', ['as'=> 'admin.products.edit', 'uses' => 'Admin\ProductController@edit']);
// Route::post('importProduct', 'Admin\ProductController@import');

Route::resource('masterReligions', 'MasterReligionController');
// Route::post('importMasterReligion', 'MasterReligionController@import');

Route::resource('masterDivisions', 'MasterDivisionController');
// Route::post('importMasterDivision', 'MasterDivisionController@import');

Route::resource('masterDepartmens', 'MasterDepartmenController');
// Route::post('importMasterDepartmen', 'MasterDepartmenController@import');