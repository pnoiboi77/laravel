@extends('layouts.master')

@section('content')
<h4>{{ $post['title'] }}</h4>
<p>{{ $post['content'] }}</p>
@endsection