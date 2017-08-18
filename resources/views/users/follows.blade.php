@extends('layouts.app')
@section('content')
    <h1>{{$user->name}}</h1>
    <h2>Siguiendo</h2>
    @foreach($user->follows  as $follow)
        <ul>
            <li>{{$follow->username}}</li>
        </ul>
    @endforeach
@endsection