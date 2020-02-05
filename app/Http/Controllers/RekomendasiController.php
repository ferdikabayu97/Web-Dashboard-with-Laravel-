<?php

namespace App\Http\Controllers;
use Route;
use Illuminate\Http\Request;
use Alert;
use App\Data_kode_lokasi;
class RekomendasiController extends Controller
{
    public function index(Request $request)
    {
		$req = '';
		return view('rekomend',['rekomendasi' => $req]);
 
    }
    

    
    public function result(Request $request)
    {
        $lat = (string) $_COOKIE['lat'];
        $lng = (string) $_COOKIE['lng'];
        $key = env('GOOGLE_MAPS_API_KEY');
        $response = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.',%20'.$lng.'&location_type=ROOFTOP&result_type=street_address&key='.$key.'');
        $response = json_decode($response);
        // dd($response->status);
        if($response->status == "ZERO_RESULTS"){
            Alert::error('Alamat tidak ditemukan')->autoclose(5000);
            $req = '';
            return view('rekomend',['rekomendasi' => $req]);
        }
        $kec= $response->results[0]->address_components[count($response->results[0]->address_components)-5]->long_name;
        if(substr($kec,0,9) == "Kecamatan"){
            $kec = substr($kec,10);
        }
        $kel= $response->results[0]->address_components[count($response->results[0]->address_components)-6]->long_name;
        // dd($kel);
        // . urlencode($t)
        $bool = Data_kode_lokasi::where('kecamatan', '=', $kec)->where('kelurahan', '=', $kel)->exists();
        if (!$bool){
            Alert::warning('Mohon maaf, Kecamatan '.$kec.' Kelurahan '.$kel.' Belum Terdaftar di Aplikasi Rekusaha')->autoclose(5000);
            $req = '';
            return view('rekomend',['rekomendasi' => $req]);
        }
        $as = 'http://rekusaha.com/api/req/?kecamatan='.$kec.'&'.'kelurahan='.$kel.'&'.'token=ferdi00001';
        $as = preg_replace('/\s+/', '%20', $as);
        // dd($as);
        $req = file_get_contents($as);
        $req = json_decode($req);
        $loc = array();
        $loc['kec'] = $kec;
        $loc['kel'] = $kel;
        // dd($req->hasil);
        Alert::success('Berikut rekomendasi usahanya','Hasil Ditemukan')->autoclose(5000);

        return view('rekomend',['rekomendasi' => $req->hasil, 'loc' => $loc]);
 
	}
}
