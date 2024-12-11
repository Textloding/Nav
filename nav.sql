/*
 Navicat Premium Dump SQL

 Source Server         : 虚拟机
 Source Server Type    : MySQL
 Source Server Version : 80035 (8.0.35)
 Source Host           : 192.168.1.8:3306
 Source Schema         : lumen_test

 Target Server Type    : MySQL
 Target Server Version : 80035 (8.0.35)
 File Encoding         : 65001

 Date: 11/12/2024 13:24:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '分类图标',
  `sort_order` int NOT NULL DEFAULT 0 COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, '常用工具', 'tools', 1, 1, '2024-12-08 01:43:00', '2024-12-08 01:43:00');
INSERT INTO `categories` VALUES (2, '开发文档', 'document', 2, 1, '2024-12-08 01:43:00', '2024-12-08 01:43:00');
INSERT INTO `categories` VALUES (3, '设计资源', 'design', 3, 1, '2024-12-08 01:43:00', '2024-12-08 01:43:00');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2024_01_10_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2024_01_15_000001_create_categories_table', 1);
INSERT INTO `migrations` VALUES (3, '2024_01_15_000002_create_sites_table', 1);
INSERT INTO `migrations` VALUES (4, '2024_01_15_000003_create_tags_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_01_15_000004_create_site_tag_table', 1);
INSERT INTO `migrations` VALUES (6, '2024_01_15_000005_rename_sort_to_sort_order_in_categories', 1);
INSERT INTO `migrations` VALUES (7, '2024_01_15_000006_rename_sort_to_sort_order_in_sites', 1);

-- ----------------------------
-- Table structure for site_tag
-- ----------------------------
DROP TABLE IF EXISTS `site_tag`;
CREATE TABLE `site_tag`  (
  `site_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`site_id`, `tag_id`) USING BTREE,
  INDEX `site_tag_tag_id_foreign`(`tag_id` ASC) USING BTREE,
  CONSTRAINT `site_tag_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `site_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of site_tag
-- ----------------------------
INSERT INTO `site_tag` VALUES (2, 1);
INSERT INTO `site_tag` VALUES (3, 1);
INSERT INTO `site_tag` VALUES (4, 1);
INSERT INTO `site_tag` VALUES (11, 1);
INSERT INTO `site_tag` VALUES (15, 1);
INSERT INTO `site_tag` VALUES (19, 1);
INSERT INTO `site_tag` VALUES (22, 1);
INSERT INTO `site_tag` VALUES (26, 1);
INSERT INTO `site_tag` VALUES (27, 1);
INSERT INTO `site_tag` VALUES (1, 2);
INSERT INTO `site_tag` VALUES (2, 2);
INSERT INTO `site_tag` VALUES (5, 2);
INSERT INTO `site_tag` VALUES (8, 2);
INSERT INTO `site_tag` VALUES (11, 2);
INSERT INTO `site_tag` VALUES (12, 2);
INSERT INTO `site_tag` VALUES (18, 2);
INSERT INTO `site_tag` VALUES (20, 2);
INSERT INTO `site_tag` VALUES (22, 2);
INSERT INTO `site_tag` VALUES (24, 2);
INSERT INTO `site_tag` VALUES (29, 2);
INSERT INTO `site_tag` VALUES (1, 3);
INSERT INTO `site_tag` VALUES (5, 3);
INSERT INTO `site_tag` VALUES (6, 3);
INSERT INTO `site_tag` VALUES (12, 3);
INSERT INTO `site_tag` VALUES (14, 3);
INSERT INTO `site_tag` VALUES (15, 3);
INSERT INTO `site_tag` VALUES (19, 3);
INSERT INTO `site_tag` VALUES (21, 3);
INSERT INTO `site_tag` VALUES (23, 3);
INSERT INTO `site_tag` VALUES (25, 3);
INSERT INTO `site_tag` VALUES (28, 3);
INSERT INTO `site_tag` VALUES (30, 3);
INSERT INTO `site_tag` VALUES (2, 4);
INSERT INTO `site_tag` VALUES (3, 4);
INSERT INTO `site_tag` VALUES (5, 4);
INSERT INTO `site_tag` VALUES (7, 4);
INSERT INTO `site_tag` VALUES (10, 4);
INSERT INTO `site_tag` VALUES (13, 4);
INSERT INTO `site_tag` VALUES (16, 4);
INSERT INTO `site_tag` VALUES (17, 4);
INSERT INTO `site_tag` VALUES (18, 4);
INSERT INTO `site_tag` VALUES (20, 4);
INSERT INTO `site_tag` VALUES (22, 4);
INSERT INTO `site_tag` VALUES (24, 4);
INSERT INTO `site_tag` VALUES (7, 5);
INSERT INTO `site_tag` VALUES (10, 5);
INSERT INTO `site_tag` VALUES (12, 5);
INSERT INTO `site_tag` VALUES (23, 5);
INSERT INTO `site_tag` VALUES (24, 5);
INSERT INTO `site_tag` VALUES (25, 5);
INSERT INTO `site_tag` VALUES (29, 5);
INSERT INTO `site_tag` VALUES (3, 6);
INSERT INTO `site_tag` VALUES (9, 6);
INSERT INTO `site_tag` VALUES (10, 6);
INSERT INTO `site_tag` VALUES (13, 6);
INSERT INTO `site_tag` VALUES (14, 6);
INSERT INTO `site_tag` VALUES (20, 6);
INSERT INTO `site_tag` VALUES (21, 6);
INSERT INTO `site_tag` VALUES (27, 6);

-- ----------------------------
-- Table structure for sites
-- ----------------------------
DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '网站名称',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '网站地址',
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '网站logo',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '网站描述',
  `sort_order` int NOT NULL DEFAULT 0 COMMENT '排序',
  `is_show` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否显示',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sites_category_id_foreign`(`category_id` ASC) USING BTREE,
  CONSTRAINT `sites_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sites
-- ----------------------------
INSERT INTO `sites` VALUES (1, 1, 'GitHub', 'https://github.com', 'https://github.githubassets.com/favicons/favicon.svg', '全球最大的代码托管平台', 1, 1, '2024-12-08 01:43:00', '2024-12-11 20:01:33');
INSERT INTO `sites` VALUES (2, 1, 'VSCode', 'https://code.visualstudio.com', 'https://code.visualstudio.com/assets/images/code-stable.png', '微软出品的代码编辑器', 2, 1, '2024-12-08 01:43:00', '2024-12-11 20:01:33');
INSERT INTO `sites` VALUES (3, 1, 'Stack Overflow', 'https://stackoverflow.com', 'https://cdn.sstatic.net/Sites/stackoverflow/Img/favicon.ico', '程序员问答社区', 3, 1, '2024-12-08 01:43:00', '2024-12-11 01:13:58');
INSERT INTO `sites` VALUES (4, 1, 'ChatGPT', 'https://chat.openai.com', 'https://chat.openai.com/favicon.ico', 'OpenAI 开发的 AI 助手', 4, 1, '2024-12-08 01:43:00', '2024-12-11 01:13:58');
INSERT INTO `sites` VALUES (5, 1, 'Postman', 'https://www.postman.com', 'https://www.postman.com/_ar-assets/images/favicon-1-48.png', 'API 开发测试工具', 5, 1, '2024-12-08 01:43:00', '2024-12-11 01:13:58');
INSERT INTO `sites` VALUES (6, 1, 'CodePen', 'https://codepen.io', 'https://cpwebassets.codepen.io/assets/favicon/favicon-touch-de50acbf5d634ec6791894eba4ba9cf490f709b3d742597c6fc4b734e6492a5a.png', '在线代码编辑器', 6, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (7, 1, 'DevDocs', 'https://devdocs.io', 'https://devdocs.io/favicon.ico', '开发文档聚合工具', 7, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (8, 1, 'Can I Use', 'https://caniuse.com', 'https://caniuse.com/img/favicon-128.png', '浏览器特性兼容性查询', 8, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (9, 1, 'JSON Editor Online', 'https://jsoneditoronline.org', 'https://jsoneditoronline.org/favicon.ico', '在线 JSON 编辑器', 9, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (10, 1, 'RegExr', 'https://regexr.com', 'https://regexr.com/assets/favicon.ico', '正则表达式测试工具', 10, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (11, 2, 'Vue.js', 'https://vuejs.org', 'https://vuejs.org/logo.svg', 'Vue.js 官方文档', 1, 1, '2024-12-08 01:43:00', '2024-12-11 19:51:27');
INSERT INTO `sites` VALUES (12, 2, 'React', 'https://reactjs.org', 'https://reactjs.org/favicon.ico', 'React 官方文档', 2, 1, '2024-12-08 01:43:00', '2024-12-11 19:51:27');
INSERT INTO `sites` VALUES (13, 2, 'MDN Web Docs', 'https://developer.mozilla.org', 'https://developer.mozilla.org/favicon-48x48.cbbd161b.png', 'Mozilla 开发者网络', 4, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (14, 2, 'PHP', 'https://php.net', 'https://www.php.net/favicon.svg', 'PHP 官方文档', 5, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (15, 2, 'Node.js', 'https://nodejs.org', 'https://nodejs.org/static/images/favicons/favicon.ico', 'Node.js 官方文档', 6, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (16, 2, 'TypeScript', 'https://www.typescriptlang.org', 'https://www.typescriptlang.org/favicon-32x32.png', 'TypeScript 官方文档', 7, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (17, 2, 'Laravel', 'https://laravel.com', 'https://laravel.com/img/favicon/favicon.ico', 'Laravel 官方文档', 8, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (18, 2, 'Python', 'https://www.python.org', 'https://www.python.org/static/favicon.ico', 'Python 官方文档', 9, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (19, 2, 'Go', 'https://golang.org', 'https://golang.org/favicon.ico', 'Go 语言官方文档', 10, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (20, 2, 'Rust', 'https://www.rust-lang.org', 'https://www.rust-lang.org/static/images/favicon.svg', 'Rust 语言官方文档', 11, 1, '2024-12-08 01:43:00', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (21, 3, 'Dribbble', 'https://dribbble.com', 'https://cdn.dribbble.com/assets/favicon-63b2904a073c89b52b19aa08cebc16a154bcf83fee8ecc6439968b1e6db569c7.ico', '设计师作品分享平台', 2, 1, '2024-12-08 01:43:00', '2024-12-11 19:54:19');
INSERT INTO `sites` VALUES (22, 3, 'Behance', 'https://www.behance.net', 'https://a5.behance.net/2acd763b00852cc0468f438b26b86e21a4b1eb20/img/site/favicon.ico', 'Adobe 旗下设计社区', 1, 1, '2024-12-08 01:43:00', '2024-12-11 19:57:29');
INSERT INTO `sites` VALUES (23, 3, 'Figma', 'https://www.figma.com', 'https://static.figma.com/app/icon/1/favicon.svg', '专业的在线设计工具', 4, 1, '2024-12-08 01:43:00', '2024-12-11 20:00:40');
INSERT INTO `sites` VALUES (24, 3, 'Adobe Color', 'https://color.adobe.com', 'https://color.adobe.com/favicon.ico', '配色方案生成工具', 3, 1, '2024-12-08 01:43:00', '2024-12-11 20:00:40');
INSERT INTO `sites` VALUES (25, 3, 'Unsplash', 'https://unsplash.com', 'https://unsplash.com/favicon-32x32.png', '免费高质量图片', 5, 1, '2024-12-08 01:43:00', '2024-12-08 20:52:31');
INSERT INTO `sites` VALUES (26, 3, 'IconFont', 'https://www.iconfont.cn', 'https://img.alicdn.com/imgextra/i4/O1CN01Z5paLz1O0zuCC7osS_!!6000000001644-55-tps-83-82.svg', '阿里巴巴矢量图标库', 6, 1, '2024-12-08 01:43:00', '2024-12-08 01:43:00');
INSERT INTO `sites` VALUES (27, 3, 'Material Design', 'https://material.io', 'https://material.io/favicon.ico', 'Google 设计系统', 7, 1, '2024-12-08 01:43:00', '2024-12-08 01:43:00');
INSERT INTO `sites` VALUES (28, 3, 'Ant Design', 'https://ant.design', 'https://gw.alipayobjects.com/zos/rmsportal/rlpTLlbMzTNYuZGGCVYM.png', '蚂蚁金服设计系统', 8, 1, '2024-12-08 01:43:00', '2024-12-08 01:43:00');
INSERT INTO `sites` VALUES (29, 3, 'Coolors', 'https://coolors.co', 'https://coolors.co/assets/img/favicon.png', '配色方案生成器', 9, 1, '2024-12-08 01:43:00', '2024-12-08 01:43:00');
INSERT INTO `sites` VALUES (30, 3, 'Font Awesome', 'https://fontawesome.com', 'https://fontawesome.com/favicon.ico', '图标字体库', 10, 1, '2024-12-08 01:43:00', '2024-12-08 17:37:28');
INSERT INTO `sites` VALUES (32, 2, '百度', 'http://www.baidu.com', 'https://www.baidu.com/favicon.ico', '百度一下', 11, 1, '2024-12-09 01:43:40', '2024-12-11 01:16:43');
INSERT INTO `sites` VALUES (40, 3, 'laravel', 'https://learnku.com', 'http://lumen.test/storage/images/icons/icon_79ggNLbatr_1733879099.jpeg', 'learnku', 11, 1, '2024-12-11 17:05:33', '2024-12-11 17:05:33');

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标签名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tags_name_unique`(`name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES (1, 'PHP', '2024-12-08 01:43:00', '2024-12-08 01:43:00');
INSERT INTO `tags` VALUES (2, 'JavaScript', '2024-12-08 01:43:00', '2024-12-08 01:43:00');
INSERT INTO `tags` VALUES (3, 'Vue', '2024-12-08 01:43:00', '2024-12-08 01:43:00');
INSERT INTO `tags` VALUES (4, 'React', '2024-12-08 01:43:00', '2024-12-08 01:43:00');
INSERT INTO `tags` VALUES (5, 'UI', '2024-12-08 01:43:00', '2024-12-08 01:43:00');
INSERT INTO `tags` VALUES (6, '工具', '2024-12-08 01:43:00', '2024-12-08 01:43:00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `api_token` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username` ASC) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE,
  UNIQUE INDEX `users_api_token_unique`(`api_token` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', '$2y$12$iTDZIoXsZaITTH7n7yE7VOWAXkFLvgnR41A.Okgxu3yNVOcrGx6l6', 'Administrator', 'admin@example.com', NULL, '2024-12-08 03:02:18', '2024-12-11 19:51:53');

SET FOREIGN_KEY_CHECKS = 1;
