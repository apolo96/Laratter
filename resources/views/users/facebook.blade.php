@extends('layouts.app')
@section('content')
    <form action="{{route('register_facebook_account')}}" method="post">
        {{csrf_field()}}
        <div class="card">
            <div class="card-block">
                <img src="{{$user->avatar}}" class="img-thumbnail">
            </div>

            <div class="form-group">
                <label for="name" class="form-control-label">Nombre</label>
                <input type="text"
                       class="form-control"
                       name="name"
                       value="{{$user->name}}" readonly>
            </div>
            <div class="form-group">
                <label for="email" class="form-control-label">Email</label>
                <input type="text"
                       class="form-control"
                       name="email"
                       value="{{$user->email}}" readonly>
            </div>
            <div class="form-group">
                <label for="username" class="form-control-label">Nombre Usuario</label>
                <input type="text"
                       class="form-control"
                       name="username"
                       value="{{old('username')}}"
                       required>
            </div>
            <div class="card-footer">
                <input type="submit" value="Registrar" class="btn btn-primary">
            </div>
        </div>
    </form>
@endsection