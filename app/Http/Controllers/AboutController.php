<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Mitra;
use App\Models\Setting;

class AboutController extends Controller
{
    public function index()
    {
        $mitras = Mitra::where('is_aktif', true)->get();
        $settings = Setting::all()->keyBy('key');
        $destinasis = Destinasi::whereNotNull('latitude')->whereNotNull('longitude')->get();

        return view('about', compact('mitras', 'settings', 'destinasis'));
    }
}
