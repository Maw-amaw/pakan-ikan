<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Pakan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Mongo;
use App\Http\Resources\PhResource;

class PhController extends Controller
{
    public function show($slug)
   {
       return view('post', [
           'post' => Sensor::where('slug', '=', $slug)->first()
       ]);
   }





//     public function index()
// {
//     $Sensor = Sensor::latest()->first();
//     $phair = $Sensor->phair; // Mengambil nilai pH dari model Sensor
//     $waktu = $Sensor->waktu; // Mengambil nilai waktu dari model Sensor
//     $suhu = $Sensor->suhu; // Mengambil nilai suhu dari model Sensor
//     $created_at = $Sensor->created_at;

//     return view('welcome', compact('phair', 'waktu', 'suhu', 'created_at'));
// }


public function index()
{
    // Mengambil 1 data terakhir
    $latestData = Sensor::latest()->first();
    $pH = $latestData->pH;
    $temperature = $latestData->temperature;
    $created_at = $latestData->created_at;
    $jam2 = $latestData->jam2;
    $menit2 = $latestData->menit2;
    $hari2 = $latestData->hari2;
    $jam1 = $latestData->jam1;
    $menit1 = $latestData->menit1;
    $hari = $latestData->hari;
    $jam3 = $latestData->jam3;
    $menit3 = $latestData->menit3;
    $hari3 = $latestData->hari3;
    $created_at = $latestData->created_at;

    // Mengambil 5 data terbaru berdasarkan created_at, temperature, dan ph
    $recentData = Sensor::orderBy('created_at', 'desc')
                        ->orderBy('temperature', 'desc')
                        ->orderBy('pH', 'desc')
                        ->orderBy('jam2', 'desc')
                        ->orderBy('menit2', 'desc')
                        ->orderBy('hari2', 'desc')
                        ->orderBy('jam1', 'desc')
                        ->orderBy('menit1', 'desc')
                        ->orderBy('hari', 'desc')
                        ->orderBy('jam3', 'desc')
                        ->orderBy('menit3', 'desc')
                        ->orderBy('hari3', 'desc')
                        ->take(5)
                        ->get();

    return view('dashbord', compact('pH', 'temperature', 'created_at', 'recentData','jam2','menit2','hari2','jam1','menit1','hari','jam3','menit3','hari3'));
}


// public function tes()
// {
//     // Mengambil 1 data terakhir
//     $latestData = Pakanin::latest()->first();
//     $pH = $latestData->pH;
//     $suhu = $latestData->suhu;
//     $created_at = $latestData->created_at;

//     // Mengambil 5 data terbaru berdasarkan created_at, suhu, dan ph
//     $recentData = Sensor::orderBy('created_at', 'desc')
//                         ->orderBy('suhu', 'desc')
//                         ->orderBy('pH', 'desc')
//                         ->take(5)
//                         ->get();

//     return view('index', compact('pH', 'suhu', 'created_at', 'recentData'));
// }

// public function store(Request $request)
// {
//     $Ph = new Sensor;
//     $Ph->suhu = $request->suhu;
//     $Ph->waktu = $request->waktu;
//     $Ph->phair = $request->phair;
//     $Ph->save();

//     return response()->json(["result" => "ok"], 201);
// }

public function store(Request $request)
    {

        // Simpan data ke MongoDB
        $Ph = new Sensor;
        $Ph->phair = $request->phair;
        $Ph->suhu = $request->suhu;
        $Ph->waktu = $request->waktu;
        $Ph->save();

        // Mengembalikan response berhasil
        return response()->json(['message' => 'Data saved successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $Ph = Sensor::findOrFail($id);
        $Ph->phair = $request->input('phair');
        $Ph->suhu = $request->input('suhu');
        $Ph->waktu = $request->input('waktu');
        $Ph->save();

        return new PhResource($Ph);
    }

    public function destroy($id)
    {
        $Ph = Sensor::findOrFail($id);
        $Ph->delete();

        return response()->json(['message' => 'data berhasil dihapus']);
    }
}
