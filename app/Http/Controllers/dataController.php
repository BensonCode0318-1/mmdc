<?php

namespace App\Http\Controllers;
use App\Help\JsonResponse;
use Illuminate\Http\Request;
use App\Model\Data;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class dataController extends Controller
{
    public function pyShow(Request $request){
        $params = $request->getContent();
        $params = json_decode($params,TRUE);
        #$params = json_encode($params);
        #Log::alert($params);
        
        foreach($params as $key=>$value){
            #Log::alert($value['name']);

            /*
            Data::insert('insert into ad_events (name, enabled, type, currency, click, exposure, click_rate, cpc_average, cost, conversion, conversion_after_view,single_conversion_cost,conversion_rate) values 
            (?,?,?,?,?,?,?,?,?,?,?,?,?)', 
            [$value['name'], $value['enabled'],$value['type'],$value['currency'],$value['click'],$value['exposure'],$value['click_rate'],$value['cpc_average'],$value['cost'],$value['conversion'],$value['conversion_after_view'],$value['single_conversion_cost'],$value['conversion_rate']]);
            */
            $id = Data::insert([
                [
                    'name'=>$value['name'],'enabled'=>$value['enabled'],'type'=>$value['type'],'currency'=>$value['currency'],'click'=>$value['click'],'exposure'=>$value['exposure'],
                    'click_rate'=>$value['click_rate'],'cpc_average'=>$value['cpc_average'],'cost'=>$value['cost'],'conversion'=>$value['conversion'],'conversion_after_view'=>$value['conversion_after_view'],
                    'single_conversion_cost'=>$value['single_conversion_cost'],'conversion_rate'=>$value['conversion_rate']
                
                ]
            ]);
        }
        #return response()->json(['data' => $params]);
    }

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
