<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;
use App\Models\Tag;

class SiteSeeder extends Seeder
{
    public function run()
    {
        $sites = [
            [
                'category_id' => 1,
                'name' => 'GitHub',
                'url' => 'https://github.com',
                'logo' => 'https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png',
                'description' => '全球最大的代码托管平台',
                'sort' => 1,
                'is_show' => true,
                'tags' => [4, 8],
            ],
            [
                'category_id' => 1,
                'name' => 'VSCode',
                'url' => 'https://code.visualstudio.com',
                'logo' => 'https://code.visualstudio.com/assets/images/code-stable.png',
                'description' => '微软出品的代码编辑器',
                'sort' => 2,
                'is_show' => true,
                'tags' => [4],
            ],
            [
                'category_id' => 2,
                'name' => 'Vue.js',
                'url' => 'https://vuejs.org',
                'logo' => 'https://vuejs.org/images/logo.png',
                'description' => '渐进式 JavaScript 框架',
                'sort' => 1,
                'is_show' => true,
                'tags' => [1, 8],
            ],
            [
                'category_id' => 2,
                'name' => 'Laravel',
                'url' => 'https://laravel.com',
                'logo' => 'https://laravel.com/img/logomark.min.svg',
                'description' => 'PHP Web 应用框架',
                'sort' => 2,
                'is_show' => true,
                'tags' => [2, 8],
            ],
            [
                'category_id' => 3,
                'name' => 'ChatGPT',
                'url' => 'https://chat.openai.com',
                'logo' => 'https://chat.openai.com/apple-touch-icon.png',
                'description' => 'OpenAI 开发的 AI 助手',
                'sort' => 1,
                'is_show' => true,
                'tags' => [5, 7],
            ],
            [
                'category_id' => 3,
                'name' => 'Midjourney',
                'url' => 'https://www.midjourney.com',
                'logo' => 'https://www.midjourney.com/apple-touch-icon.png',
                'description' => 'AI 图像生成工具',
                'sort' => 2,
                'is_show' => true,
                'tags' => [3, 5],
            ],
            [
                'category_id' => 4,
                'name' => 'Figma',
                'url' => 'https://www.figma.com',
                'logo' => 'https://static.figma.com/app/icon/1/favicon.svg',
                'description' => '专业的在线设计工具',
                'sort' => 1,
                'is_show' => true,
                'tags' => [3],
            ],
            [
                'category_id' => 4,
                'name' => 'Dribbble',
                'url' => 'https://dribbble.com',
                'logo' => 'https://cdn.dribbble.com/assets/favicon-63b2904a073c89b52b19aa08cebc16a154bcf83fee8ecc6439968b1e6db569c7.ico',
                'description' => '设计师作品分享平台',
                'sort' => 2,
                'is_show' => true,
                'tags' => [3, 6],
            ],
        ];

        foreach ($sites as $site) {
            $tags = $site['tags'];
            unset($site['tags']);
            
            $newSite = Site::create($site);
            $newSite->tags()->attach($tags);
        }
    }
}
