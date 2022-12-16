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
                            <span>Admin</span>
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
                    <div class="shoping__checkout my-0 py-1">
                        <div class="d-flex justify-content-between">
                            <h5 class="my-3">User Profile</h5>
                            <h5 class="m-0 font-weight-normal d-flex align-items-center">
                                {{$data['histori_produk']['user']['name']}}</h5>
                        </div>
                        <ul class="mb-2">
                            <li class="font-weight-normal my-0 pb-1">Email <p class="my-0">
                                    {{$data['histori_produk']['user']['email']}}</p>
                            </li>
                            <li class="font-weight-normal my-0 py-1">Phone Number <p class="my-0">
                                    {{$data['histori_produk']['user']['no_telp_user']}}</p>
                            </li>
                            <li class="font-weight-normal my-0 py-1 wrap-long-text">
                                Address
                                <p class="my-0">
                                    {{$data['histori_produk']['alamat_dikirim']}}
                                </p>
                            </li>
                            @if($data['histori_produk']['status_transaksi'] == 1)
                            <li class="font-weight-normal my-0 pt-3 pb-1" id="get-user-location-li">
                                <a href="#" class="primary-btn" id="get-user-location">User Location</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout my-0 py-1">
                        <div class="d-flex justify-content-between">
                            <h5 class="my-3">
                                Invoice ({{$data['histori_produk']['metode_transaksi']}})</h5>
                            <h5 class="m-0 font-weight-normal d-flex align-items-center" style="text-align: right;">
                                {{$data['histori_produk']['updated_at']->translatedFormat('d F
                                    Y h:m')}}
                            </h5>
                        </div>
                        <ul>
                            <ul class="my-2">
                                <li class="font-weight-normal">Subtotal <span>Rp
                                        {{$data['histori_produk']['total_transaksi'] - $data['ongkir']}}</span>
                                </li>
                            </ul>
                            <li class="font-weight-normal my-2">Ongkir <span>Rp
                                    {{$data['ongkir']}}</span>
                            </li>
                            <li class="mt-2">Total <span>Rp
                                    {{$data['histori_produk']['total_transaksi']}}</span>
                            </li>
                            @if($data['histori_produk']['status_transaksi'] == 1)
                            <input type="hidden" class="input-column" name="id_transaksi"
                                value="{{$data['histori_produk']['id_transaksi']}}">
                            <a href="#" class="primary-btn" id="change-status-done">Done</a>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
    </section>
    <!-- Shoping Cart Section End -->
</div>
@endsection

@push('script')
<script src="{{asset('js/admin.js')}}"></script>
@endpush