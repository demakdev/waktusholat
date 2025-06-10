<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class KeuanganController extends Controller
{
    public function Index(){

        $keuangans = [];
        return Inertia::render('keuangan/Index', [
            'keuangans' => $keuangans
        ]);
    }

}
