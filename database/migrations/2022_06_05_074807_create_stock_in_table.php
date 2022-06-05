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
        Schema::create('stock_in', function (Blueprint $table) {
            $table->id();
            $table->string('id_invoice');
            $table->string('sku_warehouse');
            $table->integer('quantity');
            $table->timestamp('expired')->nullable()->default(null);
            $table->integer('price');
            $table->string('supplier');
            $table->timestamp('date_invoice')->nullable()->default(null);
            $table->timestamp('date_in')->nullable()->default(null);
            $table->string('image');
            $table->timestamps();
            $table->index('sku_warehouse');
            $table->index('supplier');
            $table->index('date_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_in');
    }
};
