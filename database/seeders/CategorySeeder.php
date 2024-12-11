<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => '常用工具',
                'icon' => 'tools',
                'sort' => 1,
                'is_show' => true,
            ],
            [
                'name' => '开发文档',
                'icon' => 'document',
                'sort' => 2,
                'is_show' => true,
            ],
            [
                'name' => 'AI工具',
                'icon' => 'robot',
                'sort' => 3,
                'is_show' => true,
            ],
            [
                'name' => '设计资源',
                'icon' => 'palette',
                'sort' => 4,
                'is_show' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
