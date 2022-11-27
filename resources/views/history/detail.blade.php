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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['histori_produk']['detailTransaksis'] as $produk)
                                <tr>
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
                                        {{$produk['kuantitas_barang']}}
                                    </td>
                                    <td class="shoping__cart__total">
                                        <span id="span-transaksi-per-data-{{ $loop->index }}">
                                            Rp {{ $produk['barang']['harga_barang'] * $produk['kuantitas_barang']  }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout mt-0">
                        <h5 class="font-weight-normal my-3">{{$data['histori_produk']['created_at']->translatedFormat('d F
                            Y h:m')}}</h5>
                        <h5>Purchase Total</h5>
                        <ul>
                            <ul class="my-2">

                                <li class="font-weight-normal">Subtotal <span>Rp
                                        {{$data['histori_produk']['total_transaksi'] - $data['ongkir']}}</span>
                                </li>
                            </ul>
                            <li class="font-weight-normal my-2">Ongkir <span>Rp
                                    {{$data['ongkir']}}</span>
                            </li>
                            <li class="my-2">Total <span>Rp
                                    {{$data['histori_produk']['total_transaksi']}}</span>
                            </li>
                        </ul>
                        <a href="{{route('shop.index')}}" class="primary-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
            </div>
    </section>
    <!-- Shoping Cart Section End -->
</div>
@endsection