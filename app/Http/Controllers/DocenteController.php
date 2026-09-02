<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Materia;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{

    public function create()
    {
        // probando
        if (auth()->user()->rol !== 'prosecretario') {
            return redirect()->route('home');
        }//fin
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        // probando
        if (auth()->user()->rol !== 'prosecretario') {
            return redirect()->route('home');
        }//fin
        $docente = Docente::create([
        'DNI' => $request->input('DNI', $request->input('dni')),
        'nombre' => $request->input('nombre'),
        'apellido' => $request->input('apellido'),
        'telefono' => $request->input('telefono'),
        'email' => $request->input('email'),
        'id_huella' => $request->input('id_huella'),
    ]);

    if ($request->has('materia')) {
            $materias = $request->input('materia');
            $turnos   = $request->input('turno');
            $cursos   = $request->input('curso');
            $divisiones = $request->input('division');
            $entradas = $request->input('entrada');
            $salidas  = $request->input('salida');

            foreach ($materias as $index => $nombreMateria) {
                if (!empty($nombreMateria)) {
                    $nuevaMateria = Materia::create([
                        'nombre' => $nombreMateria,
                        'turno' => $turnos[$index],
                        'curso' => $cursos[$index],
                        'division' => $divisiones[$index],
                        'horario_inicio' => $entradas[$index],
                        'horario_finalizacion' => $salidas[$index],
                    ]);

                    DB::table('docentes_materias')->insert([
                        'id_docente'  => $docente->id_docente,
                        'id_materias' => $nuevaMateria->id_materias,
                    ]);
                }
            }
        }

    return back()->with('exito', 'Docente guardado correctamente');
    }
}