<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 


class UserController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los usuarios y paginarlos (por ejemplo, 10 por página)
        $users = User::paginate(10);

        // Retornar la vista de listado, pasando la variable $users
        return view('users.index', compact('users'));
    }

    // ... (rest of the controller methods: create, store, show, edit, update, destroy)


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
