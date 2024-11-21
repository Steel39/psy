<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
class ServicePageController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/UserPages/Service');
    }

    public function store(Request $request)
    {

    }

    public function update()
    {

    }
}
