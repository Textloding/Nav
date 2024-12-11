<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    /**
     * 获取网站列表
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $sites = Site::with(['category', 'tags'])
            ->where('is_show', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return response()->json([
            'data' => $sites
        ]);
    }

    /**
     * 获取单个网站
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $site = Site::with(['category', 'tags'])->findOrFail($id);

        return response()->json([
            'data' => $site
        ]);
    }

    /**
     * 创建网站
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'category_id' => 'required|exists:categories,id',
            'logo' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_show' => 'boolean',
            'sort_order' => 'nullable|integer'
        ]);

        DB::beginTransaction();

        try {
            $category_id = $request->input('category_id');

            // 如果未提供 sort_order，则将其设置为当前分类中最大的 sort_order + 1
            if ($request->input('sort_order') === null) {
                $max_sort_order = Site::where('category_id', $category_id)->max('sort_order');
                $sort_order = $max_sort_order ? $max_sort_order + 1 : 1;
            } else {
                $sort_order = $request->input('sort_order');

                // 在插入新站点时，需要调整现有站点的 sort_order
                Site::where('category_id', $category_id)
                    ->where('sort_order', '>=', $sort_order)
                    ->increment('sort_order');
            }

            $site = Site::create([
                'name' => $request->input('name'),
                'url' => $request->input('url'),
                'category_id' => $category_id,
                'logo' => $request->input('logo', ''),
                'description' => $request->input('description', ''),
                'is_show' => $request->input('is_show', true),
                'sort_order' => $sort_order
            ]);

            DB::commit();

            return response()->json([
                'message' => '创建成功',
                'data' => $site
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => '创建失败',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * 更新网站
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $site = Site::findOrFail($id);

        $this->validate($request, [
            'name' => 'string|max:255',
            'url' => 'url|max:255',
            'category_id' => 'exists:categories,id',
            'logo' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_show' => 'boolean',
            'sort_order' => 'nullable|integer'
        ]);

        DB::beginTransaction();

        try {
            $data = $request->only(['name', 'url', 'category_id', 'logo', 'description', 'is_show', 'sort_order']);

            $old_category_id = $site->category_id;
            $old_sort_order = $site->sort_order;

            $new_category_id = $data['category_id'] ?? $old_category_id;
            $new_sort_order = $data['sort_order'] ?? null;

            // 更新非排序相关字段
            if (isset($data['name'])) {
                $site->name = $data['name'];
            }
            if (isset($data['url'])) {
                $site->url = $data['url'];
            }
            if (isset($data['category_id'])) {
                $site->category_id = $data['category_id'];
            }
            if (isset($data['logo'])) {
                $site->logo = $data['logo'];
            }
            if (isset($data['description'])) {
                $site->description = $data['description'];
            }
            if (isset($data['is_show'])) {
                $site->is_show = $data['is_show'];
            }

            // 排序逻辑处理
            if ($new_category_id == $old_category_id) {
                // 同一分类内移动排序
                if ($new_sort_order !== null && $new_sort_order != $old_sort_order) {
                    // 确保 new_sort_order 合法（比如不小于1）
                    if ($new_sort_order < 1) {
                        $new_sort_order = 1;
                    }

                    // 查找该分类中最大排序值，以免 new_sort_order 越界
                    $max_sort_order = Site::where('category_id', $old_category_id)->max('sort_order');
                    if ($new_sort_order > $max_sort_order) {
                        $new_sort_order = $max_sort_order + 1;
                    }

                    if ($new_sort_order > $old_sort_order) {
                        // 向下移动：区间内的 sort_order 减 1
                        Site::where('category_id', $old_category_id)
                            ->where('sort_order', '>', $old_sort_order)
                            ->where('sort_order', '<=', $new_sort_order)
                            ->decrement('sort_order');
                    } else {
                        // 向上移动：区间内的 sort_order 加 1
                        Site::where('category_id', $old_category_id)
                            ->where('sort_order', '>=', $new_sort_order)
                            ->where('sort_order', '<', $old_sort_order)
                            ->increment('sort_order');
                    }

                    // 更新当前站点的 sort_order
                    $site->sort_order = $new_sort_order;
                }
            } else {
                // 跨分类移动
                // Step 1: 先从旧分类中移除该站点的空缺（对于旧分类中 sort_order > old_sort_order 的站点全部向前移一位）
                Site::where('category_id', $old_category_id)
                    ->where('sort_order', '>', $old_sort_order)
                    ->decrement('sort_order');

                // Step 2: 在新分类中插入该站点
                // 获取新分类的最大排序值
                $max_new_sort_order = Site::where('category_id', $new_category_id)->max('sort_order');
                $max_new_sort_order = $max_new_sort_order ?: 0; // 如果新分类没有站点，则为0

                if ($new_sort_order === null) {
                    // 如果没有提供新的 sort_order，则将站点放在新分类末尾
                    $new_sort_order = $max_new_sort_order + 1;
                } else {
                    // 修正 new_sort_order 不小于1
                    if ($new_sort_order < 1) {
                        $new_sort_order = 1;
                    }
                    // 如果 new_sort_order 超过了当前分类站点数+1，则插入末尾
                    if ($new_sort_order > $max_new_sort_order + 1) {
                        $new_sort_order = $max_new_sort_order + 1;
                    }

                    // 对新分类中 sort_order >= new_sort_order 的站点全部向后移动一位
                    Site::where('category_id', $new_category_id)
                        ->where('sort_order', '>=', $new_sort_order)
                        ->increment('sort_order');
                }

                // 最终更新当前站点的排序到 new_sort_order（已在上面对新分类的站点做了相应调整）
                $site->sort_order = $new_sort_order;
            }

            $site->save();

            DB::commit();

            return response()->json([
                'message' => '更新成功',
                'data' => $site
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => '更新失败',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * 删除网站
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $site = Site::findOrFail($id);
            $category_id = $site->category_id;
            $deleted_sort_order = $site->sort_order;

            $site->delete();

            // 将同一分类中 sort_order 大于被删除站点的所有站点的 sort_order 减 1
            Site::where('category_id', $category_id)
                ->where('sort_order', '>', $deleted_sort_order)
                ->decrement('sort_order');

            DB::commit();

            return response()->json([
                'message' => '删除成功'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => '删除失败',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * 更新网站排序
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSort(Request $request)
    {
        try {
            DB::beginTransaction();

            // 验证请求数据
            $this->validate($request, [
                'start_id' => 'required|integer',
                'end_id' => 'required|integer',
                'category_id' => 'nullable|exists:categories,id'
            ]);

            // 获取要交换的两个站点
            $start_data = Site::findOrFail($request->input('start_id'));
            $end_data = Site::findOrFail($request->input('end_id'));

            // 确定分类 ID，如果请求中未提供，则使用 start_data 的分类
            $category_id = $request->input('category_id', $start_data->category_id);

            if ($start_data->sort_order > $end_data->sort_order) {
                // 向上移动：将 start_data 的 sort_order 设置为 end_data 的 sort_order
                // 并将中间站点的 sort_order 加 1
                Site::where('category_id', $category_id)
                    ->where('sort_order', '>=', $end_data->sort_order)
                    ->where('sort_order', '<', $start_data->sort_order)
                    ->increment('sort_order');

                // 更新 start_data 的 sort_order
                $start_data->sort_order = $end_data->sort_order;
                $start_data->save();
            } elseif ($start_data->sort_order < $end_data->sort_order) {
                // 向下移动：将 start_data 的 sort_order 设置为 end_data 的 sort_order
                // 并将中间站点的 sort_order 减 1
                Site::where('category_id', $category_id)
                    ->where('sort_order', '>', $start_data->sort_order)
                    ->where('sort_order', '<=', $end_data->sort_order)
                    ->decrement('sort_order');

                // 更新 start_data 的 sort_order
                $start_data->sort_order = $end_data->sort_order;
                $start_data->save();
            } else {
                // 如果排序前后位置相同，返回错误
                return response()->json([
                    'success' => false,
                    'message' => '排序更新失败',
                    'error' => '排序前后位置相同'
                ], 400);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => '排序更新成功',
                'data' => [
                    'start_site' => $start_data,
                    'end_site' => $end_data
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => '排序更新失败',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * 更新网站显示状态
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus($id,Request $request)
    {
        try {
            $site = Site::findOrFail($id);

            $this->validate($request, [
                'is_show' => 'required|boolean'
            ]);

            $site->is_show = $request->input('is_show');
            $site->save();

            return response()->json([
                'success' => true,
                'message' => '状态更新成功',
                'data' => $site
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '状态更新失败',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function maxSort($id)
    {
        // 查询 category_id 为 $id 的记录，并按 sort_order 降序排序，取第一条
        $data = Site::where('category_id', $id)
            ->orderBy('sort_order', 'desc')
            ->first();
        if (!$data){
            $data = ['sort_order'=>0];
        }

        return response()->json([
        'success' => true,
        'message' => '获取成功',
        'data' => $data
    ]);
    }
}
