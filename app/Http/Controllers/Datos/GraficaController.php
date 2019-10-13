<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficaController extends Controller
{
    public function index()
    {
    	return view('datos.presentacion_de_datos');
    }

    public function calibracion($tipo)
    {
    	$color_fondo=[];
    	$color_orilla=[];
    	if($tipo==1)
    	{
    		$data=DB::table('Cal_Dinos')->pluck('Mprim');
    		$MetaData=DB::table('Cal_Dinos')->pluck('linea');
    	}
    	if($tipo==2)
    	{
    		$data=DB::table('Cal_FM')->pluck('LEFT');
    		$MetaData=DB::table('Cal_FM')->pluck('linea');
    	}

    	foreach ($data as $value) {
    		$color_fondo[]='rgba('.rand(1,255).','.rand(1,255).','.rand(1,255).',0.2)';
    		$color_orilla[]='rgba('.rand(1,255).','.rand(1,255).','.rand(1,255).',1)';
    	}
    	return response()->json([
    		'data'=>$data,
    		'centros'=>$MetaData,
    		'background'=>$color_fondo,
    		'border'=>$color_orilla,
    	]);
    }
}
