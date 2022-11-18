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
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Category</h4>
                            <ul>
                                <form class="my-2" action="{{route('select-categories')}}">
                                    @csrf
                                    <input type="hidden" name="kategori" value="*">
                                    <li><button style="border: none; background-color: white">All</button></li>
                                </form>
                                @foreach($data['kategori'] as $kategori)
                                <form class="my-2" action="{{route('select-categories')}}">
                                    @csrf
                                    <input type="hidden" name="kategori" value="{{$kategori}}">
                                    <li><button style="border: none; background-color: white">{{ $kategori }}</button>
                                    </li>

                                </form>
                                @endforeach
                                @error('kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach ($data['produk_terbaru'] as $produk_terbaru)
                                        <a href="/shop/detail/{{$produk_terbaru['id']}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{asset($produk_terbaru['gambar'])}}" alt="" />
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{$produk_terbaru['nama']}}</h6>
                                                <span>Rp {{$produk_terbaru['harga']}}</span>
                                            </div>
                                        </a>
                                        @if ($loop->index == 2) @break @endif
                                        @endforeach
                                    </div>
                                    @if(count($data['produk_terbaru']) > 3)
                                    <div class="latest-prdouct__slider__item">
                                        @foreach ($data['produk_terbaru'] as $produk_terbaru)
                                        @if ($loop->index > 2)
                                        <a href="/shop/detail/{{$produk_terbaru['id']}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{asset($produk_terbaru['gambar'])}}" alt="" />
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{$produk_terbaru['nama']}}</h6>
                                                <span>Rp {{$produk_terbaru['harga']}}</span>
                                            </div>
                                        </a>
                                        @endif
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7" id="table_data_produk">
                    @include('shop.pagination')
                </div>
            </div>
    </section>
    <!-- Product Section End -->
</div>

@endsection