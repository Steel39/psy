<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Service\PostService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Pest\Laravel\post;

class PostController extends Controller
{
    public function __construct(private readonly PostService $postService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all()->toArray();
        return Inertia::render('Admin/Post', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all()->toArray();
        $categories = Category::all()->toArray();
        return Inertia::render('Admin/CreatePost', [
            'tags' => $tags,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $this->postService->storePost($data);
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $id)
    {
        $post = Post::with(['tags', 'category'])->findOrFail($id->id);
        $post->time = Carbon::parse($post->created_at)->toDayDateTimeString();
        return Inertia::render('Admin/ShowPost', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
