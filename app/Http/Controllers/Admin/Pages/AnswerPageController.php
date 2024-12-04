<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPage\AnswerRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use App\Models\Pages\Answer;
use Inertia\Inertia;

class AnswerPageController extends Controller
{
    public function index(): Response
    {
        $answers = Answer::all();
        return Inertia::render('Admin/UserPages/Answer', [
            'answers' => $answers
        ]);
    }
    public function store(AnswerRequest $request): void
    {
        $data = $request->validated();
        Answer::create($data);
    }

    public function update(AnswerRequest $request, Answer $id): RedirectResponse
    {
        $data = $request->validated();
        $id->updated($data);
        return redirect()->back();
    }

    public function destroy(Answer $id): RedirectResponse
    {
        $id->delete();
        return redirect()->back();
    }
}
