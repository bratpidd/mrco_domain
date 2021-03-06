@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-lg-2 col-lg-offset-2 col-md-3 col-md-offset-1">
                <h3>Subscriptions:</h3>
                <ul class="list-group">
                    @foreach ($subs as $sub)
                        <li class="list-group-item">
                            {{ $sub[1] }}
                            <a class="pull-right" href="{{ route('cancel_sub') }}"
                            onclick="event.preventDefault();
                            document.getElementById('subscribe-form{{ $sub[0] }}').submit();">
                                cancel
                            </a>

                            <form id="subscribe-form{{ $sub[0] }}" action="{{ route('cancel_sub') }}" method="POST" style="display: none;">
                                <input type="hidden" id="author_id" name="author_id" value="{{ $sub[0] }}">
                                {{ csrf_field() }}
                            </form>

                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-4 col-md-offset-0">
                @foreach ($posts as $post)
                    <div class="panel panel-default">

                        <nav class="navbar navbar-inverse">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> {{ $post->author->username }}
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu">

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
                        <div class="panel-footer"><a href = '/post/{{ $post->id }}'>{{ $post->comments_count }} comments</a></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
