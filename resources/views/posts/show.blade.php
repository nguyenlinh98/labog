@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('posts')}}">Back</a>
        <div class="title_post" style="margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji; ">
            <h1 style="font-size: 50px;">{{$post->title}}</h1>
        </div>
        <h2>
            @if($post->user_id == 0)
                <small><i class="fa fa-user-tag"></i> made by Test</small>
            @else
                <small><i class="fa fa-user-tag"></i> made by <a href="">{{$post->user->name}}</a></small>
            @endif
        </h2>
        <hr style="size:1px ; color:#ecf0f1">
        <div class="form-inline">
            <span><i class="fa fa-calendar-alt"></i> Posted on:<small>{{$post->created_at}}</small>|</span>
            <span><i class="fa fa-tags"></i>Category: {{$post->category->name}}</span>
        </div>
        <br>
        <div class="content_post" style="font-family: initial;">
            <h3>{{$post->content}}
            </h3>
        </div>

    </div>

@endsection