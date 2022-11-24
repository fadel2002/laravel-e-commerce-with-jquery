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
                            <span>History</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- History Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product col-7">Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['produk'] as $produk)
                                <tr">
                                    @php
                                    if (!is_array($produk)) {
                                    $produk = json_decode($produk);
                                    }
                                    $count = 0;
                                    @endphp
                                    <td class="shoping__cart__item__d">
                                        @foreach($produk->detail_transaksis as $item)
                                        @php
                                        $count = $count + $item->kuantitas_barang;
                                        @endphp
                                        <img src="{{asset($item->barang->gambar_barang)}}" width="90px" alt="">
                                        @endforeach
                                    </td>
                                    <td class="shoping__cart__quantity__d">
                                        <span>
                                            {{ $count }}
                                        </span>
                                    </td>
                                    <td class="shoping__cart__total">
                                        <span>
                                            Rp
                                            {{ $produk->total_transaksi }}
                                        </span>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <form action="{{route('history.detail')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$produk->id_transaksi}}">
                                            <a href="#"
                                                onClick="event.preventDefault(); $(this).closest('form').submit();">
                                                <span class="icon_grid-2x2"></span>
                                            </a>
                                        </form>
                                    </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <h5>History Empty!</h5>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- History Section End -->
</div>

@endsection