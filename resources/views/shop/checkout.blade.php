@extends('layouts.master')

@section('content')
<div>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>My Warung</h2>
                        <div class="breadcrumb__option">
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>Name<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <textarea id="address" name="address" rows="3" class="col-12"
                                    placeholder="Street Address"></textarea>
                            </div>
                            <div class=" checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                            <!-- <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div> -
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text"
                                    placeholder="Alamat pengiriman, e.g. Jl. Keputih Makam Blok 1C No36 RT 26">
                            </div> -->

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach($data['produk']['detailTransaksis'] as $produk)
                                    <li>{{$produk['barang']['nama_barang']}} <span>Rp
                                            {{(int)$produk['barang']['harga_barang'] * (int)$produk['kuantitas_barang']}}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal
                                    <span>Rp {{$data['total_transaksi']}}</span><br>
                                    Ongkir<span>Rp {{$data['ongkir']}}</span>
                                </div>
                                <div class="checkout__order__total">Total <span>Rp
                                        {{$data['total_transaksi'] + $data['ongkir']}}</span>
                                </div>
                                <p>Silahkan memilih metode pembayaran</p>
                                <div class="row">
                                    <div class="checkout__input__checkbox col-6">
                                        <label for="debit">
                                            Check Payment
                                            <input type="radio" id="debit" name="payment">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox col-6">
                                        <label for="paypal">
                                            Paypal
                                            <input type="radio" id="paypal" name="payment">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="checkout__input__checkbox col-6">
                                        <label for="gopay">
                                            Gopay
                                            <input type="radio" id="gopay" name="payment">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox col-6">
                                        <label for="shopee">
                                            Shopee Pay
                                            <input type="radio" id="shopee" name="payment">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
</div>
@endsection