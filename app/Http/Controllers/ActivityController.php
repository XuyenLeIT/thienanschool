<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Carausel;
use App\Models\Promotion;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->paginate(10);
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.form');
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        $savedFiles = []; // lưu lại tất cả file đã lưu thành công để rollback nếu cần

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'shortdes' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string',
                'type' => 'required|in:1,2,3,4',
                'status' => 'required|in:0,1',
            ]);

            // 1. Xử lý description trước
            $processedDescription = $this->processDescriptionImagesWithTracking(
                $request->description,
                $savedFiles
            );

            // 2. Tạo activity
            $activity = new Activity();
            $activity->title = $validated['title'];
            $activity->shortdes = $validated['shortdes'];
            $activity->description = $processedDescription;
            $activity->type = $validated['type'];
            $activity->status = $validated['status'];

            // 3. Ảnh đại diện nếu có
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $folder = public_path('activities');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $image->move($folder, $filename);

                $filePath = '/activities/' . $filename;
                $activity->image = $filePath;
                $savedFiles[] = public_path($filePath); // track để rollback nếu lỗi
            }

            // 4. Lưu DB
            $activity->save();

            DB::commit();
            return redirect()->route('admin.activities.index')->with('success', 'Thêm hoạt động thành công!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            $this->cleanupFiles($savedFiles);
            throw $e; // để Laravel tự redirect back withErrors
        } catch (\Exception $e) {
            DB::rollBack();
            $this->cleanupFiles($savedFiles);
            Log::error("Activity Store Error: " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    /**
     * Xử lý ảnh trong description, đồng thời lưu danh sách file đã tạo
     */
    private function processDescriptionImagesWithTracking($html, array &$savedFiles)
    {
        try {
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
            libxml_clear_errors();

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $k => $img) {
                $src = $img->getAttribute('src');

                if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                    $data = substr($src, strpos($src, ',') + 1);
                    $data = base64_decode($data);

                    if ($data === false) {
                        throw new \Exception("Base64 decode thất bại cho ảnh index {$k}");
                    }

                    $ext = strtolower($type[1]);
                    $folder = public_path('activities');
                    if (!file_exists($folder)) {
                        if (!mkdir($folder, 0777, true) && !is_dir($folder)) {
                            throw new \Exception("Không thể tạo thư mục: {$folder}");
                        }
                    }

                    $fileName = time() . $k . '.' . $ext;
                    $filePath = $folder . '/' . $fileName;

                    if (file_put_contents($filePath, $data) === false) {
                        throw new \Exception("Không thể lưu file: {$filePath}");
                    }

                    $savedFiles[] = $filePath; // track lại file
                    $img->setAttribute('src', '/activities/' . $fileName);
                }
            }

            return $dom->saveHTML();
        } catch (\Exception $e) {
            throw $e; // quăng ra để rollback
        }
    }

    /**
     * Xóa toàn bộ file đã lưu khi rollback
     */
    private function cleanupFiles(array $files)
    {
        foreach ($files as $file) {
            if (file_exists($file)) {
                @unlink($file);
            }
        }
    }



    public function edit(Activity $activity)
    {
        return view('admin.activities.form', compact('activity'));
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $savedFiles = [];   // track file mới để rollback nếu lỗi
        $deleteAfterCommit = []; // track file cũ để xóa sau commit

        try {
            $activity = Activity::findOrFail($id);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'shortdes' => 'nullable|string',
                'description' => 'nullable|string',
                'type' => 'required|in:1,2,3,4',
                'status' => 'required|in:0,1',
            ]);

            // 1. Lấy danh sách ảnh cũ trong description
            $oldImages = $this->extractImagesFromHtml($activity->description);

            // 2. Xử lý description mới (ảnh base64)
            $newDescription = $this->processDescriptionImagesWithTracking(
                $request->description,
                $savedFiles
            );

            // 3. Lấy danh sách ảnh mới trong description
            $newImages = $this->extractImagesFromHtml($newDescription);

            // 4. Tìm ảnh đã bị xóa khỏi description
            $deletedImages = array_diff($oldImages, $newImages);

            // Track ảnh này để xóa sau khi commit
            foreach ($deletedImages as $imgPath) {
                $deleteAfterCommit[] = public_path($imgPath);
            }

            // 5. Cập nhật dữ liệu
            $activity->title = $validated['title'];
            $activity->shortdes = $validated['shortdes'];
            $activity->description = $newDescription;
            $activity->type = $validated['type'];
            $activity->status = $validated['status'];

            // 6. Xử lý ảnh đại diện mới
            if ($request->hasFile('image')) {
                // Track ảnh cũ để xóa sau commit
                if ($activity->image && file_exists(public_path($activity->image))) {
                    $deleteAfterCommit[] = public_path($activity->image);
                }

                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $folder = public_path('activities');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $image->move($folder, $filename);

                $filePath = '/activities/' . $filename;
                $activity->image = $filePath;
                $savedFiles[] = public_path($filePath); // track để rollback nếu lỗi
            }

            // 7. Lưu DB
            $activity->save();

            DB::commit();

            // Sau commit, xóa file cũ (đã không còn dùng)
            $this->cleanupFiles($deleteAfterCommit);

            return redirect()->route('admin.activities.index')->with('success', 'Cập nhật thành công!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            $this->cleanupFiles($savedFiles); // rollback file mới
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->cleanupFiles($savedFiles); // rollback file mới
            Log::error("Update activity error: " . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    private function extractImagesFromHtml($html)
    {
        $images = [];
        try {
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
            libxml_clear_errors();

            foreach ($dom->getElementsByTagName('img') as $img) {
                $src = $img->getAttribute('src');
                // Chỉ lấy ảnh trong thư mục activities
                if (strpos($src, '/activities/') === 0) {
                    $images[] = $src;
                }
            }
        } catch (\Exception $e) {
            Log::error("extractImagesFromHtml error: " . $e->getMessage());
        }
        return $images;
    }

    public function destroy(Activity $activity)
    {
        try {
            // 1. Xóa ảnh đại diện nếu có
            if ($activity->image) {
                $imagePath = public_path($activity->image);
                if (file_exists($imagePath)) {
                    if (!@unlink($imagePath)) {
                        Log::warning("Không thể xóa ảnh đại diện: " . $imagePath);
                    }
                }
            }

            // 2. Xóa ảnh trong description
            try {
                $dom = new \DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML(mb_convert_encoding($activity->description, 'HTML-ENTITIES', 'UTF-8'));
                libxml_clear_errors();

                $images = $dom->getElementsByTagName('img');
                foreach ($images as $img) {
                    $src = $img->getAttribute('src');
                    if ($src) {
                        $file = public_path($src);
                        if (file_exists($file)) {
                            if (!@unlink($file)) {
                                Log::warning("Không thể xóa ảnh trong description: " . $file);
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error("Lỗi khi xử lý ảnh description: " . $e->getMessage());
            }

            // 3. Xóa record trong DB
            $activity->delete();

            return redirect()
                ->route('admin.activities.index')
                ->with('success', 'Xóa thành công!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Lỗi liên quan DB
            Log::error("DB Error khi xóa activity: " . $e->getMessage());
            return redirect()
                ->back()
                ->withErrors(['general' => 'Không thể xóa do lỗi cơ sở dữ liệu.']);
        } catch (\Exception $e) {
            // Lỗi khác
            Log::error("Destroy activity error: " . $e->getMessage());
            return redirect()
                ->back()
                ->withErrors(['general' => 'Có lỗi xảy ra khi xóa: ' . $e->getMessage()]);
        }
    }
    public function detail($slug)
    {
        try {
            $carausel = Carausel::where('page', Carausel::TYPE_DETAIL)
                ->where('status', Carausel::STATUS_SHOW)
                ->first();
            $activity = Activity::where('status', 1)
                ->where('slug', $slug)
                ->firstOrFail();

            // Thêm paginate (ví dụ: 5 bản ghi mỗi trang)
            $otherActivities = Activity::where('status', 1)
                ->where('id', '!=', $activity->id)
                ->latest()
                ->paginate(6); // hoặc ->simplePaginate(5)

            $promotion = Promotion::where('type', Promotion::TYPE_PROGRAM)
                ->first();
            return view('client.detail', compact('activity', 'otherActivities', 'promotion','carausel'));
        } catch (\Exception $e) {
            Log::error("Activity Detail Error: " . $e->getMessage());
            return redirect()->route('home')->withErrors(['general' => 'Không tìm thấy hoạt động này!']);
        }
    }
}
