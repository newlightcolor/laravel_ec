<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FormSetting;

class ProductForCustomerController extends Controller
{
    public function detail()
    {
        $productModel = new Product();
        $product = $productModel->first()->toArray();
        
        $view_args = [];
        $view_args['product'] = $product;
        return view('product_for_customer.detail', $view_args);
    }
}
