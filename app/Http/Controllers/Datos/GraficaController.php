<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraficaController extends Controller
{
    public function index()
    {
    	return view('datos.presentacion_de_datos');
    }
}
