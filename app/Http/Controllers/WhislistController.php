<?php

namespace App\Http\Controllers;

use App\Models\Whislist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class WhislistController extends Controller
{
    // public function whis(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'product_code' => 'required|numeric',
    //         'user_id' => 'required|numeric',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 400,
    //             'message' => 'Validation Failed!'
    //         ]);
    //     }
    //     $validated = $validator->validate();
    //     $product_on_wish = Whislist::where('user_id', $validated['user_id'])->orWhere('product_code', $validated['product_code'])->get();
    //     if ($product_on_wish->count()) {
    //         if ($product_on_wish->first()->delete()) {
    //             return response()->json([
    //                 'status' => 200,
    //                 'message' => 'Wish Product Deleted!'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => 201,
    //                 'message' => 'Something Went Wrong!'
    //             ]);
    //         }
    //     } else {
    //         if (Whislist::create([
    //             'product_code' => $validated['product_code'],
    //             'user_id' => $validated['user_id'],
    //         ])) {
    //             return response()->json([
    //                 'status' => 200,
    //                 'message' => 'Product Added To WishList!'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => 201,
    //                 'message' => 'Something Went Wrong!'
    //             ]);
    //         }
    //     }
    // }

    public function allWhislist()
    {
        $data = [
            'title' => 'Whislist | PBL-APP',
        ];
        $wish = Whislist::all();
        return view('frontpage.whislist.whislist-all', $data, compact('wish'));
    }

    public function whislist(Request $request)
    {
        $data_whislist = Whislist::where('product_id', $request->product_id)->first();

        if ($data_whislist == NULL) {
            Whislist::create([
                'product_id' => $request->product_id,
                'user_id' => auth()->user()->id
            ]);
        }

        $data = [
            'title' => 'Whislist | PBL-APP',
            'wishlist' => Whislist::where('user_id', auth()->user()->id)->get(),
            'categories' => Category::first()->get(),
        ];
        return view('frontpage.whislist.whislist', $data);
    }

    public function deleteWhislist(Whislist $whislist)
    {
        // Lakukan proses penghapusan data whislist di sini
        $whislist->delete();

        // Kirim respon JSON atau sesuai kebutuhan Anda
        if ($whislist->delete()) {
            return redirect()->route('manage_cart.delete')->with('error', 'Error Occured, Please Try Again!');
        }
        return redirect()->back()->with('success', 'The Whislist Successfully Deleted');
    }
}
