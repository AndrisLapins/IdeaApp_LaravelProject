@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br>
    <div>
        {!! $post->body !!}
    </div>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <br>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id || auth()->user()->admin == 1)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
            {{-- {!! Form::open(['action' => ['FavoritesController@add', $post->id], 'method' => 'POST']) !!}
                {{ Form::hidden('_method','PUT') }}
                {{ Form::submit('Favorite', ['class' => 'btn btn-warning']) }}
            {!! Form::close() !!} --}}

            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'style' => 'float:right;']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}

        @endif
    @endif
    @if(!Auth::guest())
        <a href="/comments/create/{{$post->id}}" class="btn btn-primary">Create Comment</a>
    @endif
    <hr>
    @if(count($comments) > 0)
        @foreach($comments as $comment)
         <div class="card card-body bg-light">
            {!! $comment->body !!}
            <br>
            <small>Written on {{$comment->created_at}} by {{$comment->user->name}}</small>
            <br>
            @if(!Auth::guest())
                @if(Auth::user()->id == $comment->user_id || auth()->user()->admin == 1)
                    <a href="/comments/{{$comment->id}}/edit" class="btn btn-info">Edit</a>

                    {!! Form::open(['action' => ['CommentsController@destroy', $comment->id], 'method' => 'POST']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!! Form::close() !!}
                @endif
            @endif
        </div>
        @endforeach
    @else
        <p>No comments found</p>
    @endif
    <br><br>
@endsection