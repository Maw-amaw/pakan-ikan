<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penguna;
use App\Models\Alat;
use Carbon\Carbon;
use App\Models\Mongo;
use Illuminate\Support\Facades\Hash;

class AlatController extends Controller
{
    public function addalat (Request $request)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'alat'=>'required',
        ]);

        // Simpan data ke MongoDB
        Alat::create([
            'alat' => $request->input('alat'),
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function adduser (Request $request)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'username' => 'required',
            'password'=> 'required',
            'role'=>'required',
            'alat'=>'required',
        ]);

        // Simpan data ke MongoDB
        Penguna::create([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
            'alat' => $request->input('alat'),
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'alat' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $alat = Alat::find($id);
        $alat->update([
            'alat' => $request->input('alat'),
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    public function edit($id)
    {
        $alat = Alat::find($id);
        return view('admin.editdata', compact('alat'));
    }

    public function updateakun(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'alat' => 'required|string|max:255',
        ]);

        $alat = Penguna::find($id);
        $alat->update([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
            'alat' => $request->input('alat'),
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    public function editakun($id)
    {
        $alat = Penguna::find($id);
        return view('admin.editakun', compact('alat'));
    }


    public function delete($id)
    {
        $data = Alat::find($id);

        if ($data) {
            $data->delete();
            return redirect()->route('alat')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->route('alat')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function deleteakun($id)
    {
        $data = Penguna::find($id);

        if ($data) {
            $data->delete();
            return redirect()->route('akun')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->route('akun')->with('error', 'Data tidak ditemukan.');
        }
    }


    public function wifi($alat){
        // Ambil data SSID dan password dari MongoDB atau database lainnya
        $wifiCredential = Alat::where('alat', $alat)->first();

        // Kirim respons dalam format JSON
        if ($wifiCredential) {
            return response()->json([
                'ssid' => $wifiCredential->ssid,
                'password' => $wifiCredential->password,
            ]);
        } else {
            return response()->json(['error' => 'Data not found.'], 404);
        }
    }
}
