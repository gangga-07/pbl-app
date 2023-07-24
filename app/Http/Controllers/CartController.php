<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartall()
    {
        $data = [
            'title' => 'Cart All | PBL-APP',
            'cart' => Cart::latest()->paginate(10), // Menggunakan model untuk mengambil data order secara terpaginasi

        ];
        $car = Cart::all();
        return view('frontpage.cart.cart-all', $data, compact('car'));
    }

    public function showPaymentForm($id)
    {
        $data = Product::find($id);

        return view('frontpage.cart.cart', compact('data'));
    }

    // public function cart(Request $request)
    // {
    //     $data_cart = Cart::where('product_id', $request->product_id)->first();

    //     if ($data_cart == NULL) {
    //         Cart::create([
    //             'product_id' => $request->product_id,
    //             'user_id' => auth()->user()->id
    //         ]);
    //     }

    //     $data = [
    //         'title' => 'Cart List | PBL-APP',
    //         'cart' => Cart::where('user_id', auth()->user()->id)->get(),
    //         'categories' => Category::first()->get(),
    //         'products' => Product::first()->get(),
    //         'images' => Image::first()->get()
    //     ];
    //     return view('frontpage.cart.cart-list', $data);
    // }
    public function cart(Request $request)
    {
        $data_cart = Cart::where('product_id', $request->product_id)->first();

        if ($data_cart == NULL) {
            Cart::create([
                'product_id' => $request->product_id,
                'user_id' => auth()->user()->id
            ]);

            // Menambahkan pesan flash success
            return redirect()->back()->with('success', 'Item berhasil ditambahkan ke keranjang');
        }

        $data = [
            'title' => 'Cart List | PBL-APP',
            'cart' => Cart::where('user_id', auth()->user()->id)->get(),
            'categories' => Category::first()->get(),
            'products' => Product::first()->get(),
            'images' => Image::first()->get()
        ];
        return view('frontpage.cart.cart-list', $data);
    }


    public function show($productId)
    {
        // Ambil data produk berdasarkan ID
        $product = Product::findOrFail($productId);
        $data = [
            'title' => 'Product Detail | PBL-APP',
            'product' => $product
        ];

        // Tampilkan view menu detail produk dengan data produk yang ditemukan
        return view('frontpage.product.product-detail', $data, compact('product'));
    }

    public function deleteCart(Cart $cart)
    {
        // Lakukan proses penghapusan data cart di sini
        $cart->delete();

        // Kirim respon JSON atau sesuai kebutuhan Anda
        if ($cart->delete()) {
            return redirect()->route('manage_cart.delete')->with('error', 'Error Occured, Please Try Again!');
        }
        return redirect()->back()->with('success', 'The Cartlist Successfully Deleted');
    }

    // FUNGSI UNTUK MENGHITUNG JUMLAH CART YANG ADA DI DATABASE (CART-CONTROLLER, HEADER(AJAX), ROUTE)
    public function getCartQty()
    {
        $cartQty = Cart::count(); // Gantikan Cart dengan model yang sesuai

        return $cartQty;
    }
}
