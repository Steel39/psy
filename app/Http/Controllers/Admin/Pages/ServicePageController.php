<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPage\ServiceRequest;
use App\Models\Pages\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;
class ServicePageController extends Controller
{
    public function index()
    {
        $services = Service::all()->toArray();
        return Inertia::render('Admin/UserPages/Service', [
            'services'=> $services
        ]);
    }

    public function store(ServiceRequest $request)
    {
        $data = $request->validated();

        Service::create($data);
        return redirect()->back();
    }

    public function update()
    {

    }
}
