<?php

namespace App\Http\Controllers;

use App\Models\Trabajadores;
use App\Models\Clientes;
use App\Models\Solicitud;
use App\Models\imagenSolicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function servicios(Request $request)
{
    $search = $request->get('search');

    // Si hay un término de búsqueda, filtrar por el nombre del oficio
    if ($search) {
        $trabajadores = Trabajadores::whereHas('oficios', function ($query) use ($search) {
                $query->where('nombre_oficio', $search);
            })
            ->with(['oficios', 'users']) // Carga los oficios y usuario relacionado con su imagen
            ->get();
    } else {
        $trabajadores = Trabajadores::with(['oficios', 'users'])->get(); // Mostrar todos los trabajadores con sus oficios e imágenes
    }

    // Pasar los datos a la vista
    return view('servicios.servicios')->with('trabajadores', $trabajadores);
}

    public function elegir($id_trabajadores)
    {
        // Realizar la consulta con Eloquent y seleccionar solo los campos necesarios
        $trabajador = Trabajadores::select(
                'trabajadores.id_trabajadores',
                'trabajadores.nombres',
                'trabajadores.apellidos',
                'trabajadores.puntuacion',
                'trabajadores.telefono',
                'trabajadores.sexo',
                'users.email',
                'users.profile_photo_path',
                'oficios.nombre_oficio',
                'ubicacion.ciudad',
                'ubicacion.direccion',
                'ubicacion.distrito'
            )
            ->join('users', 'trabajadores.id_usuario', '=', 'users.id')
            ->join('trabajadores_oficio', 'trabajadores.id_trabajadores', '=', 'trabajadores_oficio.id_trabajadores')
            ->join('oficios', 'trabajadores_oficio.id_oficios', '=', 'oficios.id_oficios')
            ->leftJoin('ubicacion', 'trabajadores.id_ubicacion', '=', 'ubicacion.id_ubicacion')
            ->where('trabajadores.id_trabajadores', $id_trabajadores)
            ->firstOrFail();
    
        // Pasar el trabajador a la vista
        return view('servicios.serperfil', compact('trabajador'));
    }

    public function solicitar(Request $request)
    {
        $request->validate([
            'id_trabajadores' => 'required|exists:trabajadores,id_trabajadores',
            'fech_reserva' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'descripcion' => 'required|string',
            'imagen_solicitud.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Crear solicitud
        $solicitud = Solicitud::create([
            'id_estado_solicitudes' => 1, // Asignar estado inicial
            'id_trabajadores' => $request->id_trabajadores,
            'id_cliente' => Auth::user()->cliente->id_cliente, // Asumir cliente autenticado
            'fech_reserva' => $request->fech_reserva,
            'descripcion' => $request->descripcion,
            'hora_inicio_propuesta' => $request->hora_inicio,
        ]);

        // Guardar las imágenes
        if ($request->hasFile('imagen_solicitud')) {
            foreach ($request->file('imagen_solicitud') as $imagen) {
                $ruta = $imagen->store('imagenes_solicitudes', 'public');
                imagenSolicitud::create([
                    'id_solicitudes' => $solicitud->id_solicitudes,
                    'ruta_imagen' => $ruta,
                ]);
            }
        }

        // Redirigir a la vista con mensaje de éxito
        return redirect()->route('servicios')->with('success', 'Solicitud creada correctamente.');
    }
    
    
    
    
    
    

    
}
