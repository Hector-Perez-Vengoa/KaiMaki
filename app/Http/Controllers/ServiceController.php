<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function servicios(){
        return view('servicios');
    }
    public function show()
    {
        $services = [
            'Gasfitería',
            'Electricidad',
            'Albañilería',
            'Carpintería',
            'Pintura',
            'Cerrajería',
            'Tecnología'
        ];

        return view('servicios', compact('services'));
    }

}
