<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class WebsiteController extends Controller
{
    public function index()
    {
        $products = Product::join('categories', 'categories.id', '=', 'products.category')->select('categories.name AS cname', 'products.name AS pname', 'products.*' )->get();
        return view('front.index', compact('products'));
    }

    public function cart()
    {    
        return view('front.cart');
    }

    public function addtocart(Product $product) 
    {
        $cart = session()->get('cart');
        if( !$cart ) {
            $cart = [
                $product->id => [
                    'name' => $product->name,
                    'sale_price' => $product->sale_price,
                    'details' => $product->details,
                    'quantity' => 1,
                    'image' => $product->image,
                ]
            ];

            session()->put( 'cart', $cart );
            return redirect('/')->with('success', 'Added to Cart');
        }

        if(isset($cart[$product->id])) {
            return redirect('/')->with('error', 'Product Already in Cart');
        }

        $cart[$product->id] = [
            'name' => $product->name,
            'sale_price' => $product->sale_price,
            'details' => $product->details,
            'quantity' => 1,
            'image' => $product->image,
        ];

        session()->put( 'cart', $cart );
        return redirect('/')->with('success', 'Added to Cart');

    }

    public function update_cart($id, Request $request)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            $quantity = $request->quantity;
            $cart[$id]['quantity'] = $quantity;
            session()->put( 'cart', $cart );
            return redirect('cart')->with('success', 'Added to Cart');
        }
        
    }

    public function remove_all_in_cart(Request $request) 
    {
        $cart = session()->get('cart');
        if(isset($cart)) {
            $request->session('cart')->flush();
        }    
        return redirect()->route('cart')->with('success', 'Removed From Cart');
    }

    public function remove_product_from_cart($id) 
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }    
        return redirect()->route('cart')->with('success', 'Removed From Cart');
    }

    public function checkout(Request $request)
    {
        $product_id = $request->product_id;
        $session_id = $request->session()->getId();
        $c_user = Auth::user()->id;

        $countProducts = Cart::where('session_id', $session_id)->count();

        $productslist = Cart::join('products', 'products.id', '=', 'cart.product_id')
        ->where( 'session_id', $session_id )->select( 'products.*', 'quantity' )->get();

        return view('front.checkout', compact('productslist', 'countProducts'));

    }

    public function add_customer(Request $request)
    {
        $customer = new Customer();
        $customer->fname    = $request->fname;
        $customer->lname    = $request->lname;
        $customer->username = $request->username;
        $customer->email    = $request->email;
        $customer->address1 = $request->address1;
        $customer->address2 = $request->address2;
        $customer->country  = $request->country;
        $customer->state    = $request->state;
        $customer->zip      = $request->zip;
        $customer->save();

        return redirect()->route('site')->with('success','Customer Added Successfully');
    }

}
