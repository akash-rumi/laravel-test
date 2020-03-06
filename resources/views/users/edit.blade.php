
@extends('layout')
@section('title')
    User 
@endsection

@section('title_content')
    Profile
@endsection
@section('content')
    @error @enderror
    <form method="POST" enctype="multipart/form-data"
        action="{{ route('user.update', ['user' => $user->id]) }}"
        class="form-horizontal">

        @csrf
        @method('PUT')

        <div class="card container">
            <div class="row">
                <div class="col-4 mt-4">
                    <img class="card-img-top" src="{{ $user->image ? $user->image->url() : '' }}" alt="Card image cap">
    
                    <div class="card mt-4">
                        <div class="card-body">
                            <h6>Upload a different photo</h6>
                            <input class="form-control-file" type="file" name="avatar" />
                        </div>
                    </div>
                </div>
                <div class="col-8 card-body">
                    <div class="form-group">
                        <label>Name:</label>
                        <input class="form-control"  type="text" name="name" value="{{$user->name}}"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Update" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection 