@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            @foreach ($posts as $post)
                <div class="panel panel-default">

                    <nav class="navbar navbar-inverse">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"> {{ $post->author->username }}
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ $post->author->id }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('subscribe-form{{ $post->id }}').submit();">
                                            Subscribe
                                        </a>

                                        <form id="subscribe-form{{ $post->id }}" action="{{ route('new_sub_submit') }}" method="POST" style="display: none;">
                                            <input type="hidden" id="author_id" name="author_id" value="{{ $post->author->id }}">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li><a href="#">User Activity</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right" style="margin-right:0%;">
                            <li class="navbar-text">
                                {{ $post->created_at }}
                            </li>
                        </ul>

                    </nav>


                    <div class="panel-heading">
                        <strong><h2>{{ $post->title }}</h2></strong>
                    </div>
                    <div class="panel-body">{{ $post->content }}</div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a href = '/post/{{ $post->id }}'>{{ $post->comments_count }} comments</a>
                            </div>
                            <div class="col-md-6">
                                <a class="like_link" href="♥" id="a_like" data-post_id="{{ $post->id }}">
                                    <span class="pull-right">
                                        ♥
                                    </span>
                                </a>
                                <a id="like_count{{ $post->id }}" class="pull-right">0</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ csrf_field() }}
        </div>
    </div>
</div>
@endsection
