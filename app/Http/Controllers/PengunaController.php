<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penguna;
use App\Models\Alat;
use App\Models\Sensor;
use Carbon\Carbon;
use App\Models\Mongo;
use Illuminate\Support\Facades\Hash;

class PengunaController extends Controller
{
    public function index()
    {
        return view('login/index'); // Ganti 'login' dengan nama file blade login Anda
    }
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $latestData = Penguna::latest()->first();
        $alat = $latestData->alat;

        $user = Penguna::where('username', $username)->first();

        if ($user && $password == $user->password) {
            // Autentikasi berhasil
            if ($user->role == 'admin') {
                // Redirect ke halaman admin
                session(['username' => $username]);
                return redirect()->action([PengunaController::class, 'page']);
            } else {
                // Redirect ke halaman user
                session(['alat' => $alat]);
                return redirect()->action([PhController::class, 'index']);
            }
        } else {
            // Autentikasi gagal, redirect kembali dengan pesan error
            return redirect()->route('error')->with('error', 'Login failed. Please check your credentials.');
        }
    }

    public function eror()
    {

        return view('eror'); // Sesuaikan dengan nama view yang sesuai
    }

    public function akun()
    {
        $data = Penguna::all();
        return view('admin.buatakun', compact('data')); // Sesuaikan dengan nama view yang sesuai
    }

    public function alat()
    {
        $data = Alat::all();
        return view('admin.alat', compact('data'));
    }

    public function show($alat)
    {
        session(['alat' => $alat]);
        return redirect()->action([PhController::class, 'index']);
    }

    public function page()
    {
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

    return view('admin.dashbord', compact('pH', 'temperature', 'created_at', 'recentData','jam2','menit2','hari2','jam1','menit1','hari','jam3','menit3','hari3'));
    }

    public function logout(Request $request)
    {
        // Redirect ke halaman Penguna atau halaman lain yang Anda tentukan
        return view('login/index')->with('success', 'Logout successful.');
    }
}
