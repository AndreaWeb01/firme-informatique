<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function liste_devis()
    {
        $devis = Devis::all();

        return view('administration.devis.liste', compact('devis'));
    }

    public function show_devis(Devis $devis)
    {
        return view('administration.devis.show', compact('devis'));
    }
}
