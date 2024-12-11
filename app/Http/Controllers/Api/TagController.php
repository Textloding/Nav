<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    public function index()
    {
        try {
            $tags = Tag::withCount('sites')
                ->orderBy('id', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $tags,
                'message' => 'Tags retrieved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching tags: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching tags',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);

            $tag = Tag::create($request->all());
            return response()->json([
                'success' => true,
                'data' => $tag,
                'message' => 'Tag created successfully'
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating tag: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error creating tag',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $tag = Tag::with('sites')->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $tag,
                'message' => 'Tag retrieved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching tag: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching tag',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);

            $tag = Tag::findOrFail($id);
            $tag->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $tag,
                'message' => 'Tag updated successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating tag: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating tag',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->sites()->detach();
            $tag->delete();
            return response()->json([
                'success' => true,
                'message' => 'Tag deleted successfully'
            ], 204);
        } catch (\Exception $e) {
            Log::error('Error deleting tag: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting tag',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
