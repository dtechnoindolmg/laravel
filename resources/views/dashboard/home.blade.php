@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- HEADER --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Home <small class="text-black-50">Control panel</small></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- ITEMS --}}
        <div class="row">
            {{-- items inform --}}
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-luggage-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Items</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cart-plus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stocks In</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cart-arrow-down"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Stocks Out</span>
                        <span class="info-box-number">760</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number">760</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
