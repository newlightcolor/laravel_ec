@extends('layout.common')

@section('title_suffix', ' - '.$product['product_name'])
@push('css')
    <link href="css/product_for_customer/detail.css" rel="stylesheet">
@endpush
@push('script')
    <script src="js/product_for_customer/detail.js"></script>
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