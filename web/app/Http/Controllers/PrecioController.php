<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Mas detalles acerca de cada método se encuentran en la clase Zona (Son análogos) y documentación.
// https://laravel.com/docs/10.x/controllers#restful-partial-resource-routes
class PrecioController extends Controller
{
    public function index()
    {
        return view('admin.panel.precio.index');    
    }

    public function create()
    {
    }

    public function store(Request $request)
    {

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
    }
}