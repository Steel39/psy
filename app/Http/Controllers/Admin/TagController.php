<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TagController extends Controller
{
    public function index()
    {
        $data = Tag::all()->toArray();
        return Inertia::render('Admin/Tag', [
            'tags' => $data
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:255'
            ]
        );
        Tag::create($data);
        return redirect()->back();
    }

    public function update(Request $request, Tag $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $id->update($request->only('name'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $id)
    {
        $id->delete();
        return redirect()->back();
    }
}
