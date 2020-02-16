<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function contact()
    {
        return view('contact');
    }

    public function about()
    {
        return view('about');
    }
    public function blogpost($id, $welcome = 1)
    {
        $page = [
            1 => ['title' => 'from PAGE 1',],
            2 => ['title' => 'from PAGE 2',],
        ];
        $welcomes = [
            1 => '<b>Hello</b>',
            2 => '<u>Welcome</u>'
        ];
        return view('blog-post', [
            'data' => $page[$id],
            'welcome' => $welcomes[$welcome],
        ]);
    }
}
