@extends('layouts.admin')

@section('content')
<h4>Edit Admin {{ $id }}</h4>

@include('partials.errors')

<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.update') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                value="{{ $post['title'] }}" />
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" row="4" placeholder="Content">
                {{$post['content']}}
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

