<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


use function PHPUnit\Framework\returnSelf;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all()->toArray();
        return Inertia::render('Admin/Category', [
            'categories' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
         ]);
        Category::create([
            'name' => $request->name,
        ]);
        return Redirect::route('category.index');
    }

    public function update(Request $request, Category $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $id->update($request->only('name'));
        return redirect()->back();
    }

    public function destroy(Category $id)
    {
        $id->delete();
        return Redirect::route('category.index');
    }
}
