<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function index(Request $request)
    {
        $query = Card::query();

        // 分类筛选
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 排序
        $query->orderBy('sort_order', 'asc')
              ->orderBy('id', 'desc');

        // 分页
        $perPage = $request->input('per_page', 10);
        $cards = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $cards
        ]);
    }

    public function show($id)
    {
        $card = Card::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $card
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '验证失败',
                'errors' => $validator->errors()
            ], 422);
        }

        $card = Card::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $card
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $card = Card::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'url' => 'sometimes|required|url|max:255',
            'icon' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '验证失败',
                'errors' => $validator->errors()
            ], 422);
        }

        $card->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $card
        ]);
    }

    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();

        return response()->json([
            'success' => true,
            'message' => '删除成功'
        ]);
    }

    public function updateOrder(Request $request, $id)
    {
        $card = Card::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'sort_order' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '验证失败',
                'errors' => $validator->errors()
            ], 422);
        }

        $card->update([
            'sort_order' => $request->sort_order
        ]);

        return response()->json([
            'success' => true,
            'data' => $card
        ]);
    }
}
