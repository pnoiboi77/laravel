<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Validation\Factory;

class PostController extends Controller
{
    public function getIndex(Store $session) 
    {
        //$post = new Post();
        //$posts = $post->getPosts($session);
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        return view('blog.index', ['posts' => $posts]);
    }

    public function getAdminIndex(Store $session) {
        //$post = new Post();
        //$posts = $post->getPosts($session);
        $posts = Post::orderBy('title', 'asc')->get();
        return view('admin.index', ['posts' => $posts]);
    }

    public function getPost(Store $session, $id) {
        /*$post = new Post();
        $post = $post->getPost($session, $id);*/
        
        $post = Post::where('id', $id)->with('likes')->first();
        return view('blog.post', ['post' => $post]);
    }

    public function getLikePost(Store $session, $id) {
        /*$post = new Post();
        $post = $post->getPost($session, $id);*/
        $post = Post::find($id);
        $like = new Like();
        $post->likes()->save($like);
        return redirect()->back();
    }

    public function getAdminCreate() {
        $tags = Tag::all();
        return view('admin.create', ['tags' => $tags]);
    }

    public function getAdminEdit(Store $session, $id) {
        //$post = new Post();
        //$post = $post->getPost($session, $id);

        $post = Post::where('id', '=', $id)->first();
        $tags = Tag::all();

        return view('admin.edit', ['post' => $post, 'postId' => $id, 'tags' => $tags]);
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
        
        /*$post->addPost($session, 
            $request->input('title'), 
            $request->input('content'));*/

        $post = new Post([
            'title' => $request->input('title'), 'content' => $request->input('content')
            ]);        

        $post->save();  
        
        $post->tags()->attach(
            $request->input('tags') === null ? 
                [] : 
                $request->input('tags')
        );

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
        
        /*$post->editPost($session, 
            $request->input('id'),
            $request->input('title'), 
            $request->input('content'));*/

        $post = Post::where('id', $request->input('id'))->first();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        /*$post->tags()->detach();
        $post->tags()->attach(
            $request->input('tags') === null ? 
                [] : 
                $request->input('tags')
        );*/

        $post->tags()->sync(
            $request->input('tags') === null ? 
                [] : 
                $request->input('tags'));        

        return redirect()
            ->route('admin.index')
            ->with('info', 'Posted update '.$request->input('title'));
    }

    public function getAdminDelete($id) 
    {
        $post = Post::find($id);
        $post->likes()->delete();
        $post->tags()->detach();
        $post->delete();        

        return redirect()
            ->route('admin.index')
            ->with('info', 'Posted deleted');
    }
}
