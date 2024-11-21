<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
class MainPageController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/UserPages/Main');
    }
}
