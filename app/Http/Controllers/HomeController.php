<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Activity;
use App\Models\Carausel;
use App\Models\Gallery;
use App\Models\Program;
use App\Models\Promotion;
use App\Models\SpecialFeature;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    // Giới hạn số lượng carousel nếu dùng
    $carausels = Carausel::where('page', Carausel::TYPE_HOME)
      ->where('status', Carausel::STATUS_SHOW)
      ->get();

    // Lấy tối đa 4 SpecialFeature cùng images và subdes để tránh load quá nhiều
    $features = SpecialFeature::with([
      'images' => function ($q) {
        $q->take(4); // tối đa 4 ảnh mỗi feature
      },
      'subdes' => function ($q) {
        $q->take(4); // tối đa 4 subdes mỗi feature
      }
    ])->take(4)->get(); // tối đa 4 feature

    // Play activities, chỉ lấy 10 bản ghi gần nhất
    $playActivities = Activity::where('type', 2)
      ->where('status', 1)
      ->latest()
      ->take(10)
      ->get();

    // Galleries, lấy tối đa 5 gallery với tối đa 3 ảnh mỗi gallery
    $galleries = Gallery::with([
      'images' => function ($q) {
        $q->take(3);
      }
    ])->take(5)->get();

    // Chương trình học, chỉ lấy 3 bản ghi để hiển thị trên homepage
    $programs = Program::where('type', Program::TYPE_PROGRAM)
      ->take(3)
      ->get();

    // News, paginate 3 bản ghi trên mỗi trang
    $newsActivities = Activity::where('type', 3)
      ->orderBy('created_at', 'desc')
      ->paginate(3);
    $promotion = Promotion::where('type', Promotion::TYPE_PARENT)
      ->where('status', Carausel::STATUS_SHOW)
      ->first();
    return view('client.home', compact('carausels', 'playActivities', 'features', 'galleries', 'programs', 'newsActivities','promotion'));
  }

}
