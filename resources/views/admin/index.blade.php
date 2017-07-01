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

@endsection