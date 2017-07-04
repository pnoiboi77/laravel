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

/* different return methods
return view('view.name') // Response::view()
return 'plain old text'
return Response::json(['name' => 'Max'])
return redirect()->route('index') // Response::redirect()
*/

//Route::get('/', 'PostController@getIndex')->name('blog.index');
Route::get('/', [
    'uses' => 'PostController@getIndex',
    'as' => 'blog.index'
]);

Route::get('post/{id}', [
    'uses' => 'PostController@getPost',
    'as' => 'blog.post'
]);

Route::get('post/{id}/like', [
    'uses' => 'PostController@getLikePost',
    'as' => 'blog.post.like'
]);

Route::get('about', function() {
    return view('other.about');
})->name('other.about');

Route::group(['prefix' => 'admin'], function() {

    Route::get('', [
        'uses' => 'PostController@getAdminIndex',
        'as' => 'admin.index'
    ]);

    Route::get('create', [
        'uses' => 'PostController@getAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::post('create', [
        'uses' => 'PostController@postAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'PostController@getAdminEdit',
        'as' => 'admin.edit'
    ]);

    Route::get('delete/{id}', [
        'uses' => 'PostController@getAdminDelete',
        'as' => 'admin.delete'
    ]);

    Route::post('edit', [
        'uses' => 'PostController@postAdminEdit',
        'as' => 'admin.update'
    ]);
    
    /*
    Route::post('update', function(\Illuminate\Http\Request $request, \Illuminate\Validation\Factory $validator) {
        $validation = $validator->make($request->all(), [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        return redirect()
            ->route('admin.index')
            ->with('info', 'Posted update '.$request->input('title'));
    })->name('admin.update'); // cannot use edit because of get defined admin.edit is expecting param
*/

});

Auth::routes();

Route::post('login', [
    'uses' => 'SigninController@signin',
    'as' => 'auth.signin'
]);

//Route::get('/home', 'HomeController@index')->name('home');

/* non grouped route for admin
Route::get('admin', function() {
        return view('admin.index');
    })->name('admin.index');

    Route::get('admin/create', function() {
        return view('admin.create');    
    })->name('admin.create');

    Route::get('admin/edit/{id}', function() {
        return view('admin.edit');
    })->name('admin.edit');

    Route::post('admin/create', function() {
        return "it works!";
    })->name('admin.create');

    Route::post('admin/update', function() {
        return "it works!";
    })->name('admin.update'); // cannot use edit because of get defined admin.edit is expecting param
*/
