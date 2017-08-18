@extends('layouts.app')
@section('content')
    <h1>{{$user->name}}</h1>
    <h2>Seguidores</h2>
    @foreach($user->followers  as $follower)
        <ul>
            <li>{{$follower->username}}</li>
        </ul>
    @endforeach
@endsection