<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WarehouseStock;
use DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;

class WarehouseItemsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view(Request $request)
    {
        // variable
        $data_warehousestock = array();
        // request ajax show datatables
        if ($request->ajax()) {
            // get data warestock
            $data_warehousestock = WarehouseStock::all();
            // build response
            return Datatables::of($data_warehousestock)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "<div class=\"btn-group-vertical\">";
                    $btn .= "<a href=\"#\" class=\"edit btn btn-info btn-lg\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Detail Item\"><i class=\"far fa-file-alt\"></i></a>";
                    $btn .= "<a href=\"#\" onclick=\"barcodeAlert('data:image/png;base64," . DNS1D::getBarcodePNG('4445645656', 'EAN13') . "')\" class=\"edit btn btn-warning btn-lg\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Print Barcode\"><i class=\"fas fa-barcode\"></i></a>";
                    $btn .= "<a href=\"#\" onclick=\"confirmDelete(" . $row['id'] . ",'" . $row['item_warehouse'] . "')\" class=\"edit btn btn-danger btn-lg\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Delete Item\"><i class=\"far fa-trash-alt\"></i></a>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('warehouse.items.view');
    }

    public function create()
    {
        return view('warehouse.items.create');
    }

    public function store(Request $request)
    {
        // variable
        $group          = $request->group;
        $sku_warehouse  = $request->sku_warehouse;
        $shop           = $request->shop;
        $sku_shop       = $request->sku_shop;
        $item_warehouse = $request->item_warehouse;
        $variant        = $request->variant;
        $stock          = $request->stock;
        $minimum_stock  = $request->minimum_stock;
        $shelf_life     = $request->shelf_life;
        $last_price     = $request->last_price;
        $store          = $request->store;

        DB::beginTransaction();
        try {
            // save item
            $new_data = new WarehouseStock();
            $new_data->sku_warehouse = $sku_warehouse;
            switch ($shop) {
                case 'lazada':
                    $new_data->sku_lazada = $sku_shop;
                    break;
                case 'shopee':
                    $new_data->sku_shopee = $sku_shop;
                    break;
                case 'tokopedia':
                    $new_data->sku_tokopedia = $sku_shop;
                    break;
                default:
                    break;
            }
            $new_data->item_warehouse   = $item_warehouse;
            $new_data->variant          = $variant;
            $new_data->group            = $group;
            $new_data->stock            = $stock;
            $new_data->minimum_stock    = $minimum_stock;
            $new_data->shelf_life       = $shelf_life;
            $new_data->last_price       = str_replace('.', '', $last_price);
            $new_data->store            = json_encode($store);
            $new_data->save();
            DB::commit();

            return redirect('warehouse/items')->with('msg_success', 'Item Berhasil Tersimpan!');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput();
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            WarehouseStock::find($id)->delete();
            DB::commit();
            return back()->with('msg_success', 'Item Berhasil Terhapus!');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('msg_failed', 'Item Gagal Terhapus!, ', $th->getMessage());
        }
    }

    public function find($text)
    {
        $data_warehousestock = WarehouseStock::where('sku_warehouse', 'like', "%" . $text . "%")
            ->orWhere('item_warehouse', 'like', '%' . $text . '%')->get();

        return response()->json([
            'status' => 1,
            'data' => $data_warehousestock,
        ]);
    }
}
