@extends('layouts.app')

@section('content')
<a href="/posts/create" class="btn btn-primary">Create Post</a>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{--  --}}
                    <h3>Your Blog Posts</h3>
                    <br>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                    <td>
                                        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no posts</p>
                    @endif
                    
                    {{-- For Admin Panel --}}
                    @if(!Auth::guest())
                        @if(Auth::user()->admin == 1)
                            <h3>Admin Panel</h3>
                            <div>
                            @if(count($users) > 0)
                                <table class="table table-striped">
                                    <tr>
                                        <th>Users</th>
                                        <th></th>
                                    </tr>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>
                                                {!! Form::open(['action' => ['AdminsController@destroy', $user->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <p>No ordinary users</p>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
