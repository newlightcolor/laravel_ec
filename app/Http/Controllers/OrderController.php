<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Rules\Postcode;
use App\Services\Form\OrderForm;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $view_args = [];
        $view_args['OrderForm'] = new OrderForm($request);
        $response['html'] = view('order.form', $view_args)->render();

        if($request->ajax()){
            return response()->json($response);
        }
        else{
            //Only form
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'delivery_date' => ['required', 'date_format:Y-m-d'],
                'postcode' => ['required', new Postcode],
                'prefecture' => ['required'],
                'municipality' => ['required'],
                'address' => ['required'],
                'building' => [],
                'product_id' => ['required', 'numeric']
            ],
            [
                'product_id' => '不正な操作です。'
            ]
        );

        //バリデーションエラー（ガード節）
        if($validator->fails()){
            $response = [];
            $response['result'] = 'error';
            $response['html'] = view('common.error_alert', ['error_messages' => $validator->errors()->all()])->render();
            return response()->json($response);
        }

        $validated = $validator->validated();

        //注文登録
        $Order = new Order();
        $Order->customer_id = session('customer')['id'];
        $Order->postcode = $validated['postcode'];
        $Order->prefecture = $validated['prefecture'];
        $Order->municipality = $validated['municipality'];
        $Order->address = $validated['address'];
        $Order->building = $validated['building'];
        $Order->delivery_date = $validated['delivery_date'];
        $Order->save();

        //注文明細登録
        $OrderDetail = new OrderDetail();
        $OrderDetail->order_id = $Order->id;
        $OrderDetail->product_id = $validated['product_id'];
        $OrderDetail->save();

        $response = [];
        $response['result'] = 'success';
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
