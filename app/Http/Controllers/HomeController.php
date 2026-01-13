<?php

namespace App\Http\Controllers;

use App\Models\JenisPengunjung;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $jenisPengunjungs = JenisPengunjung::where('is_active', true)
            ->orderBy('nama')
            ->get();

        return view('welcome', compact('jenisPengunjungs'));
    }
}
