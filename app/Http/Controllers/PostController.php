<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Validation\Factory;

class PostController extends Controller
{
    public function getIndex(Store $session) 
    {
        $post = new Post();
        $posts = $post->getPosts($session);
        return view('blog.index', ['posts' => $posts]);
    }

    public function getAdminIndex(Store $session) {
        $post = new Post();
        $posts = $post->getPosts($session);
        return view('admin.index', ['posts' => $posts]);
    }

    public function getPost(Store $session, $id) {
        $post = new Post();
        $post = $post->getPost($session, $id);
        return view('blog.post', ['post' => $post]);
    }

    public function getAdminCreate() {
        return view('admin.create');
    }

    public function getAdminEdit(Store $session, $id) {
        $post = new Post();
        $post = $post->getPost($session, $id);
        return view('admin.edit', ['post' => $post, 'postId' => $id]);
    }

    public function postAdminCreate(Store $session, Request $request, Factory $validator) {

        /*
        laravel provides injected service which can be called in controller
        $validation = $validator->make($request->all(), [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }*/

        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:5'
        ]);

        $post = new Post();
        $post->addPost($session, 
            $request->input('title'), 
            $request->input('content'));
        return redirect()
            ->route('admin.index')
            ->with('info', 'Posted Created '.$request->input('title'));
    }

    public function postAdminEdit(Store $session, Request $request) {
        // kept validation in route page that calls this controller method.
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = new Post();
        $post->editPost($session, 
            $request->input('id'),
            $request->input('title'), 
            $request->input('content'));
        return redirect()
            ->route('admin.index')
            ->with('info', 'Posted update '.$request->input('title'));
    }
}
