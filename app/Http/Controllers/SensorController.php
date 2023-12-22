<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Mongo;
use App\Http\Resources\PhResource;

class SensorController extends Controller
{

    public function index()
    {
        $latestData = Sensor::latest()->first();
        $recentData = Sensor::orderBy('created_at', 'desc')
            ->orderBy('Temperature', 'desc')
            ->orderBy('pH', 'desc')
            ->take(5)
            ->get();

        return view('ph', compact('latestData', 'recentData'));
    }

    public function store(Request $request)
    {

        // Simpan data ke MongoDB, haiiiiii
        $Ph = new Sensor;
        $Ph->pH = $request->pH;
        $Ph->temperature = $request->temperature;
        $Ph->save();

        // Mengembalikan response berhasil
        return response()->json(['message' => 'Data saved successfully'], 201);
    }

    public function aturWaktu(Request $request)
    {
        // Ambil data waktu dari permintaan NodeMCU
        $data = $request->json()->all();

        // Validasi data waktu (pastikan formatnya sesuai dengan yang diharapkan)
        $waktu = $data['waktu'];

        // Kirim data waktu ke NodeMCU
        $response = Http::post('http://alamat-nodemcu/endpoint-nodemcu', [
            'waktu' => $waktu,
        ]);

        if ($response->successful()) {
            return response()->json(['message' => 'Waktu berhasil diatur di NodeMCU']);
        } else {
            return response()->json(['message' => 'Gagal mengatur waktu di NodeMCU'], 500);
        }
    }

    public function ambilWaktu()
    {
        // Ambil waktu dari server (misalnya, waktu saat ini)
        $waktu = now(); // Waktu saat ini dalam format tanggal dan waktu

        // Kirim waktu sebagai respons
        return response()->json(['waktu' => $waktu]);
    }


    // public function wkt() {
    //     $latestData = Sensor::latest()->first();

    //     return response()->json(['latestData' => $latestData]);
    // }

    public function wkt() {
        $latestData = Sensor::latest()->first();
        $recentData = Sensor::orderBy('created_at', 'desc')
            ->orderBy('Temperature', 'desc')
            ->orderBy('pH', 'desc')
            ->take(5)
            ->get();

        return view('waktu', compact('latestData', 'recentData'));
}

public function getSensor()
{
    // Mengambil data pH dan Temperature dari koleksi MongoDB yang sesuai dengan model Pakan
    $dataSensor = Sensor::latest()->select('pH', 'temperature')->first();

    // Merespons data waktu dalam format JSON
    return response()->json(['pH' => $dataSensor->pH, 'temperature' => $dataSensor->temperature]);
}

}
