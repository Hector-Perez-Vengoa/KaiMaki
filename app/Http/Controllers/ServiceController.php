<?php

namespace App\Http\Controllers;

use App\Models\Trabajadores;
use App\Models\Solicitud;
use Illuminate\Http\Request;

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
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'id_trabajadores' => 'required|exists:trabajadores,id_trabajadores',
            //'id_cliente' => 'required|exists:clientes,id_cliente',
            'fech_reserva' => 'required|date',
            'descripcion' => 'required|string|max:500',
            //'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        /*// Guardar la imagen si existe
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('imagenes_solicitudes', 'public');
        }*/
    
        // Crear una nueva solicitud
        $solicitud = new Solicitud();
        $solicitud->id_estado_solicitudes = 1; // Por ejemplo, estado inicial "Pendiente"
        $solicitud->id_trabajadores = $validatedData['id_trabajadores'];
        //$solicitud->id_cliente = $validatedData['id_cliente'];
        $solicitud->fech_reserva = $validatedData['fech_reserva'];
        $solicitud->descripcion = $validatedData['descripcion'];
        //$solicitud->imagen = $rutaImagen; // Guardar la ruta de la imagen si se subió
        $solicitud->save();
    
        // Redirigir al usuario con un mensaje de éxito
        return redirect()->back()->with('success', 'Solicitud enviada con éxito.');
    }
    
    
    
    

    
}
