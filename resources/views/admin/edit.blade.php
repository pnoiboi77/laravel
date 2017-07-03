@extends('layouts.admin')

@section('content')
<h4>Edit Admin {{ $postId }}</h4>

@include('partials.errors')

<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.update') }}" method="post">
            {{ csrf_field() }}
            
            <input type="hidden" name="id" value="{{ $postId }}" />

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                value="{{ $post->title }}" />
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" row="4" placeholder="Content">{{$post->content}}</textarea>
            </div>
            @foreach($tags as $tag)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id}}" {{$post->tags->contains($tag->id) ? 'checked' : '' }} >{{$tag->name}}
                    </label>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

