@extends('layouts.admin')

@section('content')
<h4>Admin Main page</h4>

@if(Session::has('info'))
<div class="row">
    <div class="col-md-12">
        <p class="alert alert-info"> {{ Session::get('info') }}</p>
    </div>
</div>
@endif

@for($i=0; $i < 5; $i++)
<p>
    <a href="{{ route('admin.edit', ['id' => $i]) }}">
    Edit {{$i}}</a>
</p>
@endfor

@foreach($posts as $post)
    <p>    
    <h2>{{$post->title}}</h2>
    <span class="testing">{{$post->content}}</span>
    <a href="{{ route('admin.edit', ['id' => $post->id]) }}">Edit Post {{$post->id}}</a>
    <a href="{{ route('admin.delete', ['id' => $post->id]) }}">Delete Post {{$post->id}}</a>
    </p>
@endforeach

@endsection