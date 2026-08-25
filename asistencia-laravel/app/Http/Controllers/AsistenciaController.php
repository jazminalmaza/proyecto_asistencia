<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencia = Asistencia::all(); // Obtiene todas las asistencias de la BD
        return view('asistencia.index', compact('asistencia'));
    }

    public function create()
    {
        return view('asistencia.registrar');
    }

    public function store(Request $request)
    {
        Asistencia::create($request->all());

        return back()->with('exito', 'Asistencia marcada correctamente');
    }

    public function edit($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        return view('asistencia.edit', compact('asistencia'));
    }

    public function update(Request $request, $id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->update($request->all());

        return redirect()->route('asistencia.index')->with('exito', 'Asistencia actualizada correctamente');
    }
}