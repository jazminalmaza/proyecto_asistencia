<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Asistencia;
use Carbon\Carbon;

class AsistenciaController extends Controller
{

    public function index(Request $request)
    {
        $query = Asistencia::query();

        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        if ($request->filled('docente')) {
            $query->where('nombre_docente', 'like', '%' . $request->docente . '%');
        }

        $asistencias = $query->orderBy('fecha', 'desc')->paginate(10);

        return view('asistencia.index', compact('asistencias'));
    }

    public function create(){
        return view('asistencia.registrar'); 
    }

    public function store(Request $request)
    {
        $codigoHuella = trim($request->input('codigo_huella'));

        $ahora = Carbon::now();
        $hoy = $ahora->toDateString();
        $horaActual = $ahora->toTimeString();

        $docente = Docente::where('id_huella', (string) $codigoHuella)->first();

        if (!$docente) {
            return back()->with('error', 'Código de huella no encontrado.');
        }

        $materia = $docente->materias()->first();
        $nombreMateria = $materia ? $materia->nombre : 'Sin materia';
        $turnoMateria  = $materia ? $materia->turno : 'N/A';

        $asistencia = Asistencia::where('nombre_docente', $docente->nombre . ' ' . $docente->apellido)
            ->where('fecha', $hoy)
            ->first();

        if (!$asistencia) {
            $estadoCalculado = 'Presente';

            if ($materia && $materia->horario_inicio) {
                $inicioMateria = Carbon::parse($hoy . ' ' . $materia->horario_inicio);
                $limiteTolerancia = $inicioMateria->copy()->addMinutes(15);

                if ($ahora->lessThanOrEqualTo($inicioMateria)) {
                    $estadoCalculado = 'Presente';
                } elseif ($ahora->greaterThan($inicioMateria) && $ahora->lessThanOrEqualTo($limiteTolerancia)) {
                    $estadoCalculado = 'Tarde';
                } else {
                    $estadoCalculado = 'Ausente';
                }
            }

            Asistencia::create([
                'fecha'=> $hoy,
                'nombre_docente' => $docente->nombre . ' ' . $docente->apellido,
                'materia'=> $nombreMateria,
                'turno'=> $turnoMateria,
                'hora_ingreso' => $horaActual,
                'hora_egreso'=> null,
                'estado'=> $estadoCalculado,
            ]);

            return back()->with('exito', 'Entrada registrada a las ' . $horaActual );
        } else {
            $asistencia->update([
                'hora_egreso' => $horaActual,
            ]);

            return back()->with('exito', 'Salida registrada a las ' . $horaActual);
        }
    }
    
    public function edit(Request $request){
    $id = $request->query('id') ?? $request->id ?? array_key_first($request->query());

    $asistencia = Asistencia::findOrFail($id);

    return view('asistencia.edit', compact('asistencia'));
    }

public function update(Request $request){
    $id = $request->query('id') ?? $request->id ?? array_key_first($request->query());

    $asistencia = Asistencia::findOrFail($id);

    $asistencia->update([
        'hora_ingreso' => $request->entrada,
        'hora_egreso'  => $request->salida,
        'estado'       => $request->estado,
    ]);

    return redirect()->route('asistencia.index')->with('exito', 'Asistencia actualizada correctamente.');
    }
}