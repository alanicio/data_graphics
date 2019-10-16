<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lava;
use View;
use Illuminate\Support\Facades\DB;


class ExampleController extends Controller
{
    public function index()
    {
        $data=DB::table('Cal_Dinos')->select('Desv med lbf')->get();
        $array = array_values(get_object_vars($data[0]));
        dd(floatval($array[0]));
    }
}
