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

Route::get('/', function () {
    return view('blog.index');
})->name('blog.index');

Route::get('post/{id}', function() {
    return view('blog.post');
})->name('blog.post');

Route::get('about', function() {
    return view('other.about');
})->name('other.about');

Route::group(['prefix' => 'admin'], function() {

    Route::get('', function() {
        return view('admin.index');
    })->name('admin.index');

    Route::get('create', function() {
        return view('admin.create');    
    })->name('admin.create');

    Route::get('edit/{id}', function() {
        return view('admin.edit');
    })->name('admin.edit');

    Route::post('create', function() {
        return "it works!";
    })->name('admin.create');

    Route::post('update', function() {
        return "it works!";
    })->name('admin.update'); // cannot use edit because of get defined admin.edit is expecting param
});

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
