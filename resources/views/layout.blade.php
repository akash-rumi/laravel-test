<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ mix('css/app.css')}}">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            u
            {
                color: #27b30d;
            }

            .m-b-md {
                /* margin-bottom: 30px; */
            }
        </style>
    </head>
    <body>
        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="navbar-brand" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="{{ route('post.index') }}">BLOG</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="{{ route('post.create') }}">Write Blog</a>
                        </li>
                        {{-- <a href="{{ route('post.tags.index', ['tag' => $tag->id]) }}" class="badge badge-success"> {{ $tag->name }}</a> --}}
                        
                        <li class="nav-item dropdown">
                            <a class="navbar-brand nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Catagories
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach (App\Tag::all() as $tag)
                                    <a class="dropdown-item" href="{{ route('post.tags.index', ['tag' => $tag->id]) }}" class="badge badge-success"> {{ $tag->name }}</a>
                                @endforeach
                            </div>
                          </li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="{{ route('contact') }}">Contact</a>
                        </li>
                        <li class="nav-item active">
                            <a class="navbar-brand" href="{{ route('about') }}">About US</a>
                        </li>
                    </ul>
                    <div class="form-inline my-2 my-lg-0">
                        @guest
                            @if (Route::has('register'))
                                <a class="btn btn-outline-warning" href="{{ route('register') }}">Register</a>&nbsp;&nbsp;
                            @endif
                            &nbsp;&nbsp;<a class="btn btn-outline-success" href="{{ route('login') }}">Login</a>
                            @else
                                <a class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout ({{ Auth::user()->name }})</a>
        
                            <form id="logout-form" action={{ route('logout') }} method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </div>
                </div>
            </nav>
            <div class="title m-b-md">
                @yield('title_content')
            </div>
        </div>
        <div style="margin:0px 20px">
            @yield('content')
        </div>
        <script {src="{{ mix('js/app.js')}}"></script>
    </body>
</html>