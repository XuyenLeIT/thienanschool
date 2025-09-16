<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Carausel;
use App\Models\DailySchedule;
use App\Models\EducationContent;
use App\Models\Program;
use App\Models\Promotion;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index()
    {
        $programs = Program::where('type', Program::TYPE_PROGRAM)->get();
        $educationContent = EducationContent::with('items')->first();
        $schedules = DailySchedule::orderBy('order')->get();
        $news = Activity::where('type', Activity::TYPE_NEWS)
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        $carausel = Carausel::where('page', Carausel::TYPE_CURRICULUM)
            ->where('status', Carausel::STATUS_SHOW)
            ->first();
        $promotion = Promotion::where('type', Promotion::TYPE_PROGRAM)
            ->where('status', Promotion::STATUS_SHOW)
            ->first();
        return view('client.curriculum', compact('programs', 'educationContent', 'schedules', 'news', 'carausel', 'promotion'));
    }
}
