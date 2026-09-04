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

    return redirect()->route('home')->with('exito', 'Docente guardado correctamente');
    }

    public function buscar(Request $request)
    {
        if (auth()->user()->rol !== 'prosecretario') {
            return redirect()->route('home');
        }

        $query = Docente::query();

        if ($request->filled('buscar')) {
            $term = $request->buscar;
            $query->where(function($q) use ($term) {
                $q->where('nombre', 'LIKE', "%{$term}%")
                  ->orWhere('apellido', 'LIKE', "%{$term}%")
                  ->orWhere('DNI', 'LIKE', "%{$term}%");
            });
        }

        $docentes = $query->get();

        return view('docentes.buscar', compact('docentes'));
    }

    public function edit($id)
    {
        if (auth()->user()->rol !== 'prosecretario') {
            return redirect()->route('home');
        }

        $docente = Docente::findOrFail($id);

        $materias = DB::table('materias')
            ->join('docentes_materias', 'materias.id_materias', '=', 'docentes_materias.id_materias')
            ->where('docentes_materias.id_docente', $id)
            ->select('materias.*')
            ->get();

        return view('docentes.edit', compact('docente', 'materias'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->rol !== 'prosecretario') {
            return redirect()->route('home');
        }

        $docente = Docente::findOrFail($id);

        $docente->update([
            'DNI'       => $request->input('DNI', $request->input('dni')),
            'nombre'    => $request->input('nombre'),
            'apellido'  => $request->input('apellido'),
            'telefono'  => $request->input('telefono'),
            'email'     => $request->input('email'),
            'id_huella' => $request->input('id_huella'),
        ]);

        if ($request->has('materia')) {
            $materiaIds = $request->input('materia_id');
            $materias   = $request->input('materia');
            $turnos     = $request->input('turno');
            $cursos     = $request->input('curso');
            $divisiones = $request->input('division');
            $entradas   = $request->input('entrada');
            $salidas    = $request->input('salida');

            foreach ($materias as $index => $nombreMateria) {
                if (!empty($nombreMateria)) {
                    $materiaId = $materiaIds[$index] ?? null;

                    if ($materiaId) {
                        Materia::where('id_materias', $materiaId)->update([
                            'nombre'               => $nombreMateria,
                            'turno'                => $turnos[$index],
                            'curso'                => $cursos[$index],
                            'division'             => $divisiones[$index],
                            'horario_inicio'       => $entradas[$index],
                            'horario_finalizacion' => $salidas[$index],
                        ]);
                    } else {
                        $nuevaMateria = Materia::create([
                            'nombre'               => $nombreMateria,
                            'turno'                => $turnos[$index],
                            'curso'                => $cursos[$index],
                            'division'             => $divisiones[$index],
                            'horario_inicio'       => $entradas[$index],
                            'horario_finalizacion' => $salidas[$index],
                        ]);

                        DB::table('docentes_materias')->insert([
                            'id_docente'  => $docente->id_docente,
                            'id_materias' => $nuevaMateria->id_materias,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('docentes.buscar')->with('exito', 'Docente actualizado correctamente');
    }

    public function destroyMateria($id)
    {
        if (auth()->user()->rol !== 'prosecretario') {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        DB::table('docentes_materias')->where('id_materias', $id)->delete();
        Materia::where('id_materias', $id)->delete();

        return response()->json(['success' => true]);
    }

    public function desactivar($id)
    {
        if (auth()->user()->rol !== 'prosecretario') {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $docente = Docente::findOrFail($id);
        // Cambia 'activo' por la columna que uses en tu BD (ej. estado = 0 o activo = false)
        $docente->activo = false; 
        $docente->save();

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Docente desactivado correctamente']);
        }

        return redirect()->back()->with('exito', 'Docente desactivado correctamente.');
    }

    public function destroy($id)
    {
        if (auth()->user()->rol !== 'prosecretario') {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $docente = Docente::findOrFail($id);
        
        // Limpiamos la relación en la tabla pivote y eliminamos el docente
        DB::table('docentes_materias')->where('id_docente', $id)->delete();
        $docente->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Docente eliminado correctamente']);
        }

        return redirect()->back()->with('exito', 'Docente eliminado correctamente.');
    }

}