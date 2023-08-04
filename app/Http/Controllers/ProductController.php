<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// class ProductController extends Controller
// {
//     public function index()
//     {
//         $data = [
//             'title' => 'Products | PBL-APP',
//             'categories' => Category::latest()->filter(request(['search'])),
//         ];
//         return view('dashboard.admin.products.product', compact('data'));
//     }
// }

class ProductController extends Controller
{
    public function allProduct()
    {
        $data = [
            'title' => 'Products | PBL-APP',
            // 'products' => Product::latest()->filter(request(['search', 'category']))->paginate(10),
            // 'categories' => Category::latest()->get(),
        ];

        $product = Product::latest()->filter(request(['search', 'category']))->paginate(10);
        $cat = Category::latest()->get();

        return view('dashboard.admin.products.product-all', $data, compact('product', 'cat'));
    }

    // public function createProduct()
    // {
    //     $data = [
    //         'title' => 'Add New Products | PBL-APP',
    //         // 'categories' => Category::latest()->get(),
    //     ];
    //     $cat = Category::all();
    //     return view('dashboard.admin.products.product-add', $data, compact('cat'));
    // }

    public function createProduct()
    {
        $data = [
            'title' => 'Add New Products | PBL-APP',
            'categories' => Category::latest()->get()
        ];
        return view('dashboard.admin.products.product-add', $data);
    }

    public function detailProduct(Product $product)
    {
        $data = [
            'title' => 'Product Detail | PBL-APP',
            'product' => $product
        ];
        return view('dashboard.admin.products.product-detail', $data);
    }

    public function updateProduct(Product $product)
    {
        $data = [
            'title' => 'Update Products | PBL-APP',
            'product' => $product,
            'categories' => Category::latest()->get()
        ];
        return view('dashboard.admin.products.product-update', $data);
    }
    public function storeProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'product_code' => 'required|string|unique:products,product_code',
            'category_id' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'youtube_url' => 'required|string',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        $created_product = Product::create([
            'name' => $validated['name'],
            'product_code' => $validated['product_code'],
            'category_id' => $validated['category_id'] == 0 ? NULL : $validated['category_id'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'youtube_url' => $validated['youtube_url'],
            'description' => $validated['description'],
        ]);
        if ($created_product) {
            return redirect()->route('manage_product.all')->with('success', 'New Product Successfully Added');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again');
    }

    public function patchProduct(Product $product, Request $request)
    {
        if ($request->product_code != $product->product_code) {
            if (Product::where('product_code', $product->product_code)->whereNot('id', $product->id)->count()) {
                return redirect()->back()->withInput()->with('error', 'This product has been registered, please input another product');
            } else {
                $code_validator = Validator::make($request->all(), [
                    'product_code' => 'required|string|unique:products,product_code',
                ]);

                if ($code_validator->fails()) {
                    return redirect()->back()->withErrors($code_validator)->withInput()->with('error', 'OPPS! <br> An Error Occurred During Updating!');
                }

                $validated_code = $code_validator->validate();
                $product->update(['product_code' => $validated_code['product_code']]);
            }
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'youtube_url' => 'required|string',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        $product->touch();
        $updated_product = $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'] == 0 ? NULL : $validated['category_id'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'youtube_url' => $validated['youtube_url'],
            'description' => $validated['description'],
        ]);
        if ($updated_product) {
            return redirect()->route('manage_product.all')->with('success', 'New Product Successfully Updated');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again');
    }

    public function deleteProduct(Product $product)
    {
        if ($product->delete()) {
            return redirect()->route('manage_product.all')->with('success', 'This Product Successfully Deleted');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }
}
