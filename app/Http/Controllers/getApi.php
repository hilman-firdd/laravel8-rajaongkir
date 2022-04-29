<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\City;
use App\Models\Province;

class getApi extends Controller
{
    public function index(Request $request){
        $nama = $request->nama;
        

        if($request->has('origin') && $request->has('destination') && $request->has('berat_paket') && $request->has('kurir')) {
            $origin = $request->origin;
            $destination = $request->destination;
            $weight = $request->berat_paket;
            $courier = $request->kurir;

            $response = Http::asForm()->withHeaders([
                'key' => '0c09d27e1f8c0618a003ceb30f780b38'
            ])->post('https://api.rajaongkir.com/starter/cost',[
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]);
            $result_cost = $response['rajaongkir']['results'][0]['costs'];
        }else{
            $origin = '';
            $destination = '';
            $weight = '';
            $courier = '';
            $result_cost = null;
        }
        
        $provinces = Province::all();
        return view('ongkir', compact('nama','provinces', 'result_cost'));
    }

    public function ajax($id){
        $citites = City::where('province_id', '=', $id)->pluck('city_name','id');
        return json_encode($citites);
    }
}
