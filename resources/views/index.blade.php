@extends('layout.layout')


@section('content')

    <div class="container-fluid px-5 justify-content-center">
        @if (session('success'))
            <div class="alert alert-success" id="success_message" role="alert">
                {{session('success')}}
            </div>
        @endif
        <div id="delete_message"></div>
        <a href="/contact/create" class="btn btn-success">Create New Contact</a>
        <div id="allContacts"></div>
    </div>
@endsection