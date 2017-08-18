@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>{{$user->username}}</h1>
            <h3>
                <a href="{{route('follows',['username'=>$user->username])}}">
                    Siguiendo: <span class="badge badge-default">{{$user->follows->count()}}</span>
                </a>
            </h3>
            <h3>
                <a href="{{route('followers',['username'=>$user->username])}}">
                    Seguidores: <span class="badge badge-default">{{$user->followers->count()}}</span>
                </a>
            </h3>
            @if(Auth::check())
                @if(Gate::allows('dms',$user))
                    <form action="{{route('sendPrivateMessage',['username'=>$user->username])}}"
                          method="post">
                        {{ csrf_field() }}
                        <input type="text" name="message" class="form-control">
                        <input type="submit" class="btn btn-success">
                    </form>
                @endif
                @if(Auth::user()->isFollowing($user))
                    <form action="{{route('unfollow',['username'=>$user->username])}}" method="post">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-default" value="Dejar de seguir">
                    </form>
                @else
                    <form action="{{route('follow',['username'=>$user->username])}}" method="post">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-default" value="Seguir">
                    </form>
                @endif
                @if(session('success'))
                    <p>{{session('success')}}</p>
                @endif
            @endif

        </div>
        @foreach($messages as $message)
            @include('messages.message')
        @endforeach
        @if(count($messages))
            <div class="mt-2 mx-auto">
                {{ $messages->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>

@endsection