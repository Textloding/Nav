<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->comment('分类ID');
            $table->string('name')->comment('网站名称');
            $table->string('url')->comment('网站地址');
            $table->string('logo')->nullable()->comment('网站logo');
            $table->string('description')->nullable()->comment('网站描述');
            $table->integer('sort')->default(0)->comment('排序');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sites');
    }
};
