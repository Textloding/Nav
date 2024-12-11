<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Site;
use App\Models\Tag;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        $stats = [
            'total_categories' => Category::count(),
            'total_sites' => Site::count(),
            'total_tags' => Tag::count(),
            'categories' => Category::withCount('sites')->get()->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'sites_count' => $category->sites_count
                ];
            }),
            'recent_sites' => Site::with(['category', 'tags'])
                ->orderBy('sort_order', 'asc')
                ->get()
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}
