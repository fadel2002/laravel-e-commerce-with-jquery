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
                            <span>Detail Barang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{asset($data['produk']['gambar'])}}"
                                alt="">
                        </div>
                        @if (count($data['produk']['gambar_lain']))
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{asset($data['produk']['gambar'])}}"
                                src="{{asset($data['produk']['gambar'])}}" alt="">
                            @foreach ($data['produk']['gambar_lain'] as $gambar_lain)
                            <img data-imgbigurl="{{asset($gambar_lain['gambar'])}}"
                                src="{{asset($gambar_lain['gambar'])}}" alt="">
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$data['produk']['nama']}}</h3>
                        <div class="product__details__price">Rp {{$data['produk']['harga']}}</div>
                        <p>{{$data['produk']['deskripsi']}}</p>
                        <form>
                            @csrf
                            <input type="hidden" name="id_barang" value="{{$data['produk']['id']}}">
                            <input type="hidden" name="id_user" value="{{Auth::user()->id_user}}">
                            <input type="hidden" name="nama" value="{{$data['produk']['nama']}}">
                            <input type="hidden" name="harga" value="{{$data['produk']['harga']}}">
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="hidden" name="maxQuantity" value="{{$data['produk']['stok']}}">
                                        <input type="number" name="kuantitas"
                                            value="{{$data['produk']['kuantitas_sementara']}}" min="0"
                                            max="{{$data['produk']['stok']}}">
                                    </div>
                                </div>
                            </div>
                            <button id="ajax-add-to-cart" class="primary-btn btn text-white">UPDATE CART</button>
                        </form>
                        <ul>
                            <li><b>Availability</b> <span>{{$data['produk']['stok']}} buah</span></li>
                            <li><b>Category</b> <span>{{$data['produk']['kategori']}}</span></li>
                            <li><b>Weight</b> <span>{{$data['produk']['berat']}} gram</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($data['produk_mirip'] as $produk_mirip)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{asset($produk_mirip['gambar'])}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="/shop/detail/{{$produk_mirip['id']}}">{{$produk_mirip['nama']}}</a></h6>
                            <h5>Rp {{$produk_mirip['harga']}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
</div>

@endsection

@push('script')
<script src="{{asset('js/shop.js')}}"></script>
@endpush