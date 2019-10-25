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

    public function formulario($id){
        return view('datos.formulario_graficas',['id'=>$id]);
    }

    public function graficar(Request $request)
    {
    	$color_fondo=[];
    	$color_orilla=[];
        $data=[];
        $MetaData=[];
    	if($request->tipo==1)
    	{
    		$data_fake=DB::table('Cal_Dinos')->select(''.str_replace('+', ' ', $request->dato).'')->get();
            foreach($data_fake as $d){
                $array=array_values(get_object_vars($d));
                $data[]=floatval($array[0]);
            }
    		$MetaData_fake=DB::table('Cal_Dinos')->select('Fecha calibracion')->get();
            foreach($MetaData_fake as $m){
                $array2=array_values(get_object_vars($m));
                $MetaData[]=(substr($array2[0],0,11));
            }
    	}
    	if($request->tipo==2)
    	{
    		$data_fake=DB::table('Cal_FM')->select(''.str_replace('+', ' ', $request->dato).'')->get();
            foreach($data_fake as $d){
                $array=array_values(get_object_vars($d));
                $data[]=floatval($array[0]);
            }
    		$MetaData_fake=DB::table('Cal_FM')->select('Fecha calibracion')->get();
            foreach($MetaData_fake as $m){
                $array2=array_values(get_object_vars($m));
                $MetaData[]=(substr($array2[0],0,11));
            }
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

    public function filtrar_fecha(Request $request)
    {
        $data=[];
        $color_fondo=[];
        $color_orilla=[];
        if($request->tipo==1)
        {
            $data_fake=DB::table('Cal_Dinos')->select(''.str_replace('+', ' ', $request->dato).'')->where('Fecha Calibracion','>=',$request->fechaMenor)->where('Fecha Calibracion','<=',$request->fechaMayor)->get();
            foreach($data_fake as $d){
                $array=array_values(get_object_vars($d));
                $data[]=floatval($array[0]);
            }
            $MetaData_fake=DB::table('Cal_Dinos')->select('Fecha calibracion')->get();
            foreach($MetaData_fake as $m){
                $array2=array_values(get_object_vars($m));
                $MetaData[]=(substr($array2[0],0,11));
            }
        }
        if($request->tipo==2)
        {
            $data_fake=DB::table('Cal_FM')->select(''.str_replace('+', ' ', $request->dato).'')->where('Fecha Calibracion','>=',$request->fechaMenor)->where('Fecha Calibracion','<=',$request->fechaMayor)->get();
            foreach($data_fake as $d){
                $array=array_values(get_object_vars($d));
                $data[]=floatval($array[0]);
            }
            $MetaData_fake=DB::table('Cal_FM')->select('Fecha calibracion')->get();
            foreach($MetaData_fake as $m){
                $array2=array_values(get_object_vars($m));
                $MetaData[]=(substr($array2[0],0,11));
            }
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
