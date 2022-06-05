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
        Schema::create('stock_out', function (Blueprint $table) {
            $table->id();
            $table->string('s1_invoice');
            $table->timestamp('s1_date_invoice')->nullable()->default(null);
            $table->string('s1_store');
            $table->string('s1_image');
            $table->string('s1_item_store');
            $table->string('s1_sku_store');
            $table->string('s1_sku_warehouse');
            $table->integer('s1_quantity');
            $table->string('s2_invoice');
            $table->string('s2_item_warehouse');
            $table->integer('s2_quantity');
            $table->string('s3_packer');
            $table->string('s3_shipment_status');
            $table->string('status');
            $table->string('name');
            $table->timestamp('date')->nullable()->default(null);
            $table->timestamps();
            $table->index('s1_invoice');
            $table->index('s1_item_store');
            $table->index('s1_sku_store');
            $table->index('s1_sku_warehouse');
            $table->index('s2_invoice');
            $table->index('s2_item_warehouse');
            $table->index('s3_shipment_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_out');
    }
};
