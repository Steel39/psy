<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPage\AboutRequest;
use App\Models\Pages\About;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutPageController extends Controller
{
    public function index(): Response
    {
        $data = About::all()->toArray();
        return Inertia::render('Admin/UserPages/About', ['abouts'=> $data]);
    }

    public function store(AboutRequest $request)
    {
        if (About::count() >= 10) {
            return response()->json(['message' => 'Можно добавить только 10 Записей.'], 403);
        }
        $data = $request->validated();
        if (isset($data['image']) ) {
            $data['image'] = Storage::disk('public')->put('about', $data['image']);

        } else {
            unset($data['image']);
        }
        About::create($data);
    }

    public function update(AboutRequest $request, About $id): RedirectResponse
    {
        $data = $request->validated();
        if ($data['image'] ===  null) {
            unset($data['image']);
        } else {
            $data['image'] = Storage::disk('public')->put('about', $data['image']);
        }

        $id->update($data);
        return redirect()->back();

    }

    public function destroy(About $id): RedirectResponse
    {
        $id->delete();
        return redirect()->back();
    }
}
