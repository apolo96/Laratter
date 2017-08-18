@extends('layouts.app')
@section('content')

    <nav>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a href="/" class="nav-link">Laratter</a>
            </li>
        </ul>
    </nav>
    <div class="row">
        <div class="col-12">
            <form action="/messages/create" method="post">
                {{ csrf_field() }}
                <div class="form-group @if($errors->has('message')) has-danger @endif">
                    <input type="text"
                           class="form-control"
                           placeholder="Que estas pensando ?"
                           name="message">
                    @if($errors->has('message'))
                        @foreach($errors->get('message') as $error)
                            <div class="form-control-feedback">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @forelse($messages as $message)
            @include('messages.message')
        @empty
            <div class="col-6">
                <p>No hay mensajes para mostrar</p>
            </div>
        @endforelse
        @if(count($messages))
            <div class="mt-2 mx-auto">
                {{ $messages->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection