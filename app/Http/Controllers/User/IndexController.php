<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Post;
use App\Models\Category;
use App\Models\Pages\About;
use App\Models\Pages\Answer;
use App\Models\Pages\MainPage;
use Inertia\Inertia;
use Inertia\Response;
class IndexController extends Controller
{
    public function index(): Response
    {
        $data = MainPage::all();
        return Inertia::render('Welcome', [
            'mainData' => $data,
        ]);
    }

    public function blog(): Response
    {
        $categories = Category::all()->toArray();
        $posts = Post::all()->toArray();
        return Inertia::render(
            'User/Blog',
            [
                'posts' => $posts,
                'categories' => $categories,

            ]
        );
    }

    public function categoryPost($categoryName, $categoryId): Response
    {

        $posts = Post::where('category_id', $categoryId)->get()->toArray();


        $categories = Category::all()->toArray();
        return Inertia::render(
            'User/Blog',
            [
                'posts' => fn() => $posts,
                'categories' => $categories,
            ]
        );
    }

    public function certificate(): Response
    {
        $data = Certificate::all()->toArray();
        return Inertia::render(
            'User/Certificate',
            [
                'certificates' => $data,
            ]
        );
    }

    public function post(Post $id): Response
    {
        $post = Post::find($id->id)->toArray();
        return Inertia::render('User/Post', ['post' => $post]);
    }

    public function contact(): Response
    {
        return Inertia::render('User/Contact');
    }

    public function about(): Response
    {
        $abouts = About::all()->toArray();
        return Inertia::render('User/About', [
            'abouts' => $abouts,
        ]);
    }
    public function answer(): Response
    {
        $answers = Answer::all();
        return Inertia::render('User/Answer', [
            'answers' => $answers,
        ]);
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
