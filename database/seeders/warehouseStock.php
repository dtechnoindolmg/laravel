<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class warehouseStock extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('warehouse_stock')->insert([
            'sku_warehouse' => "998000112",
            'sku_lazada' => "Pilot Pony",
            'sku_shopee' => "",
            'sku_tokopedia' => "",
            'item_warehouse' => "Helm Anak Bogo Usia 7-10 Tahun",
            'variant' => "Motif Pilot Little Pony/Kuda Pony",
            'group' => "Helm",
            'stock' => 25,
            'minimum_stock' => 5,
            'shelf_life' => 60,
            'last_in' => now(),
            'last_out' => now(),
            'last_price' => 45000,
            'store' => "NEO ACC",
        ]);
    }
}