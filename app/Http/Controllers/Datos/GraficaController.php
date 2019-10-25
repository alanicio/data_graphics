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

    public function verificentros($tipo)
    {
        if($tipo==1)
        {
            $verificentros=DB::table('Clientes')->where('Num_Dinos','>',0)->pluck('Verificentro');
        }
        if($tipo==2)
        {
            $verificentros=DB::table('Clientes')->where('Num_Fisicos','>',0)->pluck('Verificentro');
        }

        return view('datos.select_data',['datas'=>$verificentros]);
    }

    public function lineas($tipo)
    {
        if($tipo==1)
        {
            $num_lineas=DB::table('Cal_Dinos')->max('Linea');
        }
        if($tipo==2)
        {
            $num_lineas=DB::table('Cal_FM')->max('Linea');
        }

        return view('datos.select_data',['datas'=>range(1, $num_lineas)]);
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

    public function filtrar(Request $request)
    {
        $data=[];
        $color_fondo=[];
        $color_orilla=[];
        if($request->tipo==1)
        {
            $data_fake=DB::table('Cal_Dinos')->select(''.str_replace('+', ' ', $request->dato).'')->where(function($query) use($request){
                if(isset($request->fechaMenor) && isset($request->fechaMayor))
                {
                    $query->where('Fecha Calibracion','>=',$request->fechaMenor)->where('Fecha Calibracion','<=',$request->fechaMayor);
                }
                if(isset($request->verificentro))
                {
                    $query->where('Verificentro',$request->verificentro);
                }
                if(isset($request->linea))
                {
                    $query->where('Linea',$request->linea);
                }
            })->get();
            foreach($data_fake as $d){
                $array=array_values(get_object_vars($d));
                $data[]=floatval($array[0]);
            }
            $MetaData_fake=DB::table('Cal_Dinos')->select('Fecha calibracion')->where(function($query) use($request){
                if(isset($request->fechaMenor) && isset($request->fechaMayor))
                {
                    $query->where('Fecha Calibracion','>=',$request->fechaMenor)->where('Fecha Calibracion','<=',$request->fechaMayor);
                }
                if(isset($request->verificentro))
                {
                    $query->where('Verificentro',$request->verificentro);
                }
                if(isset($request->linea))
                {
                    $query->where('Linea',$request->linea);
                }
            })->get();
            foreach($MetaData_fake as $m){
                $array2=array_values(get_object_vars($m));
                $MetaData[]=(substr($array2[0],0,11));
            }
        }
        if($request->tipo==2)
        {
            $data_fake=DB::table('Cal_FM')->select(''.str_replace('+', ' ', $request->dato).'')->where(function($query) use($request){
                if(isset($request->fechaMenor) && isset($request->fechaMayor))
                {
                    $query->where('Fecha Calibracion','>=',$request->fechaMenor)->where('Fecha Calibracion','<=',$request->fechaMayor);
                }
                if(isset($request->verificentro))
                {
                    $query->where('Verificentro',$request->verificentro);
                }
                if(isset($request->linea))
                {
                    $query->where('Linea',$request->linea);
                }
            })->get();
            foreach($data_fake as $d){
                $array=array_values(get_object_vars($d));
                $data[]=floatval($array[0]);
            }
            $MetaData_fake=DB::table('Cal_FM')->select('Fecha calibracion')->where(function($query) use($request){
                if(isset($request->fechaMenor) && isset($request->fechaMayor))
                {
                    $query->where('Fecha Calibracion','>=',$request->fechaMenor)->where('Fecha Calibracion','<=',$request->fechaMayor);
                }
                if(isset($request->verificentro))
                {
                    $query->where('Verificentro',$request->verificentro);
                }
                if(isset($request->linea))
                {
                    $query->where('Linea',$request->linea);
                }
            })->get();
            foreach($MetaData_fake as $m){
                $array2=array_values(get_object_vars($m));
                $MetaData[]=(substr($array2[0],0,11));
            }
        }

        foreach ($data as $value) {
            $color_fondo[]='rgba('.rand(1,255).','.rand(1,255).','.rand(1,255).',0.2)';
            $color_orilla[]='rgba('.rand(1,255).','.rand(1,255).','.rand(1,255).',1)';
        }
        if(!isset($MetaData))
        {
            $MetaData=['Nada cumple los requisitos'];
        }
        return response()->json([
            'data'=>$data,
            'centros'=>$MetaData,
            'background'=>$color_fondo,
            'border'=>$color_orilla,
        ]);
    }
}
