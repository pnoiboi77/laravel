@extends('layouts.master')

@section('content')
    
        <h1>Some Content</h1>
        <p>{{ 2 == 2 ? "Hello" : "Does not equal" }}</p>
        @if(true)
            <h2>TRUE</h2>
        @else
            <h2>FALSE</h2>
        @endif
        <hr />
        @for($i = 0; $i < 5; $i++)
            <p>{{$i + 1}} iteration for 
            <a href="{{ route('blog.post', ['id' => $i]) }}">Post {{$i}}</a></p>
        @endfor
        <hr />
        <p>Non rendered script Code {{ "<script>alert('hello')</script>"}}</p>
        <p>Render HTML Code (check console output) {!! "<script>console.log('hello from injected script')</script>"!!}</p>
        <p class="testing">Checking URL Facade for main.css</p>        
@endsection

