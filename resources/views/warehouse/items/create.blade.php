@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- HEADER --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Item</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Warehouse items</a></li>
                            <li class="breadcrumb-item"><a href="#">Create item</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- FORM WAREHOUSE --}}
        <div class="card card-outline card-primary p-2">
            <div class="col-12">
                @include('warehouse.items.form', ['method' => 'POST', 'action' => 'warehouse.item.store'])
            </div>
        </div>
    </div>
@endsection
