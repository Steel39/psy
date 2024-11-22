<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPage\AboutRequest;
use App\Models\Pages\About;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutPageController extends Controller
{
    public function index()
    {
        $data = About::all()->toArray();
        return Inertia::render('Admin/UserPages/About', ['about'=> $data]);
    }

    public function store(AboutRequest $request)
    {
        if (About::count() >= 1) {
            return response()->json(['message' => 'Можно добавить только одну запись.'], 403);
        }
        $data = $request->validated();
        if (isset($data['image']) ) {
            $data['image'] = Storage::disk('public')->put('about', $data['image']);

        } else {
            unset($data['image']);
        }
        About::create($data);

    }

    public function update()
    {

    }
}
