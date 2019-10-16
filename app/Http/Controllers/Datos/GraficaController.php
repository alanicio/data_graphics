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
    		$columnas=DB::getSchemaBuilder()->getColumnListing('Cal_Dinos');

    	}
    	if($tipo==2)
    	{
    		$columnas=DB::getSchemaBuilder()->getColumnListing('Cal_FM');
    	}

    	return view('datos.select_data',['datas'=>array_slice($columnas, 6)]);
    }

    public function graficar(Request $request)
    {
    	$color_fondo=[];
    	$color_orilla=[];
        $data=[];
    	if($request->tipo==1)
    	{
    		$data_fake=DB::table('Cal_Dinos')->select(''.str_replace('+', ' ', $request->dato).'')->get();
            foreach($data_fake as $d){
                $array=array_values(get_object_vars($d));
                $data[]=floatval($array[0]);
            }
    		$MetaData=DB::table('Cal_Dinos')->pluck('linea');
    	}
    	if($request->tipo==2)
    	{
    		$data_fake=DB::table('Cal_FM')->select(''.str_replace('+', ' ', $request->dato).'')->get();
            foreach($data_fake as $d){
                $array=array_values(get_object_vars($d));
                $data[]=floatval($array[0]);
            }
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
