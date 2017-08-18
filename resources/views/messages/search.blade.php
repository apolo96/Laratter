@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($messages as $message)
            @include('messages.message')
        @endforeach
    </div>
@endsection