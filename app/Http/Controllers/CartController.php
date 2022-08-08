<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
// use App\Http\Requests\StoreCartRequest;
use Illuminate\Http\Request;
// use App\Http\Requests\UpdateCartRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            //GET
            if (Auth::check()) {
            $cartItems = Cart::orderBy('carts.id', 'ASC')->where('user_id', Auth::user()->id)->join('users', 'carts.user_id', '=', 'users.id')->join('products', 'carts.product_id', '=', 'products.id')->get([ 'products.*','carts.id','carts.sub_total', 'carts.quantity']);
            $subtotal = Cart::where('user_id', Auth::user()->id)->pluck('sub_total')->sum();
            return response()->json([
                'status' => 200,
                'cartItems' => $cartItems,
                'subtotal' => $subtotal,
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'You must login to see this page',
            ]);
        }
        } catch (ModelNotFoundException $exception) {
            return response()->json(['errors' => $exception->getMessage()]);
        };
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return Auth::user()->id;
        try {
            //POST
            if (Auth::check()) {

                if ($cart = Cart::where('user_id', Auth::user()->id)->Where('product_id', $request->product_id)->first()) {
                    $cart->quantity =  $cart->quantity + $request->quantity;
                    // $cart->sub_total = $cart->sub_total + (($request->quantity) * ($request->product_price));
                    $cart->update();
                    return response()->json([
                        'status' => 200,
                        'cartItem' => $cart,
                    ]);
                } else {
                    $cart = new Cart();
                    $cart->user_id =  Auth::user()->id;
                    $cart->product_id = $request->product_id;
                    $cart->quantity = $request->quantity;
                    $cart->sub_total = 1000;
                    $cart->save();
                    return response()->json([
                        'status' => 200,
                        'cartItem' => $cart,
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'You must login to purchase this product',
                ]);
            }
        } catch (ModelNotFoundException $exception) {
            return response()->json(['errors' => $exception->getMessage()]);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        try{
        //PUT

        $cart->quantity =  $request->quantity;
        // $cart->sub_total = (($request->quantity) * ($request->product_price));
        $cart->update();
        return response()->json([
            'status' => 200,
            'cartItem' => $cart,
        ]);

    } catch (ModelNotFoundException $exception) {
        return response()->json(['errors' => $exception->getMessage()]);
    };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //DELETE
        try {
            $removedItem = $cart;
            // Carts::destroy($id);
            $cart->delete($cart);
            return response()->json([
                'status' => 200,
                'cartItem' => $removedItem,
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['errors' => $exception->getMessage()]);
        };


    }






}
