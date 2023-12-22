<?php
namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Mongo;

class TempController extends Controller
{
    public function index()
    {
        $latestData = Sensor::latest()->first();
        $recentData = Sensor::orderBy('created_at', 'desc')
            ->orderBy('Temperature', 'desc')
            ->orderBy('pH', 'desc')
            ->take(5)
            ->get();

        return view('Temp', compact('latestData', 'recentData'));
    }



    public function storeData(Request $request)
    {
        // Validasi request jika diperlukan
        $this->validate($request, [
            'data' => 'required|string'
        ]);

        // Simpan data ke MongoDB
        $data = $request->input('data');
        NodeData::create([
            'data' => $data
        ]);

        return response()->json(['message' => 'Data saved successfully'], 201);
    }
}


