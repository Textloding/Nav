<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    private ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * 上传图片
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|in:logo,icon',
            'width' => 'integer|min:1|max:1000',
            'height' => 'integer|min:1|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $file = $request->file('file');
            $type = $request->input('type');
            $width = $request->input('width', 100);
            $height = $request->input('height', 100);

            $fileName = $type . '_' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();

            // 创建 ImageManager 并使用 GD 驱动
            $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());

            // 读取并处理图像
            $image = $manager->read($file->getPathname());
            $image->resize(width: $width, height: $height);

            // 保存处理后的图像
            $path = "public/images/{$type}s/" . $fileName;
            Storage::put($path, (string)$image->toJpg()); // 使用 toJpg() 编码为 JPEG

            $url = Storage::url($path);

            return response()->json([
                'success' => true,
                'data' => [
                    'url' => $url,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '上传失败：' . $e->getMessage(),
            ], 500);
        }
    }
}
