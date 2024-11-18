<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome');
    }

    public function blog()
    {
        $posts = Post::all()->toArray();
        return Inertia::render('User/BlogShow', ['posts' => $posts]);
    }

    public function contact()
    {

    }

    public function about()
    {

    }

}
