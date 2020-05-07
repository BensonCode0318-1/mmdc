<?php

namespace App\Http\Controllers;
use App\Help\JsonResponse;
use Illuminate\Http\Request;
use App\Data;

class dataController extends Controller
{
    public function index(){
        $data = Data::all();
        return response()->json(['data' => $data]);
    }
    //
}
