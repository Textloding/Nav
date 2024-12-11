<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Site;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 创建分类
        $categories = [
            [
                'name' => '常用工具',
                'icon' => 'tools',
                'sort_order' => 1,
                'is_show' => true,
            ],
            [
                'name' => '开发文档',
                'icon' => 'document',
                'sort_order' => 2,
                'is_show' => true,
            ],
            [
                'name' => '设计资源',
                'icon' => 'design',
                'sort_order' => 3,
                'is_show' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // 创建标签
        $tags = [
            ['name' => 'PHP'],
            ['name' => 'JavaScript'],
            ['name' => 'Vue'],
            ['name' => 'React'],
            ['name' => 'UI'],
            ['name' => '工具'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }

        // 创建网站
        $sites = [
            // 常用工具
            [
                'category_id' => 1,
                'name' => 'GitHub',
                'url' => 'https://github.com',
                'logo' => 'https://github.githubassets.com/favicons/favicon.svg',
                'description' => '全球最大的代码托管平台',
                'sort_order' => 1,
                'is_show' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'VSCode',
                'url' => 'https://code.visualstudio.com',
                'logo' => 'https://code.visualstudio.com/assets/images/code-stable.png',
                'description' => '微软出品的代码编辑器',
                'sort_order' => 2,
                'is_show' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Stack Overflow',
                'url' => 'https://stackoverflow.com',
                'logo' => 'https://cdn.sstatic.net/Sites/stackoverflow/Img/favicon.ico',
                'description' => '程序员问答社区',
                'sort_order' => 3,
                'is_show' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'ChatGPT',
                'url' => 'https://chat.openai.com',
                'logo' => 'https://chat.openai.com/favicon.ico',
                'description' => 'OpenAI 开发的 AI 助手',
                'sort_order' => 4,
                'is_show' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Postman',
                'url' => 'https://www.postman.com',
                'logo' => 'https://www.postman.com/_ar-assets/images/favicon-1-48.png',
                'description' => 'API 开发测试工具',
                'sort_order' => 5,
                'is_show' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'CodePen',
                'url' => 'https://codepen.io',
                'logo' => 'https://cpwebassets.codepen.io/assets/favicon/favicon-touch-de50acbf5d634ec6791894eba4ba9cf490f709b3d742597c6fc4b734e6492a5a.png',
                'description' => '在线代码编辑器',
                'sort_order' => 6,
                'is_show' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'DevDocs',
                'url' => 'https://devdocs.io',
                'logo' => 'https://devdocs.io/favicon.ico',
                'description' => '开发文档聚合工具',
                'sort_order' => 7,
                'is_show' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Can I Use',
                'url' => 'https://caniuse.com',
                'logo' => 'https://caniuse.com/img/favicon-128.png',
                'description' => '浏览器特性兼容性查询',
                'sort_order' => 8,
                'is_show' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'JSON Editor Online',
                'url' => 'https://jsoneditoronline.org',
                'logo' => 'https://jsoneditoronline.org/favicon.ico',
                'description' => '在线 JSON 编辑器',
                'sort_order' => 9,
                'is_show' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'RegExr',
                'url' => 'https://regexr.com',
                'logo' => 'https://regexr.com/assets/favicon.ico',
                'description' => '正则表达式测试工具',
                'sort_order' => 10,
                'is_show' => true,
            ],

            // 开发文档
            [
                'category_id' => 2,
                'name' => 'Vue.js',
                'url' => 'https://vuejs.org',
                'logo' => 'https://vuejs.org/logo.svg',
                'description' => 'Vue.js 官方文档',
                'sort_order' => 1,
                'is_show' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'React',
                'url' => 'https://reactjs.org',
                'logo' => 'https://reactjs.org/favicon.ico',
                'description' => 'React 官方文档',
                'sort_order' => 2,
                'is_show' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'MDN Web Docs',
                'url' => 'https://developer.mozilla.org',
                'logo' => 'https://developer.mozilla.org/favicon-48x48.cbbd161b.png',
                'description' => 'Mozilla 开发者网络',
                'sort_order' => 3,
                'is_show' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'PHP',
                'url' => 'https://php.net',
                'logo' => 'https://www.php.net/favicon.svg',
                'description' => 'PHP 官方文档',
                'sort_order' => 4,
                'is_show' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Node.js',
                'url' => 'https://nodejs.org',
                'logo' => 'https://nodejs.org/static/images/favicons/favicon.ico',
                'description' => 'Node.js 官方文档',
                'sort_order' => 5,
                'is_show' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'TypeScript',
                'url' => 'https://www.typescriptlang.org',
                'logo' => 'https://www.typescriptlang.org/favicon-32x32.png',
                'description' => 'TypeScript 官方文档',
                'sort_order' => 6,
                'is_show' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Laravel',
                'url' => 'https://laravel.com',
                'logo' => 'https://laravel.com/img/favicon/favicon.ico',
                'description' => 'Laravel 官方文档',
                'sort_order' => 7,
                'is_show' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Python',
                'url' => 'https://www.python.org',
                'logo' => 'https://www.python.org/static/favicon.ico',
                'description' => 'Python 官方文档',
                'sort_order' => 8,
                'is_show' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Go',
                'url' => 'https://golang.org',
                'logo' => 'https://golang.org/favicon.ico',
                'description' => 'Go 语言官方文档',
                'sort_order' => 9,
                'is_show' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Rust',
                'url' => 'https://www.rust-lang.org',
                'logo' => 'https://www.rust-lang.org/static/images/favicon.svg',
                'description' => 'Rust 语言官方文档',
                'sort_order' => 10,
                'is_show' => true,
            ],

            // 设计资源
            [
                'category_id' => 3,
                'name' => 'Dribbble',
                'url' => 'https://dribbble.com',
                'logo' => 'https://cdn.dribbble.com/assets/favicon-63b2904a073c89b52b19aa08cebc16a154bcf83fee8ecc6439968b1e6db569c7.ico',
                'description' => '设计师作品分享平台',
                'sort_order' => 1,
                'is_show' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Behance',
                'url' => 'https://www.behance.net',
                'logo' => 'https://a5.behance.net/2acd763b00852cc0468f438b26b86e21a4b1eb20/img/site/favicon.ico',
                'description' => 'Adobe 旗下设计社区',
                'sort_order' => 2,
                'is_show' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Figma',
                'url' => 'https://www.figma.com',
                'logo' => 'https://static.figma.com/app/icon/1/favicon.svg',
                'description' => '专业的在线设计工具',
                'sort_order' => 3,
                'is_show' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Adobe Color',
                'url' => 'https://color.adobe.com',
                'logo' => 'https://color.adobe.com/favicon.ico',
                'description' => '配色方案生成工具',
                'sort_order' => 4,
                'is_show' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Unsplash',
                'url' => 'https://unsplash.com',
                'logo' => 'https://unsplash.com/favicon-32x32.png',
                'description' => '免费高质量图片',
                'sort_order' => 5,
                'is_show' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'IconFont',
                'url' => 'https://www.iconfont.cn',
                'logo' => 'https://img.alicdn.com/imgextra/i4/O1CN01Z5paLz1O0zuCC7osS_!!6000000001644-55-tps-83-82.svg',
                'description' => '阿里巴巴矢量图标库',
                'sort_order' => 6,
                'is_show' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Material Design',
                'url' => 'https://material.io',
                'logo' => 'https://material.io/favicon.ico',
                'description' => 'Google 设计系统',
                'sort_order' => 7,
                'is_show' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Ant Design',
                'url' => 'https://ant.design',
                'logo' => 'https://gw.alipayobjects.com/zos/rmsportal/rlpTLlbMzTNYuZGGCVYM.png',
                'description' => '蚂蚁金服设计系统',
                'sort_order' => 8,
                'is_show' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Coolors',
                'url' => 'https://coolors.co',
                'logo' => 'https://coolors.co/assets/img/favicon.png',
                'description' => '配色方案生成器',
                'sort_order' => 9,
                'is_show' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Font Awesome',
                'url' => 'https://fontawesome.com',
                'logo' => 'https://fontawesome.com/favicon.ico',
                'description' => '图标字体库',
                'sort_order' => 10,
                'is_show' => true,
            ],
        ];

        foreach ($sites as $site) {
            $newSite = Site::create($site);
            
            // 为每个网站随机添加1-3个标签
            $tagIds = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id')->toArray();
            $newSite->tags()->attach($tagIds);
        }
    }
}
