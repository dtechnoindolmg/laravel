<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StockIn;
use DataTables;
use Illuminate\Support\Facades\DB;

class WarehouseStockInController extends Controller
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
        // dd(StockIn::all());
        // variable
        $data_stockin = array();
        // request ajax show datatables
        if ($request->ajax()) {
            // get data stockIn
            $data_stockin = StockIn::all();
            // build response
            return Datatables::of($data_stockin)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "<div class=\"btn-group-vertical\">";
                    $btn .= "<a href=\"#\" class=\"edit btn btn-info btn-lg\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Detail Item\"><i class=\"far fa-file-alt\"></i></a>";
                    $btn .= "<a href=\"#\" onclick=\"\" class=\"edit btn btn-warning btn-lg\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Print Barcode\"><i class=\"fas fa-barcode\"></i></a>";
                    $btn .= "<a href=\"#\" onclick=\"confirmDelete(" . $row['id'] . ",'" . $row['item_warehouse'] . "')\" class=\"edit btn btn-danger btn-lg\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Delete Item\"><i class=\"far fa-trash-alt\"></i></a>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('warehouse.stockin.view');
    }

    public function create()
    {
        return view('warehouse.stockin.create');
    }
}
