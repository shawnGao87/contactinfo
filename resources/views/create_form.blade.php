@extends('layout.layout')


@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Create New Contact</h1>
        </div>
        <div class="card-body">
            <form action="/contact/" method="POST">
                @method('post')
                @include('layout.contact_form')
            </form>
        </div>
    </div>
</div>
    
@endsection