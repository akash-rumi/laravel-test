@extends('layout')
@section('title')
    Contact
@endsection
@section('title_content')
    Contact US
@endsection

@section('content')
    @can('home.secret')
        <p>
            <a href="{{ route('secret') }}">
                Go to special contact details!
            </a>
        </p>
    @endcan
@endsection