<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserQuestionController extends Controller
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


    public function store(QuestionRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Question::create($data);
        return redirect()->back();
    }
}
