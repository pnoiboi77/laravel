<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    protected $fillable = ['title', 'content'];

    public function likes() {
        return $this->hasMany('App\Like');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag')->withTimeStamps();
    }

    //mutator
    public function setTitleAttribute($value) {
        $this->attributes['title'] = strtolower($value);
    }

    //assesor
    public function getTitleAttribute($value) {
        return strtoupper($value);
    }
    /*
    public function getPosts($session) 
    {
        if (!$session->has('posts')) {
            $this->createDummyData($session);
        }
        return $session->get('posts');
    }

    public function getPost($session, $id) 
    {
        if (!$session->has('posts')) {
            $this->createDummyData($session);
        }

        return $session->get('posts')[$id];
    }

    public function addPost($session, $title, $content) 
    {
        if (!$session->has('posts')) {
            $this->createDummyData($session);
        }
        $posts = $session->get('posts');
        array_push($posts, ['title' => $title, 'content' => $content]);       
        
        return $session->put('posts', $posts);
    }

    public function editPost($session, $id, $title, $content) 
    {
        $posts = $session->get('posts');
        $posts[$id] = ['title' => $title, 'content' => $content];
        $session->put('posts', $posts);
    }
    
    private function createDummyData($session) {
        $posts = [
            [        
                'title' => "Learning Laravel",
                'content' => "Laravel is pretty awesome"        
            ],
            [
                'title' => "Why Laravel",
                'content' => "Just Because"
            ]
        ];

        $session->put('posts', $posts);
    }
    */
}