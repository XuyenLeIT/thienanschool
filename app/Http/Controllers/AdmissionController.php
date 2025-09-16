<?php

namespace App\Http\Controllers;

use App\Models\Carausel;
use App\Models\Promotion;
use App\Models\Tuition;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function index()
    {
        $carausel = Carausel::where('page', Carausel::TYPE_ADMISSION)
            ->where('status', Carausel::STATUS_SHOW)
            ->first();
        $tuitions = Tuition::all();
        $promotion = Promotion::where('type', Promotion::TYPE_ADMISSION)
            ->where('status', Carausel::STATUS_SHOW)
            ->first();
        return view('client.admision', compact('carausel', 'tuitions','promotion'));
    }
}
