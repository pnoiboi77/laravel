@extends('layouts.master')

@section('content')
<h3>{{$post->id}}</h3>
<h4>{{ $post->title }}</h4>
<p>{{ $post->content }}</p>
<h2>Number of likes {{count($post->likes)}}</h2>
<a href="{{ route('blog.post.like', ['id' => $post->id]) }}">Like</a>
@endsection