<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TakmirController extends Controller
{
    //

    public function Index(){

        $takmirs = []; 
        return Inertia::render('takmir/Index', [
                'takmirs' => $takmirs,
            ]
        );
    }
}
