@extends('layout.common')

@section('title_suffix', ' - '.$product['product_name'])

@push('css')<link href="css/product/show.css" rel="stylesheet">@endpush
@push('script')<script src="js/product/show.js"></script>@endpush

@section('content')

    <div class="alert-wrapper"></div>

    <div id="product-page-container">

        <div class="left-area">
            <section class="area-image">
                <img src="image/product.png">
            </section>
        </div>

        <div class="right-area">

            <section class="area-product-info">
                <h1>{{ $product['product_name'] }}</h1>
                <hr>
                <p>商品の説明</p>
            </section>
    
            <section class="area-order-form">
                @include('order.form', ['OrderForm' => $OrderForm, 'product' => $product])
                @push('css')<link href="css/order/form.css" rel="stylesheet">@endpush
                @push('script')<script src="js/order/form.js"></script>@endpush
            </section>
        </div>

    </div>
@endsection