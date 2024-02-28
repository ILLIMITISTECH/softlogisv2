<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DocumentRequis;
use App\Models\Sourcing;

class ManageDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allAgents = User::where('etat', 'actif')->get();

        $sourcingByBl = Sourcing::where('etat', 'actif')->get();

        $docs = DocumentRequis::where('etat', 'actif')->get();

        return view('admin.dashboard.gestionDocument', compact('allAgents', 'sourcingByBl', 'docs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
