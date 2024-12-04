<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPage\MainPageRequest;
use App\Models\Pages\MainPage;
use Illuminate\Support\Facades\Storage;

use Inertia\Inertia;
class MainPageController extends Controller
{
    public function index()
    {
        $data = MainPage::all();
        return Inertia::render('Admin/UserPages/Main', [
            'mainData' => $data,
        ]);
    }

    public function store(MainPageRequest $request)
    {
        if (MainPage::count() >= 1) {
            return response()->json(['message' => 'Можно добавить только 1 Запись.'], 403);
        }
        $data = $request->validated();

        if (isset($data['image']) ) {
            $data['image'] = Storage::disk('public')->put('main_page', $data['image']);

        } else {
            unset($data['image']);
        }
        MainPage::create($data);
    }

    public function update(MainPageRequest $request, MainPage $id)
    {
        $data = $request->validated();
        if ($data['image'] ===  null) {
            unset($data['image']);
        } else {
            $data['image'] = Storage::disk('public')->put('main_page', $data['image']);
        }

        $id->update($data);
        return redirect()->back();
    }

    public function destroy(MainPage $id)
    {
        $id->delete();
        return redirect()->back();
    }
}
