<form method="{{ $method }}" action="{{ route($action) }}">
    @csrf
    <div class="form-group">
        <button type="button" class="form-control btn btn-primary col-3" data-toggle="modal"
            data-target="#sku_warehouse_modal">
            Pilih SKU Gudang
        </button>
    </div>

    <div class="form-group">
        <label for="sku_warehouse">SKU Gudang</label>
        <input type="text" class="form-control" id="sku_warehouse" name="sku_warehouse"
            aria-describedby="sku_warehouseHelp" readonly>
    </div>

    <div class="form-group">
        <label for="item_warehouse">Nama Item</label>
        <input type="text" class="form-control" id="item_warehouse" name="item_warehouse"
            aria-describedby="item_warehouseHelp" readonly>
    </div>

    <div class="form-group">
        <label for="id_invoice">Invoice</label>
        <input type="text" class="form-control" id="id_invoice" name="id_invoice" aria-describedby="id_invoiceHelp"
            required>
    </div>

    <div class="form-group">
        <label for="date_invoice">Tanggal Invoice</label>
        <input type="date" class="form-control" id="date_invoice" name="date_invoice"
            aria-describedby="date_invoiceHelp" required>
    </div>

    <div class="form-group">
        <label>Date and time:</label>
        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" />
            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="date_in">Tanggal Barang Masuk</label>
        <input type="date" class="form-control" id="date_in" name="date_in" aria-describedby="date_inHelp" required>
    </div>

    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" aria-describedby="quantityHelp"
            required>
    </div>

    <div class="form-group">
        <label for="expired">Tanggal Expired</label>
        <input type="date" class="form-control" id="expired" name="expired" aria-describedby="expiredHelp" required>
    </div>

    <div class="form-group">
        <label for="price">Harga</label>
        <input type="text" class="form-control" id="price" name="price" aria-describedby="priceHelp" required />
    </div>

    <div class="form-group">
        <label for="supplier">Supplier</label>
        <input type="text" class="form-control" id="supplier" name="supplier" aria-describedby="supplierHelp"
            required>
    </div>

    <div class="form-group">
        <label for="image">Gambar</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="image" name="image" required>
            <label class="custom-file-label" for="image">Gambar</label>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="btn-group">
            <div class="col-md-6">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="sku_warehouse_modal" tabindex="-1" aria-labelledby="sku_warehouse_modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sku_warehouse_modalLabel">SKU Gudang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="sku_warehouse_find">SKU Gudang</label>
                        <input type="text" class="form-control" id="sku_warehouse_find" name="sku_warehouse_find"
                            aria-describedby="sku_warehouse_findHelp">
                    </div>
                </form>

                <div class="card ">
                    <div class="card-body " style="overflow:scroll; height:500px;">
                        <div class="row row-cols-2" id="list_item_warehouse">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Pilih</button>
            </div>
        </div>
    </div>
</div>

@section('third_party_scripts')
    <script>
        // onload
        $(document).ready(function() {
            // format rupiah
            var rupiah = document.getElementById('price');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value);
            });

            // live search server list sku warehouse
            var find_sku_warehouse = document.getElementById('sku_warehouse_find');
            find_sku_warehouse.addEventListener('keyup', function(e) {
                searchSKUwarehouse(this.value);
            });

            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function searchSKUwarehouse(text) {
            var settings = {
                "url": "{{ url('/warehouse/items/find') }}/" + text,
                "method": "GET",
            };
            $.ajax(settings).done(async function(response) {
                if (response.status == 1) {
                    let sku_warehouse = response.data;
                    let htmlItem = '';
                    $("#list_item_warehouse").html("");
                    for await (const iterator of sku_warehouse) {
                        let data = {
                            item_warehouse: iterator.item_warehouse,
                            sku_warehouse: iterator.sku_warehouse,
                            stock: iterator.stock,
                            last_price: iterator.last_price,
                            last_in: iterator.last_in
                        }
                        htmlItem += itemSKUwarehouse(data);
                    }
                    $('#list_item_warehouse').append(htmlItem);
                }
            });
        }

        function setSeletedItemSKUwarehouse(sku_warehouse, item_warehouse) {
            $('#sku_warehouse').val(sku_warehouse);
            $('#item_warehouse').val(item_warehouse);
        }
    </script>

    <script>
        // DOM ITEM LIST SKU WAREHOUSE
        let itemSKUwarehouse = (data) => {
            let {
                item_warehouse,
                sku_warehouse,
                stock,
                last_price,
                last_in
            } = data;
            return `<div onclick="setSeletedItemSKUwarehouse('${sku_warehouse}','${item_warehouse}')" class="card mb-3" style="max-width: 540px;" style="cursor: grab">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="https://kliknusae.com/img/404.jpg" alt="kliknusae.com"
                                                width="100%" height="100%">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">${item_warehouse}</h5>
                                                <p class="card-text">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            SKU Gudang
                                                        </td>
                                                        <td>
                                                            :
                                                        </td>
                                                        <td>
                                                            ${sku_warehouse}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Stok
                                                        </td>
                                                        <td>
                                                            :
                                                        </td>
                                                        <td>
                                                            ${stock}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Harga
                                                        </td>
                                                        <td>
                                                            :
                                                        </td>
                                                        <td>
                                                            ${last_price}
                                                        </td>
                                                    </tr>
                                                </table>
                                                </p>
                                                <p class="card-text"><small class="text-muted">tambah stok
                                                        terakhir : ${last_in}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
        }
    </script>
@endsection
