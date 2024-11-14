<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function create()
    {

    }


    public function store(Request $request): RedirectResponse
    {
        $data = $request->validated();
        Question::create($data);
        return redirect()->back();
    }
}
