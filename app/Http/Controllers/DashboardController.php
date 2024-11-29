<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activePage = 'user-management'; // Define el valor según la página actual

        return view('administrador.usuarios.usuarios', compact('activePage'));
    }

    public function dashboard()
    {
        return view('administrador.dashboard.index', ['activePage' => 'dashboard']);
    }

    public function usuarios()
    {
        return view('administrador.usuarios.index', ['activePage' => 'usuarios']);
    }

    public function problemas()
    {
        return view('administrador.problemas.index', ['activePage' => 'problemas']);
    }

    public function servicios()
    {
        return view('administrador.servicios.index', ['activePage' => 'servicios']);
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
