@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- HEADER --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Warehouse Items</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">warehouse items</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="card card-outline card-primary p-2">
            <div class="col-12">
                {{-- BUTTON CREATE --}}
                <div class="col-12 col-md-12 col-sm-12 m-2">
                    <a href="{{ route('warehouse.item.create') }}" class="btn btn-success">add Item <i
                            class="fas fa-plus"></i></a>
                </div>
                <div class="col-12 col-md-12 col-sm-12">
                    {{-- TABLES --}}
                    <table class="table table-bordered items-datatable">
                        <thead>
                            <tr>
                                <th>item_warehouse</th>
                                <th>sku_warehouse</th>
                                <th>sku_lazada</th>
                                <th>sku_shopee</th>
                                <th>sku_tokopedia</th>
                                <th>variant</th>
                                <th>group</th>
                                <th>stock</th>
                                <th>minimum_stock</th>
                                <th>last_price</th>
                                <th>store</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('third_party_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // load datatables
            loaddatatables();

            // show toast success
            var msg_success = "{{ session('msg_success') }}";
            if (msg_success) resultAlert(msg_success, 'success')

            // show toast failed
            var msg_failed = "{{ session('msg_failed') }}";
            if (msg_failed) resultAlert(msg_failed, 'failed')

        });

        function loaddatatables() {
            //  SET DATATABLE
            var table = $('.items-datatable').DataTable({
                // scrollX: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('warehouse.items') }}",
                columns: [{
                        data: 'item_warehouse',
                        name: 'item_warehouse'
                    },
                    {
                        data: 'sku_warehouse',
                        name: 'sku_warehouse'
                    },
                    {
                        data: 'sku_lazada',
                        name: 'sku_lazada'
                    },
                    {
                        data: 'sku_shopee',
                        name: 'sku_shopee'
                    },
                    {
                        data: 'sku_tokopedia',
                        name: 'sku_tokopedia'
                    },
                    {
                        data: 'variant',
                        name: 'variant'
                    },
                    {
                        data: 'group',
                        name: 'group'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'minimum_stock',
                        name: 'minimum_stock'
                    },
                    {
                        data: 'last_price',
                        name: 'last_price'
                    },
                    {
                        data: 'store',
                        name: 'store'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'apakah anda yakin?',
                text: `Anda akan menghapus permanen item ${name}!`,
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'batal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, hapus!'
            }).then((result) => {
                if (result.value) {
                    let request_delete = `{{ url('warehouse/items/delete') }}/${id}`;
                    window.location.replace(request_delete);
                }
            })
        }

        function resultAlert(msg, type) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            if (type == 'success') {
                Toast.fire({
                    icon: 'success',
                    title: msg
                })
            }

            if (type == 'failed') {
                Toast.fire({
                    icon: 'error',
                    title: msg
                })
            }

        }

        function barcodeAlert(barcode) {
            Swal.fire({
                title: 'barcode',
                html: `<img src="${barcode}" alt="barcode"/>`,
                focusConfirm: false,
            })
        }
    </script>
@endsection
