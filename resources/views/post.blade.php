@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="navbar navbar-inverse">
                        <div class="row" style="margin: 12px; color: #BBBBBB ">
                        <div class="col-md-4 text-left">Author: {{ $post->author->username }}</div>
                        <div class="col-md-4 text-center">
                            @if($subscribed) Subscribed
                            @else
                                @if (Auth::check())
                                    <a style="color: #CCCCCC"
                                       href="{{ $post->author->id }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('subscribe-form{{ $post->id }}').submit();">
                                        Subscribe
                                    </a>

                                    <form id="subscribe-form{{ $post->id }}" action="{{ route('new_sub_submit') }}" method="POST" style="display: none;">
                                        <input type="hidden" id="author_id" name="author_id" value="{{ $post->author->id }}">
                                    {{ csrf_field() }}
                                    </form>
                                    @else SUCK DICK
                                    @endif
                            @endif
                        </div>
                        <div class="col-md-4 text-right">{{ $post->created_at }}</div>
                        </div></div>
                    <div class="panel-heading">
                        <strong><h2>{{ $post->title }}</h2></strong>
                    </div>
                    <div class="panel-body">{{ $post->content }}</div>
                </div>
                <div class="">
                    @foreach ($post->tags_array() as $tag)
                        #{{ $tag }}
                    @endforeach
                </div>
                @foreach ($comments as $comment)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Author: {{ $comment->author->username }}
                            <div class="pull-right"> {{ $comment->created_at }}</div>
                        </div>
                        <div class="panel-body">{{ $comment->content }}</div>
                    </div>
                @endforeach

                @if (Auth::check())
                <form class="form-horizontal" method="POST" action="{{ '/post/'.$post->id }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        <label for="content" class="col-md-8">Submit Commentary:</label>
                        <br style="clear: both;">
                        <div class="col-md-8">
                            <textarea id="content" class="form-control" name="content" cols = '30' rows = '8' required></textarea>

                            @if ($errors->has('content'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-0">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="text-warning" href="{{ route('login') }}"><h2>Log in to leave comments!</h2></a>
                        </div>
                    </div>
                 @endif
            </div>
        </div>
    </div>
@endsection
