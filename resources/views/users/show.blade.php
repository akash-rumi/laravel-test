
@extends('layout')
@section('title')
    User 
@endsection

@section('title_content')
    Profile
@endsection
@section('content')
    <div class="card container" >
        <div class="row">
            <div class="col-4 mt-4">
                <img class="card-img-top" src="..." alt="Card image cap">
            </div>
            <div class="col-8 card-body">
                <h3>Name: {{ $user->name }}</h3>
            </div>
        </div>
    </div>
@endsection

