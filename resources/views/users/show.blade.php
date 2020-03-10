
@extends('layout')
@section('title')
    User 
@endsection

@section('title_content')
    Profile
@endsection
@section('content')
    @if(session()->has('status'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('status') }}
            </div>
    @endif  
    <div class="card container" >
        <div class="row">
            <div class="col-4 mt-4">
                <img class="card-img-top" src="{{ $user->image ? $user->image->url() : '' }}" alt="Card image cap">
            </div>
            <div class="col-8 card-body">
                <h3>Name: {{ $user->name }}</h3>
                <h4>Email: {{ $user->email }}</h4>
                @auth
                    @can('update', $user)
                        <a href="{{route('user.edit',['user'=>$user->id])}}" type="button" class="btn btn-secondary btn-block">Edit Profile</a>
                    @endcan
                @endauth
                <br>
                <hr>
                @commentForm(['route' => route('user.comments.store', ['user' => $user->id]) ])
                @endcommentForm
                @commentList(['comments' => $user->commentsOn])
                @endcommentList
            </div>
        </div>
    </div>
@endsection

