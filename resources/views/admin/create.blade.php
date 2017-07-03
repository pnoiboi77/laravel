@extends('layouts.admin')

@section('content')
<h4>Create Admin</h4>

@include('partials.errors')

<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.create') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" />
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" row="4" placeholder="Content"></textarea>
            </div>
            @foreach($tags as $tag)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id}}">{{$tag->name}}
                    </label>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

