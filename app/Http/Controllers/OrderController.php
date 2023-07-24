<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Midtrans\Snap;
use PDF;
use TCPDF;


class OrderController extends Controller
{
    public function index($id)
    {
        $data = Product::find($id);

        return view('frontpage.cart.cart', compact('data'));
    }

    public function checkout(Request $request)
    {
        // dd($request);
        // dd($request->toArray());
        $request->request->add(['status' => 'unpaid']);
        //SAMPLE REQUEST START HERE

        $order = Order::create($request->all());
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-j5fwnY8C1ORPs-NLMVvdkvd9';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $price = $order->price;
        $params = array(
            'transaction_details' => array(
                // 'order_id' => rand(),
                'order_id' => $order->id,
                'gross_amount' => '1000000',
            ),
            'customer_details' => array(
                'first_name' => $request->pembeli,
                'phone' => $request->no_tlp,
                // 'first_name' => 'budi',
                // 'last_name' => 'pratama',
                // 'email' => 'budi.pra@example.com',
                // 'phone' => '08111222333',
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('frontpage/cart.detail-cart', compact('snapToken', 'order'));
    }


    // HENDLE AFTER PEMBAYARAN
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("shaS512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Paid']);
            }
        }
    }

    // public function allOrder()
    // {
    //     $data = [
    //         'title' => 'Orders | PBL-APP',
    //         'order' => Order::latest()->get(),
    //     ];
    //     return view('dashboard.admin.orders.order-all', $data);
    // }

    public function allOrder()
    {
        $data = [
            'title' => 'All Order | PBL-APP',
            'order' => Order::latest()->paginate(10), // Menggunakan model untuk mengambil data order secara terpaginasi
        ];

        return view('dashboard.admin.orders.order-all', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order.*.product' => 'required|string',
            'order.*.amount' => 'required|numeric',
            'order.*.price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Something Error With Your Input!')->withInput()->withErrors($validator);
        }
    }

    public function delete(Order $order)
    {
        $order->delete();
        if ($order->delete()) {
            return redirect()->route('manage_order.all')->with('error', 'Error Occured, Please Try Again!');
        }
        return redirect()->back()->with('success', 'The Order Successfully Deleted');
    }

    public function detailOrder(Order $order)
    {
        $data = [
            'title' => 'Order Detail | PBL-APP',
            'order' => $order
        ];
        return view('dashboard.admin.orders.order-detail', $data);
    }

    public function patchOrder(Order $order, Request $request)
    {
        if ($request->id != $order->id) {
            if (Product::where('id', $order->id)->whereNot('id', $order->id)->count()) {
                return redirect()->back()->withInput()->with('error', 'This product has been registered, please input another product');
            } else {
                $code_validator = Validator::make($request->all(), [
                    'product_code' => 'required|string|unique:products,product_code',
                ]);

                if ($code_validator->fails()) {
                    return redirect()->back()->withErrors($code_validator)->withInput()->with('error', 'OPPS! <br> An Error Occurred During Updating!');
                }

                $validated_code = $code_validator->validate();
                $order->update(['id' => $validated_code['id']]);
            }
        }
        $validator = Validator::make($request->all(), [
            'pembeli' => 'required|string',
            'email' => 'required|integer',
            'no_tlp' => 'required|integer',
            'tanggal' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Input Failed!<br>Please Try Again With Correct Input');
        }
        $validated = $validator->validated();
        $order->touch();
        $updated_order = $order->update([
            'pembeli' => $validated['pembeli'],
            'email' => $validated['email'],
            'no_tlp' => $validated['no_tlp'],
            'tanggal' => $validated['tanggal'],
        ]);
        if ($updated_order) {
            return redirect()->route('manage_order.all')->with('success', 'New Order Successfully Updated');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again');
    }

    public function updateOrder(Order $order)
    {
        $data = [
            'title' => 'Order Update | PBL-APP',
            'order' => $order
        ];
        return view('dashboard.admin.orders.order-update', $data);
    }

    public function saveUpdate(Request $request, Order $order)
    {
        $order->pembeli = $request->input('pembeli');
        $order->name = $request->input('name');
        // Tambahkan update data lainnya sesuai dengan kebutuhan

        $order->save();

        return redirect()->route('manage_order.all')->with('success', 'Order updated successfully.');
    }

    // ---------------------------------------------------------------------------------------------------//
    //UNTUK DITAMPILAN ORDER USER --**-- UNTUK DITAMPILAN ORDER USER//
    public function myallOrder()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mengambil semua order yang memiliki users_id yang sama dengan id user yang sedang login
        $orders = Order::where('users_id', $user->name)->get();

        $data = [
            'title' => 'Orders | PBL-APP',
            'orders' => $orders,
        ];

        return view('frontpage.my-order.my-order-all', $data);
    }

    public function invoice(Order $order)
    {
        $data = [
            'title' => 'Order Detail | PBL-APP',
            'order' => $order
        ];
        return view('frontpage.my-order.invoice', $data);
    }

    public function printInvoice($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Invoice not found.');
        };

        // Mengambil isi dari file HTML invoice
        $html = view('frontpage.my-order.invoice', compact('order'))->render();

        // Membuat instance Dompdf
        $dompdf = new Dompdf();

        // Memuat HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Mengatur ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render HTML ke PDF
        $dompdf->render();

        // Menghasilkan file PDF dan mengirimkan ke browser
        $dompdf->stream('invoice.pdf', ['Attachment' => false]);
    }




    // public function softdelete(Order $order)
    // {
    //     // Pastikan bahwa order yang dihapus dimiliki oleh user yang sedang login
    //     if (Auth::user()->id === $order->users_id) {
    //         $order->delete();
    //         // Tambahkan pesan sukses atau tindakan lain yang diperlukan
    //     } else {
    //         // Tambahkan pesan error atau tindakan lain yang diperlukan karena tidak diizinkan untuk menghapus order ini
    //     }

    //     return redirect()->back();
    // }
}