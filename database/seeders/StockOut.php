<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockOut extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_out')->insert([
            's1_invoice' => "998000001",
            's1_date_invoice' => now(),
            's1_store' => "NEO ACC",
            's1_image' => "image",
            's1_item_store' => "Helm Bogo Anak Usia 7-10 Tahun, Pilot Pony One Size",
            's1_sku_store' => "Pilot Pony One Size",
            's1_sku_warehouse' => "998000112",
            's1_quantity' => 1,
            's2_invoice' => "998000001",
            's2_item_warehouse' => "Helm Anak Usia 7-10 Tahun",
            's2_quantity' => 1,
            's3_packer' => "Ken",
            's3_shipment_status' => "Terkirim",
            'status' => "approved",
            'name' => "Aji",
            'date' => now(),
        ]);
    }
}
