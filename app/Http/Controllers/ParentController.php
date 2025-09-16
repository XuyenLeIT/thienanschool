<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Carausel;
use App\Models\LoveMessage;
use App\Models\Menu;
use App\Models\ParentNotice;
use App\Models\Promotion;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index()
    {
        $carausel = Carausel::where('page', Carausel::TYPE_PARENT)
            ->where('status', Carausel::STATUS_SHOW)
            ->first();
        $advices = Activity::where('type', Activity::TYPE_ADVICE)
            ->where('status', Carausel::STATUS_SHOW)
            ->get();
        $menus = Menu::orderBy('order')->get();
        $notices = ParentNotice::all();
        $promotion = Promotion::where('type', Promotion::TYPE_PARENT)
            ->where('status', Carausel::STATUS_SHOW)
            ->first();
        $lovemessages = LoveMessage::all();
        return view('client.parent', compact(
            'carausel',
            'advices',
            'menus',
            'notices',
            'promotion',
            'lovemessages'
        ));
    }
}
