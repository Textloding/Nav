# 极简个人导航系统

一个基于 Lumen + Vue3 构建的极简风格个人导航系统，支持自定义导航链接、分类管理等功能。
后台账号:admin   后台密码:admin123

## 效果及页面展示

### 基础页面展示

![image](https://github.com/user-attachments/assets/dda858b6-5f13-4c87-88ee-6ec6d7b17809)
![image](https://github.com/user-attachments/assets/c60da401-3cdd-4156-b6b3-4e5eb6af2cf1)
![image](https://github.com/user-attachments/assets/f7c33d32-da58-4212-9cfe-954a4618e7c5)

### 拖拽排序效果

![20241217_131235](https://github.com/user-attachments/assets/39ff94f7-265d-4141-b7bc-d434ea0a58ba)

### 站点隐藏以及分类、站点删除效果

![20241217_131748](https://github.com/user-attachments/assets/750b2e27-ca32-43d5-9ca3-29714708644d)

## 测试网站

### [传送门（点我跳转）](https://test.nav.oneself.icu/)
### 账号:admin
### 密码:admin123

⚠️ 警告：请勿添加违法地址,系统会记录用户操作以及ip数据


## 功能特点

- 极简风格界面设计
- 响应式布局，支持移动端访问
- 快速导航和搜索
- 简单易用的后台管理
- 安全的用户认证系统

## 技术栈

### 后端
- Lumen 10
- PHP 8.1+
- MySQL 5.7+
- Composer

### 前端
- Vue 3
- Vite
- TailwindCSS
- TypeScript

## 环境要求

- PHP >= 8.1
- MySQL >= 5.7
- Composer
- Node.js >= 16

## 安装步骤

> 该项目当前为首发版，后续整理好会将前后端分别上传，该项目目前无需数据迁移，可直接导入根目录下的数据库文件,软连接需删除重建。后续有时间也会打包成Docker方便部署。

### 本地开发环境搭建

1. 克隆项目
```bash
git clone https://github.com/Textloding/nav.git
cd nav
```

2. 安装后端依赖
```bash
composer install
```

3. 环境配置
```bash
cp .env.example .env
//php artisan key:generate不存在需要手动生成后填写JWT_SECRET与APP_KEY（找个在线网站随机生成32位字符串即可）
```

4. 配置数据库
编辑 .env 文件，设置数据库连接信息：
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. 运行数据库迁移
```bash
php artisan migrate
```

6. 启动开发服务器
```bash
php artisan serve
```

### 宝塔面板部署步骤

1. 在宝塔面板中添加站点
   - 添加域名
   - 选择PHP版本 >= 8.1
   - 创建数据库

2. 上传代码
   - 使用 FTP 或 Git 将代码上传到站点根目录

3. 设置运行目录
   - 网站目录：`/www/wwwroot/your_domain`
   - 运行目录：`/public`

4. 创建软链接
```bash
# 进入网站根目录
cd /www/wwwroot/your_domain

# 创建storage软链接
先在/www/wwwroot/your_domain/public/storage/app目录下新建public文件夹
ln -s /www/wwwroot/your_domain/storage/app/public /www/wwwroot/your_domain/public/storage

# 设置目录权限
chown -R www:www /www/wwwroot/your_domain
chmod -R 755 /www/wwwroot/your_domain
chmod -R 777 /www/wwwroot/your_domain/storage
```

5. 配置伪静态
在网站设置中添加以下 Nginx 伪静态规则：
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

6. 安装依赖和初始化
```bash
composer install --no-dev
php artisan key:generate
php artisan migrate
php artisan storage:link
```

7. 优化配置
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 常见问题

1. storage 目录权限问题
```bash
chmod -R 777 storage
chmod -R 777 bootstrap/cache
```

2. 配置文件加载问题
```bash
php artisan config:clear
php artisan cache:clear
```

## 维护更新

1. 拉取最新代码
```bash
git pull origin main
```

2. 更新依赖
```bash
composer update
```

3. 运行迁移
```bash
php artisan migrate
```

## 注意事项

- 确保服务器 PHP 版本 >= 8.1
- 定期备份数据库和上传文件
- 保持系统和依赖包的及时更新
- 配置文件中的敏感信息请妥善保管

## 安全建议

- 定期更新密码
- 使用 HTTPS 协议
- 配置防火墙规则
- 定期查看系统日志

## 待解决问题以及后期优化

- 前台无logo时没有默认图标
- 后台填写描述过长时需要限制
- 前台加入密码解锁功能
- 前台加入自定义背景功能
- 前台加入分类块透明度调整功能
- 配置登录自定义背景功能

## 贡献指南

欢迎提交 Issue 和 Pull Request 来帮助改进项目。

## 许可证

本项目仅供个人学习使用，禁止商业用途。详见 [LICENSE](LICENSE) 文件。
