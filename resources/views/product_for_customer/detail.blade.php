@extends('layout.common')

@section('title_suffix', ' - '.$product['product_name'])
@push('css')
    <link href="css/product_for_customer/detail.css" rel="stylesheet">
@endpush
@push('script')
    <link href="js/product_for_customer/detail.js" rel="stylesheet">
@endpush
 
@section('header')
    @include('layout.header')
@endsection

@section('content')
    
    <div class="product-detail-container">

        <div class="left-area">
            <div class="area-image">
                <img src="image/product.png">
            </div>
        </div>

        <div class="right-area">
            <div class="area-product-info">
                <h1>{{ $product['product_name'] }}</h1>
                <hr>
                <p>商品の説明が入ります。</p>
            </div>
    
            <div class="area-order-form">
            </div>
        </div>

    </div>
@endsection