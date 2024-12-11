<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;
class ContactPageController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return Inertia::render('Admin/UserPages/Contact', [
        'contacts' => $contacts,
    ]);
    }
    public function store(Request $request)
    {

    }

    public function update()
    {

    }
}
