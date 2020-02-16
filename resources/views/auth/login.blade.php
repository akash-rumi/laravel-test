@extends('layout')

@section('title')
    Log-in
@endsection

@section('title_content')
    Log In
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label>E-mail</label>
            <input name="email" value="{{ old('email') }}" required class="form-control{{ $errors->has('email') ? ' is-invalid': '' }}">
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div>
        <div class="form-group">
            <label>Password</label>
            <input name="password" type="password" required class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}">
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value="{{ old('remember') ? 'checked': '' }}">
                <label class="form-check-label" for="remember">
                    Remember Me
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Log in</button>
    </form>
@endsection
