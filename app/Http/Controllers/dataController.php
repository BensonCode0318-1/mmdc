<?php

namespace App\Http\Controllers;
use App\Help\JsonResponse;
use Illuminate\Http\Request;
use App\Model\Data;
use GuzzleHttp\Client;

class dataController extends Controller
{
    public function index(){
        $data = Data::all();
        return response()->json(['data' => $data]);
    }

    public function show(Request $request){
        $params = $request->all();
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST','https://onesignal.com/api/v1/notifications',[
            'headers'=>[
                'Content-Type'=>'application/json; charset=utf-8',
                'Authorization'=>'Basic OWFkODNiNzktYzMwZC00YjcwLWJjNTEtYzk1MWYzYzAxYjk3'
            ],
            'json'=>[
                "app_id"=>"b2eef31d-d499-44b3-8071-762fc91e8eb0",
                "included_segments"=>["All"],
                "data"=>["foo"=>"bar"],
                "contents"=>["en"=>$params['content']],
                "headings"=>["en"=>$params['title']]
            ]
        ]);
    }
    //
}
