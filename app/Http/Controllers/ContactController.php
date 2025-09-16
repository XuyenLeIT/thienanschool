<?php

namespace App\Http\Controllers;

use App\Models\Carausel;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $carausel = Carausel::where('page', Carausel::TYPE_CONTACT)
            ->where('status', Carausel::STATUS_SHOW)
            ->first();
        return view('client.contact', compact('carausel'));
    }
}
