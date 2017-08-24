@extends('layouts.app')

@section('content')
    @include('messages.message')
    <response :id="{{ $message->id }}"></response>
@endsection