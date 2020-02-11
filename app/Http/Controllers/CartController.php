<?php

namespace App\Http\Controllers;

use App\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product){
        // dd(auth()->id());
        // $product = Product::find($productId);

        // add the product to cart
        Cart::session(auth()->id())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        return redirect()->route('cart.index');
    }

    public function index(){

        $cartItems = Cart::session(auth()->id())->getContent();
        return view('cart.index', compact('cartItems',$cartItems));
    }

    public function destroy($itemId){

        Cart::session(auth()->id())->remove($itemId);
        return back();
    }

    public function update($itemId){
        Cart::session(auth()->id())->update($itemId, [
            'quantity' => [
                'relative' => false,
                'value' => request('quantity')
            ]
        ]);
        return back();
    }

}
