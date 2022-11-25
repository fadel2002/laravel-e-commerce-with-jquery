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
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($data['produk']['id_transaksi']))
                                <input type="hidden" name="id_transaksi" value="{{$data['produk']['id_transaksi']}}">
                                @endif
                                @forelse($data['produk']['detailTransaksis'] as $produk)
                                <tr id="item-{{$produk['id_detail_transaksi']}}">
                                    <td class="shoping__cart__item">
                                        <a href="/shop/detail/{{$produk['barang']['id_barang']}}">
                                            <img src="{{asset($produk['barang']['gambar_barang'])}}" width="100px"
                                                alt="">
                                            <h5>{{$produk['barang']['nama_barang']}}</h5>
                                        </a>
                                    </td>
                                    <td class="shoping__cart__price">
                                        Rp {{ $produk['barang']['harga_barang'] }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="hidden" name="maxQuantity"
                                                    value="{{$produk['barang']['stok_barang']}}">
                                                <input id="{{$produk['id_detail_transaksi']}}" class="input-kuantitas"
                                                    type="text" name="kuantitas"
                                                    value="{{$produk['kuantitas_barang']}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        <span id="span-transaksi-per-data-{{ $loop->index }}">
                                            Rp {{ $produk['barang']['harga_barang'] * $produk['kuantitas_barang']  }}
                                        </span>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a id="{{$produk['id_detail_transaksi']}}" class="ajax-delete-item" href="">
                                            <span class="icon_close"></span>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="shoping__cart__item">
                                        <h5>Cart Empty!</h5>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{route('shop.index')}}" class="primary-btn btn-success cart-btn">CONTINUE SHOPPING</a>
                        <a id="ajax-update-cart" href="#" class="primary-btn cart-btn cart-btn-right"></span>
                            Update Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">

                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span id="cart-span-total-transaksi" class="span-total-transaksi">Rp
                                    {{$data['produk']['total_transaksi']}}</span>
                            </li>
                        </ul>
                        <a href="{{route('shop.checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
</div>
@endsection