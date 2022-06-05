<form method="{{ $method }}" action="{{ route($action) }}">
    @csrf

    <div class="form-group">
        <label for="group">Kategori</label>
        <input type="text" class="form-control" id="group" name="group" aria-describedby="groupHelp" required>
    </div>

    <div class="form-group">
        <label for="sku_warehouse">SKU Gudang</label>
        <input type="text" class="form-control" id="sku_warehouse" name="sku_warehouse"
            aria-describedby="sku_warehouseHelp" required>
    </div>

    <div class="form-group">
        <label for="shop">SKU Toko</label>
        <div class="form-row">
            <div class="form-group col-md-4">
                <select class="form-control select2" id="shop" name="shop" aria-describedby="shopHelp" required>
                    <option selected="">- Pilih Marketplace-</option>
                    <option value="lazada">Lazada</option>
                    <option value="shopee">Shopee</option>
                </select>
            </div>
            <div class="form-group col-md-8">
                <input type="text" class="form-control" id="sku_shop" name="sku_shop" aria-describedby="sku_shopHelp"
                    required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="item_warehouse">Nama Item</label>
        <input type="text" class="form-control" id="item_warehouse" name="item_warehouse"
            aria-describedby="item_warehouseHelp" required>
    </div>

    <div class="form-group">
        <label for="variant">Variasi</label>
        <input type="text" class="form-control" id="variant" name="variant" aria-describedby="variantHelp" required />
    </div>

    <div class="form-group">
        <div class="form-row">
            <div class="form-group">
                <div class="col">
                    <label for="stock">Stok</label>
                </div>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <div class="form-group col-sm-4">
                        <span onclick="counterDecrease('stock')" class="form-control btn btn-secondary">-</span>
                    </div>
                    <div class="form-group col-sm-4">
                        <input type="number" class="form-control" id="stock" name="stock" aria-describedby="stockHelp"
                            value="0" required />
                    </div>
                    <div class="form-group col-sm-4">
                        <span onclick="counterIncrease('stock')" class="form-control btn btn-secondary">+</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col">
                    <label for="minimum_stock">Minimum Stok</label>
                </div>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <div class="form-group col-sm-4">
                        <span onclick="counterDecrease('minimum_stock')" class="form-control btn btn-secondary">-</span>
                    </div>
                    <div class="form-group col-sm-4">
                        <input type="number" class="form-control" id="minimum_stock" name="minimum_stock"
                            aria-describedby="minimum_stockHelp" value="0" required />
                    </div>
                    <div class="form-group col-sm-4">
                        <span onclick="counterIncrease('minimum_stock')" class="form-control btn btn-secondary">+</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col">
                    <label for="shelf_life">Waktu Pengendapan Barang</label>
                </div>
                <div class="input-group has-validation">
                    <input type="number" class="form-control" id="shelf_life" name="shelf_life" required />
                    <div class="input-group-append">
                        <span class="input-group-text">bln</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="last_price">Harga</label>
        <input type="text" class="form-control" id="last_price" name="last_price" aria-describedby="last_priceHelp"
            required />
    </div>

    <div class="form-group">
        <label>Kaitkan Toko</label>
        <select class="form-control select2" multiple="multiple" data-placeholder="Pilih Toko" name="store[]" required>
            <option>Alabama</option>
            <option>Alaska</option>
            <option>California</option>
            <option>Delaware</option>
            <option>Tennessee</option>
            <option>Texas</option>
            <option>Washington</option>
        </select>
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

@section('third_party_scripts')
    <script>
        // onload
        $(document).ready(function() {
            var rupiah = document.getElementById('last_price');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value);
            });
        });

        function counterIncrease(id_target) {
            let last_val = Number($('#' + id_target).val());
            let new_val = last_val + 5;
            $('#' + id_target).val(new_val);
        }

        function counterDecrease(id_target) {
            let last_val = Number($('#' + id_target).val());
            let new_val = last_val - 5;
            if (new_val < 0) new_val = 0;
            $('#' + id_target).val(new_val);
        }

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
    </script>
@endsection
