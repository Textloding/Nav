<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            ['name' => '前端开发'],
            ['name' => '后端开发'],
            ['name' => '设计工具'],
            ['name' => '开发工具'],
            ['name' => 'AI助手'],
            ['name' => '学习资源'],
            ['name' => '效率工具'],
            ['name' => '开源项目'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
