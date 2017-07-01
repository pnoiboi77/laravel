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

Route::get('/', function () {
    return view('blog.index');
})->name('blog.index');

Route::get('post/{id}', function($id) { // argument in route need to match in function closure
    if ($id == 1) {
        $post = [        
            'title' => "Hello from ".$id,
            'content' => "hello from ".$id
        ];
    } else {
        $post = [        
            'title' => "Hello not from ".$id,
            'content' => "hello not from ".$id
        ];
    }
    
    return view('blog.post', ['post' => $post]);
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

    Route::get('edit/{id}', function($id) {
        if ($id == 1) {
        $post = [        
            'title' => "Hello from ".$id,
            'content' => "hello from ".$id
            ];
        } else {
            $post = [        
                'title' => "Hello not from ".$id,
                'content' => "hello not from ".$id
            ];
        }

        return view('admin.edit', ['post' => $post, 'id' => $id]);
    })->name('admin.edit');

    Route::post('create', function(\Illuminate\Http\Request $request, \Illuminate\Validation\Factory $validator) {
        $validation = $validator->make($request->all(), [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        return redirect()
            ->route('admin.index')
            ->with('info', 'Posted Created '.$request->input('title'));
    })->name('admin.create');

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
