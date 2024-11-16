<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all()->toArray();
        return Inertia::render('Admin/Question', [
            'questions' => $questions,
        ]);
    }
}
