<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->renameColumn('sort', 'sort_order');
        });
    }

    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->renameColumn('sort_order', 'sort');
        });
    }
};
