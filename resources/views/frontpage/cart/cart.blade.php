
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>Tampilan Form Checkout (Cart)</title>
</head>

    </html>
    <div class="res layout-1 mt-5">
        <div id="wrapper" class="wrapper-fluid banners-effect-5">
            <!-- Main Container  -->
            <form class="main-container container" action="{{ url('/detail-cart') }}" method="post">
                @csrf
             

                <div class="row">
                    <!--Middle Part Start-->
                    <div id="content" class="col-sm-12">
                        <h2 class="title">Form Checkout</h2>
                        <div class="so-onepagecheckout row">
                            <div class="col-left col-sm-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-user"></i> Your Personal Details</h4>
                                    </div>
                                    <div class="panel-body">
                                        <fieldset id="account">
                                            <div class="form-group required">
                                                <label for="" class="control-label"></label>
                                                    <input type="hidden" name="users_id" id="" value="{{ auth()->user()->name}}" class="form-control">  
                                            </div>
                                            <div class="form-group required">
                                                {{-- <label for="status_pengiriman" class="control-label">Status Pengiriman</label> --}}
                                                <input type="hidden" name="status_pengiriman" id="status_pengiriman" value="Sedang Diproses">
                                                <!-- The hidden input field above sets the default value to 'Sedang Diproses' -->
                                            </div>
                                            <div class="form-group required">
                                                <label for="" class="control-label">Full
                                                    Name</label>
                                                    <input type="text" name="pembeli" value="{{ $data->pembeli }}" id="" class="form-control" placeholder="Input Your Name" required> 
                                            </div>
                                            <div class="form-group required">
                                                <label for="" class="control-label">E-Mail</label>
                                                <input type="" name="email" id="" value="{{ $data->email }}" class="form-control" placeholder="Input Your Email" required> 
                                            </div>
                                            <div class="form-group required">
                                                <label for="" class="control-label">Telephone</label>
                                                <input type="" name="no_tlp" id="" value="{{ $data->no_tlp }}" class="form-control" placeholder="Input Your Phone" required> 
                                            </div>
                                            <div class="form-group required">
                                                <label for="" class="control-label">Date</label>
                                                <input type="date" name="tanggal" id="" class="form-control" required> 
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                {{-- <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-book"></i> Your Address</h4>
                                    </div>
                                    <div class="panel-body">
                                        <fieldset id="address" class="required">
                                            <div class="form-group required">
                                                <label for="input-payment-country" class="control-label">Province</label>
                                                <select id="input-province" class="form-control"
                                                    name="destination[province_id]" onchange="getCity(this.value)">
                                                    <option value=""> --- Please Select --- </option>

                                                </select>
                                            </div>
                                            <div class="form-group required">
                                                <label for="input-payment-zone" class="control-label">City</label>
                                                <select onchange="getCost()" name="destination[city_id]" id="input-city"
                                                    class="form-control" name="city_id">
                                                    <option value=""> --- Please Select --- </option>

                                                </select>
                                            </div>
                                            <div class="form-group required">
                                                <label for="input-payment-address-1" class="control-label">Address
                                                    1</label>
                                                <input onclick="getCost()" type="text" class="form-control"
                                                    id="input-payment-address-1" placeholder="Address.."
                                                    name="customer[address]">
                                            </div>
                                        </fieldset>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="col-right col-sm-9">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping cart
                                                </h4>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <input type="hidden" name="download_url" value="{{$data->download_url}}" id="" class="form-control">
                                                        <thead>
                                                            <tr>
                                                                {{-- <td class="text-center">Image</td> --}}
                                                                <td class="text-left">Product Name</td>
                                                                <td class="text-right">Unit Price</td>
                                                                <td class="text-right">Total</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="cart-item-list">
                                                                    <td class="text-right">
                                                                        <input type="text" name="name" value="{{ $data->name }}" id="" class="form-control"> 
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <input type="text-right" name="price" value="{{$data->price}}" id="" class="form-control">
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <input type="text" name="price" value="{{$data->price}}" id="" class="form-control">
                                                                    </td>
                                                        </tbody>
                                                        {{-- <tfoot>
                                                            <tr>
                                                                <td class="text-right" colspan="2">
                                                                    <strong>Sub-Total:</strong>
                                                                </td>
                                                                <td data-sub_total="0" id="summary-cart-subtotal"
                                                                    class="text-right">IDR 0</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right" colspan="2">
                                                                    <strong>Shipping Fee:</strong>
                                                                </td>
                                                                <td class="text-right" data-cart_shipping_fee="0"
                                                                    id="cart-shipping-fee">IDR 0</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right" colspan="2">
                                                                    <strong>Total:</strong>
                                                                </td>
                                                                <td data-total="0" id="cart-total-pay"
                                                                    class="text-right">IDR 0</td>
                                                            </tr>
                                                        </tfoot> --}}
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title"><i class="fa fa-pencil"></i> Add Comments About
                                                    Your Order</h4>
                                            </div>
                                            <div class="panel-body">
                                                <textarea rows="4" class="form-control" id="" name=""></textarea>
                                                <br>
                                                <div class="buttons">
                                                    <div class="pull-right">
                                                        <button type="submit" id="pay-button" class="btn btn-primary">Checkout</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Middle Part End -->

                </div>
            </form>
        </div>
    </div>
</body>

</html>