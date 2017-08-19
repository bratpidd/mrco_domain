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
                                <a id="like_a" class="pull-right"
                                   onclick="
                                           event.preventDefault();
                                           document.getElementById('form_like').submit();
                                           ">
                                    ♥
                                </a>
                                <a id="like_count" class="pull-right">0</a>
                                <form id="form_like" name="form_like" action="{{ route('new_like') }}" method="POST">
                                    <input type="hidden" id="post_id" name="post_id" value="{{ $post->id }}">
                                    <input type="submit" name="submit" id="submit" value="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
