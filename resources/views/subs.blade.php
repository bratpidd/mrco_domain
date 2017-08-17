@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @foreach ($posts as $post)
                    <div class="panel panel-default">

                        <nav class="navbar navbar-inverse">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('new_sub_submit') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('subscribe-form').submit();">
                                                Subscribe
                                            </a>

                                            <form id="subscribe-form" action="{{ route('new_sub_submit') }}" method="POST" style="display: none;">
                                                <input type="hidden" id="author_id" name="author_id" value="kok">
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
                        <div class="panel-footer"><a href = '/post/{{ $post->id }}'>kok comments</a></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
