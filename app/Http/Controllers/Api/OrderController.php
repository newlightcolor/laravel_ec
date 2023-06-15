<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Rules\Postcode;

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
    public function create()
    {
        //
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
            $errors = [];
            foreach($validator->errors()->toArray() as $error){
                $errors = array_merge($errors, $error);
            }
            return response()->json($errors, 422);
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

        return response()->json(['message' => '注文が完了しました。']);
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
