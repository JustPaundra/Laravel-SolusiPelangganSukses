<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AnalisaKepuasan;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahAnalisa = AnalisaKepuasan::count(); // Ambil jumlah data AnalisaKepuasan
        return view('admin.dashboard', compact('jumlahAnalisa')); // Kirimkan variabel ke view
    }
}