<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Illuminate\Support\Facades\Request;
// use App\Http\Requests\StoreOrderRequest;
// use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //POST
        try {
        //  return Auth::user()->id;
         $allCart = Cart::where('user_id',Auth::user()->id)->join('products', 'carts.product_id', '=', 'products.id')->get(['products.product_price', 'carts.*']);
        //   return ($allCart);
        $total_price = Cart::where('user_id', Auth::user()->id)->pluck('sub_total')->sum();
        //   return ($total_price);
          foreach ($allCart as $cart){
             //  dd($cart->id);
              $order = new Order();
              $order->user_id = $cart->user_id;
              $order->product_id = $cart->product_id;
              $order->product_quantity = $cart->quantity;
              $order->product_sub_total =  $cart->product_price;
             //  dd( $order->product_sub_total);
              $order->order_total_price = $total_price;
              $order->address = $request->address;
              $order->phone = $request->phone;
              $order->save();
              Cart::where('user_id',Auth::user()->id)->delete();
              return response()->json([
                'status' => 200,
                'order' => $order,
                'message' => 'You placed your order successfully.',
            ]);
          }
        } catch (ModelNotFoundException $exception) {
            return response()->json(['errors' => $exception->getMessage()]);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

}
