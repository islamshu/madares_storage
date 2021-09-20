<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        return view('admin.cart_summary');
    }
    public function addToCart(Request $request)
    {
        $id = $request->product_id;
        
        $product = Product::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                
                "name" => $product->name,
                "quantity" => 1,
                'note'=>'',
                "price" => $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);
        $count =  count((array) session('cart'));

        $resoponse = array(
            'count'=> $count ,
            );
        return $resoponse;
        }
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function update_note(Request $request)
    {
        // dd($request->note);
        if($request->id && $request->note){
            $cart = session()->get('cart');
            $cart[$request->id]["note"] = $request->note;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function updateNavCart(Request $request)
    {
        return view('admin.partials._cart');
    }
}
