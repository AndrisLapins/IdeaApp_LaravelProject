@extends('layouts.app')

@section('content')
    <h1>Create comment</h1>
    {!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body-text'])}}
        </div>
        {{ Form::hidden('thepostid', $post_id) }}
        
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection