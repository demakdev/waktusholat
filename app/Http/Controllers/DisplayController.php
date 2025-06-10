<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;

class DisplayController extends Controller
{
    public function show(): Response{

        $mosqueName = 'Masjid Al-Falah';
        $prayerTimes = [];
        
        return Inertia::render('display/Board', [
            'mosqueName' => $mosqueName,
            'prayerTimes' =>  $prayerTimes
        ]);
    }
}
