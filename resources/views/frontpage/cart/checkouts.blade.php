<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontpage/link')
    {{-- <title>Document</title> --}}
</head>
<body>
    @include('frontpage/header')

    <div class="res layout-1">
        <div id="wrapper" class="wrapper-fluid banners-effect-5">
            {{-- @include('frontpage.frontpage-navbar') --}}
            <!-- Main Container  -->
            <form class="main-container container" action="{{ route('execute_order') }}" method="POST">
                @csrf
                <ul class="breadcrumb">
                    <li><a href="{{ route('main') }}"><i class="fa fa-home"></i></a></li>
                    <li>
                        <p>Form Checkout</p>
                    </li>

                </ul>

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
                                                <label for="input-payment-fullname" class="control-label">Full
                                                    Name</label>
                                                <input type="text" class="form-control" id="input-payment-fullname"
                                                    {{-- placeholder="Your Name" value="{{ $isUser->name }}" --}}
                                                    name="customer[fullname]">
                                            </div>
                                            <div class="form-group required">
                                                <label for="input-payment-email" class="control-label">E-Mail</label>
                                                <input type="text" class="form-control" id="input-payment-email"
                                                    {{-- placeholder="E-Mail" value="{{ $isUser->email }}" --}}
                                                    name="customer[email]">
                                            </div>
                                            <div class="form-group required">
                                                <label for="input-payment-telephone" class="control-label">Telephone</label>
                                                <input type="text" class="form-control" id="input-payment-telephone"
                                                    {{-- placeholder="Telephone" value="{{ $isUser->phone }}" --}}
                                                    name="customer[phone]">
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="panel panel-default">
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
                                </div>
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
                                                        <thead>
                                                            <tr>
                                                                <td class="text-center">Image</td>
                                                                <td class="text-left">Product Name</td>
                                                                <td class="text-left">Quantity</td>
                                                                <td class="text-right">Unit Price</td>
                                                                <td class="text-right">Total</td>
                                                            </tr>
                                                        </thead>
                                                        {{-- <tbody id="cart-item-list">
                                                            @foreach ($cart as $item)
                                                                <tr data-sub_total="{{ $item->price * $item->amount }}"
                                                                    data-product="{{ $item->product_code }}"
                                                                    data-price="{{ $item->price }}">
                                                                    <td class="text-center"><a href="product.html"><img
                                                                                width="60px"
                                                                                src="{{ asset($item->images->count() ? 'storage/' . $item->images->first()->src : '/image/catalog/demo/product/funiture/10.jpg') }}"
                                                                                alt="Xitefun Causal Wear Fancy Shoes"
                                                                                title="Xitefun Causal Wear Fancy Shoes"
                                                                                class="img-thumbnail"></a></td>
                                                                    <td class="text-left"><a
                                                                            href="product.html">{{ $item->name }}</a>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <div class="input-group btn-block"
                                                                            style="min-width: 100px;">
                                                                            <input type="hidden"
                                                                                name="cart[{{ $loop->index }}][name]"
                                                                                id="{{ $item->product_code }}-name"
                                                                                value="{{ $item->name }}"
                                                                                class="form-control">
                                                                            <input type="hidden"
                                                                                name="cart[{{ $loop->index }}][id]"
                                                                                id="{{ $item->product_code }}-product_code"
                                                                                value="{{ $item->product_code }}"
                                                                                class="form-control">
                                                                            <input type="text"
                                                                                name="cart[{{ $loop->index }}][quantity]"
                                                                                id="{{ $item->product_code }}-quantity"
                                                                                value="{{ $item->amount }}"
                                                                                max="{{ $item->stock }}"
                                                                                class="form-control">
                                                                            <input type="hidden"
                                                                                name="cart[{{ $loop->index }}][price]"
                                                                                id="{{ $item->product_code }}-price"
                                                                                value="{{ $item->price }}"
                                                                                class="form-control">
                                                                            <span class="input-group-btn">
                                                                                <button type="button"
                                                                                    data-toggle="tooltip" title="Update"
                                                                                    onclick="update_quantity('{{ $item->product_code }}', '{{ $isUser ? $isUser->id : 0 }}')"
                                                                                    class="btn btn-primary"><i
                                                                                        class="fa fa-refresh"></i></button>
                                                                                <button type="button"
                                                                                    data-toggle="tooltip" title="Remove"
                                                                                    class="btn btn-danger"
                                                                                    onClick=""><i
                                                                                        class="fa fa-times-circle"></i></button>
                                                                            </span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-right">{{ ch_currency($item->price) }}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        {{ ch_currency($item->price * $item->amount) }}
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td class="text-right" colspan="4">
                                                                    <strong>Sub-Total:</strong>
                                                                </td>
                                                                <td data-sub_total="0" id="summary-cart-subtotal"
                                                                    class="text-right">IDR 0</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right" colspan="4">
                                                                    <strong>Shipping Fee:</strong>
                                                                </td>
                                                                <td class="text-right" data-cart_shipping_fee="0"
                                                                    id="cart-shipping-fee">IDR 0</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right" colspan="4">
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
                                                <textarea rows="4" class="form-control" id="confirm_comment" name="comments"></textarea>
                                                <br>
                                                <label class="control-label" for="confirm_agree">
                                                    <input type="checkbox" checked="checked" value="1"
                                                        required="" class="validate required" id="confirm_agree"
                                                        name="confirm agree">
                                                    <span>I have read and agree to the <a class="agree"
                                                            href="#"><b>Terms &amp; Conditions</b></a></span>
                                                </label>
                                                <div class="buttons">
                                                    <div class="pull-right">
                                                        <button type="submit" class="btn btn-primary"
                                                            id="button-confirm">
                                                            Confirm Order</button>
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
            <!-- //Main Container -->
            {{-- @include('frontpage.frontpage-footer') --}}
        </div>
    </div>
</body>
</html>