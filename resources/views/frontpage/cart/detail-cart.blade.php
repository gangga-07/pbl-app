<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PBL | Order-Detail</title>
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.client_key')}}"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
  <style>
    .label {
      font-weight: bold;
      display: flex;
      align-items: center;
      margin-right: 0.5em;
    }

    .pay-button {
      background-color: #0d6efd;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    .pay-button:hover {
      background-color: #0b5ed7;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center mb-4">Detail Order</h5>
            <hr>
            <div class="row mb-3">
              <div class="col-5 label">Pembeli:</div>
              <div class="col-7">{{ $order->pembeli }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-5 label">Email:</div>
              <div class="col-7">{{ $order->email }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-5 label">Telepon:</div>
              <div class="col-7">{{ $order->no_tlp }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-5 label">Alamat:</div>
              <div class="col-7">{{ auth()->user()->address }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-5 label">Tanggal Pembelian:</div>
              {{-- <div class="col-7">{{ $order->tanggal }}</div> --}}
              <div class="col-7">{{ date('d M Y', strtotime($order->tanggal)) }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-5 label">Nama Produk:</div>
              <div class="col-7">{{ $order->name }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-5 label">Harga:</div>
              <div class="col-7">Rp. {{ $order->price }}</div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <button type="submit" id="pay-button" class="pay-button w-100">Pay</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{$snapToken}}', {
        onSuccess: function(result) {
          /* You may add your own implementation here */
          alert("Payment success!");
          console.log(result);
        },
        onPending: function(result) {
          /* You may add your own implementation here */
          alert("Waiting for your payment!");
          console.log(result);
        },
        onError: function(result) {
          /* You may add your own implementation here */
          alert("Payment failed!");
          console.log(result);
        },
        onClose: function() {
          /* You may add your own implementation here */
          alert('You closed the popup without finishing the payment');
        }
      })
    });
  </script>
</body>

</html>