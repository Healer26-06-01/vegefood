<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Client;
use App\Order;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

class ClientController extends Controller
{
    public function home()
    {
        $products = Product::get();
        $sliders = Slider::get();
        return view('client.home')->with('sliders', $sliders)->with('products', $products);
    }

    public function shop()
    {
        $categories = Category::get();
        $products = Product::get();
        return view('client.shop')->with('products', $products)->with('categories', $categories);
    }

    public function view_by_cat($name)
    {
        $categories = Category::get();
        $products = Product::where('product_category', $name)->get();
        return view('client.shop')->with('products', $products)->with('categories', $categories);
    }

    public function cart()
    {
        if (!Session::has('cart')) {
            return view('client.cart');
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);

    }

    public function add_to_cart($id)
    {
        $product = DB::table('products')
            ->where('id', $id)
            ->first();

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        //(Session::get('cart'));
        return redirect::to('/shop');
    }

    public function updateQty(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQty($request->id, $request->quantity);
        Session::put('cart', $cart);

        return redirect::to('/cart');
    }

    public function removeitem($product_id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($product_id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect::to('/cart');
    }

    public function checkout()
    {
        if (!Session::has('cart')) {
            return redirect('/cart');
        }
        return view('client.checkout');
    }

    public function postcheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect::to('/cart');
            // , ['Products' => null]
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_gHGtV3Z6vh4jCV25BRju3hCv
        ');
        try {
            Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtainded with Stripe.js
                "description" => "Test Charge",
            ));

            $order = new Order();
            $order->name = $request->input('name');
            $order->address = $request->input('address');
            $order->cart = serialize($cart);
            $order->payment_id = $charge->id;

            $order->save();

        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
            return redirect('/checkout');
        }

        Session::forget('cart');
        return redirect('/cart')->with('success', 'Successfully purchased products!');

    }

    public function client_login()
    {
        return view('client.login');
    }

    public function client_signup()
    {
        return view('client.signup');
    }

    public function createaccount(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:clients',
            'password' => 'required|min:4',
        ]);

        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));

        $client->save();

        return back()->with('status', 'Account created successfully!');
    }

    public function accessaccount(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $client = Client::where('email', $request->input('email'))->first();

        if ($client && password_verify($request->input('password'), $client->password)) {
            Session::put('client', $client);
            return redirect('/shop');
        } else {
            return back()->with('status', 'Invalid login details!');
        }
    }

    public function client_logout()
    {
        Session::forget('client');
        return redirect('/shop');
    }

}
