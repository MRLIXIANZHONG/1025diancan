<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_code')->comment('订单编号');
            $table->integer('order_status')->comment('订单状态 -1 已取消 0代付款 1等待发货 2等待收货 3完成');
            $table->integer('shop_id')->comment('店铺id');
            $table->string('shop_name')->comment('店铺名称');
            $table->string('shop_img')->comment('店铺图片');
            $table->decimal('order_price')->comment('订单总价');
            $table->string('order_address')->comment('详细地址');
            $table->string('province')->comment('省');
            $table->string('city')->comment('市');
            $table->string('county')->comment('县');
            $table->string('tel')->comment('收货人电话');
            $table->string('name')->comment('收货人姓名');
            $table->string('order_birth_time')->comment('订单创建时间');
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
        Schema::dropIfExists('orders');
    }
}
