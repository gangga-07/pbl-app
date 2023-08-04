<!DOCTYPE html>
<html>

<head>
    <title>Konfirmasi Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
        }

        /* Responsive table styles */
        table {
            width: 100%;
            max-width: 600px;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
        }

        table th {
            background-color: #eee;
        }

        /* Media query for smaller screens */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100%;
                border: none;
            }

            table {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Pesanan Produk Anda telah dikonfirmasi!</h1>
        </div>
        <div class="content">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <td>
                                    <h4>
                                        <span class="">PBL-STORE</span>
                                    </h4>
                                    <td>
                                        <div class="text-right">
                                            <b>Invoice</b> <br>
                                            <b>Inv-{{ $order->id }}-PBL</b><br>
                                            {{ $order->status }}
                                        </div>
                                    </td>
                                </td>
                                <td class="text-right">
                                    <strong>Date: {{ date('l, d F Y', strtotime($order->tanggal)) }}</strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br><br>
                <div class="row invoice-info">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <td>
                                    <div class="">
                                        From
                                        <address>
                                            <strong>PBL-STORE</strong><br>
                                            Email: pblstore@pnb.ac.id
                                        </address>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        To
                                        <address>
                                            <strong class="billing_name">{{ $order->pembeli }}</strong><br>
                                            Phone: {{ $order->no_tlp }}<br>
                                            Email: {{ $order->email }}
                                        </address>
                                    </div>
                                </td>
                             
                            </tr>
                        </table>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Product</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td class="text-right">Rp. {{ $order->price }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">Sub Total</td>
                                    <td class="text-right"><strong>Rp. {{ $order->price }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">Total Payable</td>
                                    <td class="text-right"><strong>Rp. {{ $order->price }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <br><br><br>
                <div>
                    download product here
                </div>
                <div>
                    <small><small>NOTE: This is system generate invoice no need of signature</small></small>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>Salam hormat,</p>
            <p>PBL-STORE</p>
        </div>
    </div>
</body>

</html>
