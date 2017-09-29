<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 通过 Schema 创建表
        Schema::create('link', function (Blueprint $table) {
            $table->increments('link_id');
            $table->string('link_name')->default('')->commemt('//名称');
            $table->string('link_title')->default('')->commemt('//标题');
            $table->string('link_url')->default('')->commemt('//链接');
            $table->integer('link_order')->default(0)->commemt('//排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link');
    }
}
