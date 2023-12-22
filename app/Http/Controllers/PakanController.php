<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pakan;
use Carbon\Carbon;
use App\Models\Mongo;

class PakanController extends Controller
{
    public function index()
    {
        // Mengambil 1 data terakhir
        $latestData = Pakan::latest()->first();
        $jam1 = $latestData->jam1;
        $menit1 = $latestData->menit1;
        $hari = $latestData->hari;

        $jam3 = $latestData->jam3;
        $menit3 = $latestData->menit3;
        $hari3 = $latestData->hari3;
        $putaran = $latestData->putaran;
        $created_at = $latestData->created_at;

        // Mengambil 5 data terbaru berdasarkan created_at, putaran, dan ph
        $recentData = Pakan::orderBy('created_at', 'desc')
                            ->orderBy('jam1', 'desc')
                            ->orderBy('menit1', 'desc')
                            ->orderBy('hari', 'desc')

                            ->orderBy('jam3', 'desc')
                            ->orderBy('menit3', 'desc')
                            ->orderBy('hari3', 'desc')
                            ->orderBy('putaran', 'desc')
                            ->take(5)
                            ->get();

        // Menggabungkan jam1 dan menit1
        // $waktuCombined = $jam1 + $menit1;

        return view('pakan', compact( 'jam1','menit1','hari','jam3','menit3','hari3', 'putaran', 'created_at', 'recentData'));
    }

    public function index2()
    {
        // Mengambil 1 data terakhir
        $latestData = Pakan::latest()->first();
        $jam2 = $latestData->jam2;
        $menit2 = $latestData->menit2;
        $hari2 = $latestData->hari2;
        $created_at = $latestData->created_at;

        // Mengambil 5 data terbaru berdasarkan created_at, putaran, dan ph
        $recentData = Pakan::orderBy('created_at', 'desc')
                            ->orderBy('jam2', 'desc')
                            ->orderBy('menit2', 'desc')
                            ->orderBy('hari2', 'desc')
                            ->take(5)
                            ->get();

        // Menggabungkan jam1 dan menit1
        // $waktuCombined = $jam1 + $menit1;

        return view('pakan', compact( 'jam2','menit2','hari2', 'created_at', 'recentData'));
    }



    public function waktu()
    {
        // Mengambil 1 data terakhir
        $latestData = Pakan::latest()->first();
        $waktu = $latestData->waktu;
        $putaran = $latestData->putaran;
        $created_at = $latestData->created_at;

        // Mengambil 5 data terbaru berdasarkan created_at, putaran, dan ph
        $recentData = Pakan::orderBy('created_at', 'desc')
                            ->orderBy('waktu', 'desc')
                            ->orderBy('putaran', 'desc')
                            ->take(5)
                            ->get();

        return view('waktu', compact('waktu', 'putaran', 'created_at', 'recentData'));
    }


    // public function store(Request $request)
    // {
    //     // Validasi data jika diperlukan
    //     $request->validate([
    //         'putaran' => 'required',
    //         'waktu' => 'required',
    //     ]);

    //     // Simpan data ke MongoDB
    //     $pakan = new Pakan;
    //     $pakan->putaran = $request->putaran;
    //     $pakan->waktu = $request->waktu;
    //     $pakan->save();

    //     // Mengembalikan response berhasil
    //     return redirect()->route('waktu')->with('success', 'Data pakan berhasil disimpan');
    // }

    // public function store(Request $request)
    // {
    //     $waktu = $request->input('waktu'); // Ambil data waktu dari permintaan POST

    //     // Validasi format waktu (misalnya, "08:30:00")
    //     if (!preg_match('/^([0-1][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/', $waktu)) {
    //         return response()->json(['error' => 'Format waktu tidak valid. Gunakan format HH:MM:SS.'], 400);
    //     }

    //     // Simpan data waktu ke MongoDB menggunakan model Pakan
    //     $pakan = new Pakan();
    //     $pakan->waktu = $waktu;
    //     $pakan->save();

    //     return response()->json(['message' => 'Data pakan berhasil disimpan di MongoDB.'], 200);
    // }


    public function store(Request $request)
    {
        // Validasi jumlah waktu yang sudah ada
        $jumlahWaktu = Pakan::count();

        if ($jumlahWaktu >= 3) {
            return response()->json(['error' => 'Jumlah waktu maksimum (3) sudah tercapai. Tidak dapat menambahkan lagi.'], 400);
        }

        $waktu = $request->input('waktu'); // Ambil data waktu dari permintaan POST

        // Validasi format waktu (misalnya, "08:30:00")
        if (!preg_match('/^([0-1][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/', $waktu)) {
            return response()->json(['error' => 'Format waktu tidak valid. Gunakan format HH:MM:SS.'], 400);
        }

        // Simpan data waktu ke MongoDB menggunakan model Pakan
        $pakan = new Pakan();
        $pakan->waktu = $waktu;
        $pakan->save();

        return response()->json(['message' => 'Data pakan berhasil disimpan di MongoDB.'], 200);
    }

    public function destroy($id)
{
    // Cari data waktu berdasarkan ID
    $pakan = Pakan::find($id);

    // Jika data waktu tidak ditemukan, kembalikan respons dengan pesan kesalahan
    if (!$pakan) {
        return response()->json(['error' => 'Data waktu tidak ditemukan.'], 404);
    }

    // Hapus data waktu
    $pakan->delete();

    // Kembalikan respons sukses
    return response()->json(['message' => 'Data waktu berhasil dihapus.'], 200);
}

public function tampilkanFormUpdate($id)
{
    $pakan = Pakan::find($id);

    if (!$pakan) {
        // Lakukan penanganan jika data 'Pakan' tidak ditemukan
        return redirect()->route('formUpdate')->with('error', 'Data Pakan tidak ditemukan.');
    }

    return view('waktu', compact('pakan'));
}


// controller untuk api
public function getWaktu()
{
    // Mengambil data jam1 dan menit1 dari koleksi MongoDB yang sesuai dengan model Pakan
    $dataWaktu = Pakan::select('jam1', 'menit1','jam2', 'menit2','jam3','menit3')->first();

    // Merespons data waktu dalam format JSON
    return response()->json(['jam1' => $dataWaktu->jam1, 'menit1' => $dataWaktu->menit1,'jam2' => $dataWaktu->jam2, 'menit2' => $dataWaktu->menit2, 'jam3' => $dataWaktu->jam3, 'menit3' => $dataWaktu->menit3]);
}



    public function edit($id)
    {
        $pakan = Pakan::find($id);

        if (!$pakan) {
            return redirect()->route('pakan')->with('error', 'Data Pakan tidak ditemukan.');
        }

        return view('waktu', compact('waktu', 'putaran'));
    }

    // Metode untuk meng-handle pembaruan data 'Pakan'
    public function update(Request $request, $id)
    {
        $request->validate([
            'waktu' => 'required|date_format:H:i:s',
        ]);

        $pakan = Pakan::find($id);

        if (!$pakan) {
            return redirect()->route('pakan')->with('error', 'Data Pakan tidak ditemukan.');
        }

        $pakan->waktu = $request->input('waktu');
        $pakan->save();

        return redirect()->route('pakan')->with('success', 'Data Pakan berhasil diupdate.');
    }



    // public function updateWaktu(Request $request, $id)
    // {
    //     // Validasi data yang dikirim dari formulir jika diperlukan
    //     $request->validate([
    //         'waktu' => 'required',
    //     ]);

    //     // Temukan data berdasarkan ID
    //     $data = RecentData::find($id);

    //     if (!$data) {
    //         return redirect()->route('route.name')->with('error', 'Data tidak ditemukan');
    //     }

    //     // Update data waktu
    //     $data->waktu = $request->input('waktu');
    //     $data->save();

    //     return redirect()->route('route.name')->with('success', 'Waktu berhasil diperbarui');
    // }


// atur pakan 1
    // tambah pakan ikan
    public function tambahData(Request $request)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'jam1' => 'required',
            'menit1'=> 'required',
            'hari'=>'required',
        ]);

        // Simpan data ke MongoDB
        Pakan::create([
            'jam1' => $request->input('jam1'),
            'menit1' => $request->input('menit1'),
            'hari' => $request->input('hari'),
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    // hapus data
    public function hapusData($id)
    {
        // Temukan data berdasarkan ID dan hapus
        Pakan::find($id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }




    // update pakan ikan
    public function updateWaktu(Request $request, $id)
    {
        // Validasi data yang dikirim dari formulir jika diperlukan
        $request->validate([
            'jam1' => 'required',
            'menit1'=> 'required',
            'hari'=>'required'
        ]);

        // Temukan data berdasarkan ID
        $data = Pakan::find($id);

        if (!$data) {
            return redirect()->route('pakan')->with('error', 'Data tidak ditemukan');
        }

        // Update data waktu
        $data->jam1 = $request->input('jam1');
        $data->menit1 = $request->input('menit1');
        $data->hari = $request->input('hari');
        $data->save();

        return redirect()->route('pakan')->with('success', 'Waktu berhasil diperbarui');
    }

    // atur pakan 2
    // tambah pakan ikan
    public function tambahData2(Request $request)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'jam2' => 'required',
            'menit2'=> 'required',
            'hari2'=>'required'
        ]);

        // Simpan data ke MongoDB
        Pakan::create([
            'jam2' => $request->input('jam2'),
            'menit2' => $request->input('menit2'),
            'hari2' => $request->input('hari2'),
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    // hapus data
    public function hapusData2($id)
    {
        // Temukan data berdasarkan ID dan hapus
        Pakan::find($id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }




    // update pakan ikan
    public function updateWaktu2(Request $request, $id)
    {
        // Validasi data yang dikirim dari formulir jika diperlukan
        $request->validate([
            'jam2' => 'required',
            'menit2'=> 'required',
            'hari2'=>'required'
        ]);

        // Temukan data berdasarkan ID
        $data = Pakan::find($id);

        if (!$data) {
            return redirect()->route('pakan')->with('error', 'Data tidak ditemukan');
        }

        // Update data waktu
        $data->jam2 = $request->input('jam2');
        $data->menit2 = $request->input('menit2');
        $data->hari2 = $request->input('hari2');
        $data->save();

        return redirect()->route('pakan')->with('success', 'Waktu berhasil diperbarui');
    }

    public function updateWaktu3(Request $request, $id)
    {
        // Validasi data yang dikirim dari formulir jika diperlukan
        $request->validate([
            'jam3' => 'required',
            'menit3'=> 'required',
            'hari3'=>'required'
        ]);

        // Temukan data berdasarkan ID
        $data = Pakan::find($id);

        if (!$data) {
            return redirect()->route('pakan')->with('error', 'Data tidak ditemukan');
        }

        // Update data waktu
        $data->jam3 = $request->input('jam3');
        $data->menit3 = $request->input('menit3');
        $data->hari3 = $request->input('hari3');
        $data->save();

        return redirect()->route('pakan')->with('success', 'Waktu berhasil diperbarui');
    }


}
