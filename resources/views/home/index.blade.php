@extends('layouts.master')

@section('content')
<div>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>My Warung</h2>
                        <div class="breadcrumb__option">
                            <span>Pickup and Delivery Available</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Categories Section Begin -->
    <section class="categories mt-5">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach($data['produk_food'] as $produk)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset($produk->gambar_barang)}}">
                            <h5><a href="./shop/detail/{{$produk->id_barang}}">{{$produk->nama_barang}}</a></h5>
                        </div>
                    </div>
                    @endforeach
                    @foreach($data['produk_drink'] as $produk)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset($produk->gambar_barang)}}">
                            <h5><a href="./shop/detail/{{$produk->id_barang}}">{{$produk->nama_barang}}</a></h5>
                        </div>
                    </div>
                    @endforeach
                    @foreach($data['produk_cigar'] as $produk)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset($produk->gambar_barang)}}">
                            <h5><a href="./shop/detail/{{$produk->id_barang}}">{{$produk->nama_barang}}</a></h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach($data['kategori'] as $kategori)
                            <li data-filter=".{{ $kategori }}">{{ $kategori }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach($data['produk_food'] as $produk)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{$produk->nama_kategori}}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{asset($produk->gambar_barang)}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="./shop/detail/{{$produk->id_barang}}">{{$produk->nama_barang}}</a></h6>
                            <h5>Rp {{$produk->harga_barang}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($data['produk_drink'] as $produk)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{$produk->nama_kategori}}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{asset($produk->gambar_barang)}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="./shop/detail/{{$produk->id_barang}}">{{$produk->nama_barang}}</a></h6>
                            <h5>Rp {{$produk->harga_barang}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($data['produk_cigar'] as $produk)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{$produk->nama_kategori}}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{asset($produk->gambar_barang)}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="./shop/detail/{{$produk->id_barang}}">{{$produk->nama_barang}}</a></h6>
                            <h5>Rp {{$produk->harga_barang}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->
</div>
@endsection