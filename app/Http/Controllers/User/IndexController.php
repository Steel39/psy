<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Post;
use App\Models\Category;
use Inertia\Inertia;
use Inertia\Response;
class IndexController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Welcome');
    }

    public function blog(): Response
    {
        $categories = Category::all()->toArray();
        $posts = Post::all()->toArray();
        return Inertia::render('User/Blog',
        [
            'posts' => $posts,
            'categories' => $categories,

        ]);
    }

    public function certificate(): Response
    {
        $data = Certificate::all()->toArray();
        return Inertia::render('User/Certificate',
        [
            'certificates' => $data,
        ]);
    }

    public function post(Post $id): Response
    {
        $post = Post::find($id->id)->toArray();
        return Inertia::render('User/Post', ['post'=> $post]);
    }

    public function contact(): Response
    {
        return Inertia::render('User/Contact');
    }

    public function about(): Response
    {
        return Inertia::render('User/About');
    }
    public function answer(): Response
    {
        return Inertia::render('User/Answer');
    }
    public function service(): Response
    {
        return Inertia::render('User/Service');
    }

    public function feedback(): Response
    {
        return Inertia::render('User/Feedback');
    }

}
