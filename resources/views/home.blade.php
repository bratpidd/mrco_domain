@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @foreach ($posts as $post)
                <div class="panel panel-default">
                    <div class="panel-heading">Author: {{ $post->author->username }}
                        <div class="pull-right"> {{ $post->created_at }}</div>
                    </div>
                    <div class="panel-heading">
                        <strong><h2>{{ $post->title }}</h2></strong>
                    </div>
                    <div class="panel-body">{{ $post->content }}</div>
                    <div class="panel-footer"><a href = '/post/{{ $post->id }}'>{{ $post->comments_count }} comments</a></div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
