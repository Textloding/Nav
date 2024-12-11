<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * 获取仪表盘统计数据
     */
    public function statistics()
    {
        // 基础统计
        $statistics = [
            'site_count' => Site::count(),
            'category_count' => Category::count(),
            'tag_count' => Tag::count(),
            'today_visits' => 0, // 后续添加访问统计
        ];

        // 最近添加的网站
        $recent_sites = Site::with(['category', 'tags'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // 分类统计
        $category_stats = Category::select('categories.name', DB::raw('count(sites.id) as site_count'))
            ->leftJoin('sites', 'categories.id', '=', 'sites.category_id')
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('site_count', 'desc')
            ->limit(10)
            ->get();

        // 标签统计
        $tag_stats = Tag::select('tags.name', DB::raw('count(site_tag.site_id) as site_count'))
            ->leftJoin('site_tag', 'tags.id', '=', 'site_tag.tag_id')
            ->groupBy('tags.id', 'tags.name')
            ->orderBy('site_count', 'desc')
            ->limit(10)
            ->get();

        // 每日新增网站统计（最近7天）
        $daily_sites = Site::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date')
            ->map(function ($item) {
                return $item->count;
            });

        // 填充没有数据的日期
        $dates = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates->put($date, $daily_sites->get($date, 0));
        }

        return response()->json([
            'statistics' => $statistics,
            'recent_sites' => $recent_sites,
            'category_stats' => $category_stats,
            'tag_stats' => $tag_stats,
            'daily_sites' => $dates,
        ]);
    }
}
