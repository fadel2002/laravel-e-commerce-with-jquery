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
                <form>
                    <div class="row">
                        @csrf
                        <div class="col-lg-8 col-md-6">
                            <div class="alert alert-danger" style="display:none"></div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <textarea class="input-column" id="address" name="address" rows="3" class="col-12"
                                    placeholder="Street Address">{{old('address')}}</textarea>
                            </div>
                            <div class="checkout__input">
                                <p>Metode Pembayaran<span>*</span></p>
                                <div class="row">
                                    <div class="checkout__input__checkbox col-6">
                                        <label for="debit">
                                            Debit
                                            <input type="radio" id="debit" class="payment input-column" name="payment"
                                                value="debit" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox col-6">
                                        <label for="paypal">
                                            Paypal
                                            <input type="radio" id="paypal" class="payment" name="payment"
                                                value="paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="checkout__input__checkbox col-6">
                                        <label for="gopay">
                                            Gopay
                                            <input type="radio" id="gopay" class="payment" name="payment" value="gopay">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox col-6">
                                        <label for="shopeePay">
                                            Shopee Pay
                                            <input type="radio" id="shopeePay" class="payment" name="payment"
                                                value="shopee_pay">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach($data['produk']['detailTransaksis'] as $produk)
                                    <li class="item-reload">{{$produk['barang']['nama_barang']}} <span>Rp
                                            {{(int)$produk['barang']['harga_barang'] * (int)$produk['kuantitas_barang']}}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal
                                    <span class="subtotal-reload">Rp {{$data['total_transaksi']}}</span><br>
                                    Ongkir<span>Rp {{$data['ongkir']}}</span>
                                </div>
                                <div class="checkout__order__total">Total
                                    <span class="total-reload">Rp
                                        {{$data['total_transaksi'] + $data['ongkir']}}</span>
                                </div>
                                <input type="hidden" class="input-column" name="subtotal"
                                    value="{{$data['total_transaksi']}}">
                                @if (!empty($data['produk']['id_transaksi']))
                                <input type="hidden" class="input-column" name="id_transaksi"
                                    value="{{ $data['produk']['id_transaksi'] }}">
                                @endif
                                <button type="submit" id="ajax-checkout-payment" class="site-btn">PLACE
                                    ORDER</button>
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

@push('script')
<script src="{{asset('js/shop.js')}}"></script>
@endpush