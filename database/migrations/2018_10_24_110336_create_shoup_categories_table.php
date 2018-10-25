<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoupCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoup_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('分类名');
            $table->string('img')->comment('分类图片');
            $table->integer('status')->comment('状态：1显示，0隐藏');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoup_categories');
    }
}
