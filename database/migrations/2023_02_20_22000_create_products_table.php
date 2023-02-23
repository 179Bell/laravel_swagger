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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('商品ID');
            $table->string('product_name')->comment('商品名');
            $table->string('product_origin')->comment('生産地');
            $table->string('description')->comment('商品の説明');
            $table->unsignedBigInteger('category_id')->comment('カテゴリーID');
            $table->string('price')->comment('商品価格');
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
        Schema::dropIfExists('products');
    }
};
