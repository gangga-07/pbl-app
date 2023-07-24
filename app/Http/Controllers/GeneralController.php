<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    public function main()
    {
        $product = Product::all();
        $data = [
            'title' => 'Homepage | PBL-APP',
            'products' => Product::first()->get(),
            'categories' => Category::first()->get()
        ];
        // dd($data->toArray());
        return view('frontpage.index-template', $data, compact('product'));
    }
    public function category(Category $category)
    {
        $category = Category::all();
        $data = [
            'title' => 'Category | PBL-APP',
            // 'products' => $category->products,
            'name' => $category,
            'categories' => Category::first()->get()
        ];
        return view('frontpage.category.category', $data);
    }
    // public function product_detail()
    // {
    //     // $product = ('product');
    //     $product = Product::all();
    //     $details = Product::all();

    //     $data = [
    //         'title' => 'Homepage | PBL-APP',
    //         // 'product' => $product
    //         'products' => Product::first()->get(),
    //         // 'details' => Product::first()->get()
    //         // 'categories' => Category::first()->get()
    //     ];
    //     // dd($data->toArray());
    //     return view('frontpage.product.product-detail', $data, compact('product', 'details'));
    // }
    public function product_detail(Product $product)
    {
        $detail = Product::all()->first();
        $data = [
            'title' => 'Product Detail | PBL-APP',
            'product' => $product
        ];
        return view('frontpage.product.product-detail', $data, compact('product'));
    }

    public function product_all()
    {
        $product = Product::all();
        $data = [
            'title' => 'Product All | PBL-APP',
            // 'products' => Product::first()->get(),
            'categories' => Category::first()->get()
        ];
        // dd($data->toArray());
        return view('frontpage.product.product-all', $data, compact('product'));
    }
    public function ecommerce_cat()
    {
        $product = Product::where('category_id', 1)->get();
        $data = [
            'title' => 'E-Commerce Website Category | PBL-APP',
            'products' => Product::first()->get(),
            'categories' => Category::first()->get()
        ];
        // dd($data->toArray());
        return view('frontpage.category.e-commerces', $data, compact('product'));
    }
    public function business_cat()
    {
        $product = Product::where('category_id', 2)->get();
        $data = [
            'title' => 'Business Website Category | PBL-APP',
            'products' => Product::first()->get(),
            'categories' => Category::first()->get()
        ];
        // dd($data->toArray());
        return view('frontpage.category.business', $data, compact('product'));
    }

    public function checkout(Request $request)
    {

        if ($request->isMethod('GET')) {
            $cart = Cart::where('user_id', auth()->user()->id)->get();
            $data = [
                'title' => 'Check Out | Urban Adventure',
                'isUser' => auth()->user(),
                'weight' => 0,
                // 'brands' => Brand::with(['products'])->latest()->get(),
                'categories' => Category::first()->get(),
                'cart' => Product::whereIn('product_code', $cart->map(function ($item) {
                    return $item->product_id;
                }))->get()->each(function ($item, $index) use ($cart) {
                    $item->amount = $cart->where('product_id', $item->product_code)->where('user_id', auth()->user()->id)->first()->amount;
                })
            ];

            foreach ($data['cart'] as $item) {
                $data['weight'] += ($item->weight * 1000);
            }
            return view('frontpage.cart.checkout', $data);
        }
        if ($request->isMethod('POST')) {
            $product = Product::whereIn('product_code', request()->product_code)->get();
            $data = [
                'title' => 'Check Out | Urban Adventure',
                'isUser' => auth()->user(),
                'weight' => 0,
                // 'brands' => Brand::with(['products'])->latest()->get(),
                'categories' => Category::first()->get(),
                'cart' => $product->each(function ($item, $index) {
                    $item->amount = (request()->cart[$index]["quantity"] > $item->stock ? $item->stock : request()->cart[$index]["quantity"]);
                })
            ];

            foreach ($data['cart'] as $item) {
                $data['weight'] += ($item->weight * 1000);
            }
            return view('frontpage.cart.checkout', $data);
        }
    }

    public function execute_order(Request $request)
    {
        // local function
        function countGrossAmount($array = [], $shipping_cost, $starting_value = 0)
        {
            $starting_value = 0;
            foreach ($array as $index => $item) {
                $starting_value += $item['price'] * $item['quantity'];
            }
            return $starting_value + $shipping_cost;
        }
        // local function
        $validator = Validator::make($request->all(), [
            'weight' => 'required|numeric|min:1',
            'customer.name' => 'required|string',
            'customer.id' => 'required|numeric',
            'customer.fullname' => 'required|string',
            'customer.email' => 'required|email:dns',
            'customer.phone' => 'required|numeric',
            'customer.address' => 'required|string',
            'destination.province_id' => 'required|numeric',
            'destination.city_id' => 'required|numeric',
            'cart.*.name' => 'required|string',
            'cart.*.id' => 'required|string',
            'cart.*.quantity' => 'required|numeric|min:1',
            'cart.*.price' => 'required|numeric',
            'shipping.cost' => 'required|numeric',
            'shipping.province' => 'required|string',
            'shipping.city' => 'required|string',
            'comments' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', "Order Can't Execute, Try Again!");
        }
        $validated = $validator->validated();

        // preparing data for snaptoken
        $transaction_details = [
            'order_id' => Str::random(12),
            'gross_amount' => countGrossAmount($validated['cart'], $validated['shipping']['cost'])
        ];

        $item_details = $validated['cart'];
        // check avaiavility stock
        foreach ($item_details as $key => $item) {
            $product = Product::find($item['id']);
            if ($product->stock < request()->cart[$key]['quantity']) {
                if ($product->stock < 1) {
                    return redirect()->route('checkout')->with('error', 'Product ' . $product->name . "Out Of Stock!");
                }
                return redirect()->route('checkout')->with('error', "You Order " . $product->name . " Too Much!");
            }
        }
        array_push($item_details, [
            'name' => 'Delivery Service JNE',
            'quantity' => 1,
            'id' => 'JNE',
            'price' => $validated['shipping']['cost']
        ]);

        $customer_details = $validated['customer'];
        $shipping_address = [
            "name" => $validated['customer']['name'],
            "email" =>  $validated['customer']['email'],
            "phone" =>  $validated['customer']['phone'],
            "address" =>  $validated['customer']['address'],
            "province" => $validated['shipping']['province'],
            "city" => $validated['shipping']['city'],
            "cost" => $validated['shipping']['cost']
        ];
        // preparing data for snaptoken

        // sending to view
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        $data = [
            'title' => "Prepare To Order",
            'isUser' => auth()->user(),
            'weight' => 0,
            // 'brands' => Brand::with(['products'])->latest()->get(),
            // 'snap' => SnapToken::claim($transaction_details, $customer_details, $item_details, $shipping_address),
            'categories' => Category::first()->get(),
            'shipping' => $shipping_address,
            'transaction' => $transaction_details,
            'comments' => $validated['comments'],
            'cart' => Product::whereIn('product_code', $cart->map(function ($item) {
                return $item->product_id;
            }))->get()->each(function ($item, $index) use ($cart) {
                $item->amount = $cart->where('product_id', $item->product_code)->where('user_id', auth()->user()->id)->first()->amount;
            })
        ];
        // sending to view

        // create order before show the page
        // $order = Order::generate($customer_details, $shipping_address, $item_details, $transaction_details);
        // create order before show the page

        // return $order;

        // return redirect()->route('order_detail', ['order' => $order]);
    }
}
