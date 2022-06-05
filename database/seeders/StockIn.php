<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockIn extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_in')->insert([
            'id_invoice' => "200000002",
            'sku_warehouse' => "998000002",
            'quantity' => 35,
            'expired' => now(),
            'price' => 90000,
            'supplier' => "BELIYA BAGS",
            'date_invoice' => now(),
            'date_in' => now(),
            'image' => "image",
        ]);
    }
}