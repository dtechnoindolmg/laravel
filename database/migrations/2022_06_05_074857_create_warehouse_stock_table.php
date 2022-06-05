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
        Schema::create('warehouse_stock', function (Blueprint $table) {
            $table->id();
            $table->string('sku_warehouse');
            $table->string('sku_lazada')->nullable()->default(null);
            $table->string('sku_shopee')->nullable()->default(null);
            $table->string('sku_tokopedia')->nullable()->default(null);
            $table->string('item_warehouse');
            $table->string('variant');
            $table->string('group');
            $table->integer('stock');
            $table->integer('minimum_stock');
            $table->integer('shelf_life');
            $table->timestamp('last_in')->nullable()->default(null);
            $table->timestamp('last_out')->nullable()->default(null);
            $table->integer('last_price');
            $table->string('store');
            $table->timestamps();
            $table->index('sku_warehouse');
            $table->index('sku_lazada');
            $table->index('sku_shopee');
            $table->index('sku_tokopedia');
            $table->index('stock');
            $table->index('minimum_stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_stock');
    }
};
