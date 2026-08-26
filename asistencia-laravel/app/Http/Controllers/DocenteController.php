<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;

class DocenteController extends Controller
{
    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        Docente::create($request->all());

        return back()->with('exito', 'Docente guardado correctamente');
    }
}