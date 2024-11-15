<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Http\Requests\CertificateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Certificate::all()->toArray();
        return Inertia::render('Admin/Certificate', [
            'certificates' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificateRequest $request): void
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = Storage::disk('public')->put('certificates', $data['image']);
        }
        Certificate::create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CertificateRequest $request, Certificate $certificate)
    {
        $data = $request->validated();
        if ($data['image'] !== null ) {
            $data['image'] = Storage::disk('public')->put('certificates', $data['image']);

        } else {
            unset($data['image']);
        }
        $certificate->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
    }
}
