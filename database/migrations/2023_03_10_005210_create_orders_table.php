<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('order_date')->comment('注文日');
            $table->string('quantity')->comment('数量');
            $table->string('product_id')->comment('商品ID');
            $table->string('customer_id')->comment('顧客ID');
            $table->boolean('is_delivered')->default(false)->comment('発送フラグ');
            $table->timestamps();
        });
    }
};
