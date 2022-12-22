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

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Product Detail</h4>
                <form id="detail-product-form">
                    <div class="row">
                        @csrf
                        <div class="col-lg-8 col-md-6">
                            <input class="input-column" type="hidden" name="id_barang"
                                value="{{$data['barang']['id_barang']}}">
                            <div class="checkout__input alert alert-danger print-error-msg" style="display:none">
                                <ul style="list-style-type: none;"></ul>
                            </div>
                            <div class="checkout__input mb-2">
                                <p class="my-0">Product Name<span>*</span></p>
                                <input class="input-column" placeholder="Product Name" type="text" name="nama" required
                                    value="{{$data['barang']['nama_barang']}}">
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="checkout__input mb-2">
                                        <p class="my-0">Price<span>*</span></p>
                                        <input class="input-column" placeholder="Price" name="price" type="number"
                                            min="1" required value="{{$data['barang']['harga_barang']}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="checkout__input mb-2">
                                        <p class="my-0">Weight (gr)<span>*</span></p>
                                        <input class="input-column" placeholder="Weight" name="berat" type="number"
                                            min="1" required value="{{$data['barang']['berat_barang']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="checkout__input mb-2">
                                        <p class="my-0">Stock<span>*</span></p>
                                        <input class="input-column" placeholder="Stock" name="stok" type="number"
                                            min="1" required value="{{$data['barang']['stok_barang']}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="checkout__input mb-2">
                                        <p class="my-0">Category<span>*</span></p>
                                        <select id="input-column-select" class="select2" name="kategori" required>
                                            <option value="{{$data['barang']['nama_kategori']}}" selected hidden>
                                                {{$data['barang']['nama_kategori']}}
                                            </option>
                                            @foreach ($data['kategori'] as $item)
                                            @if ($item != $data['barang']['nama_kategori'])
                                            <option value="{{$item}}">{{$item}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input mb-0">
                                <p class="my-0">Description<span>*</span></p>
                                <textarea class="input-column" id="deskripsi" name="deskripsi" rows="4" class="col-12"
                                    placeholder="Description"
                                    required>{{$data['barang']['deskripsi_barang']}}</textarea>
                            </div>
                            <div class="checkout__input mb-2">
                                <p class="my-0">Main Image<span>*</span></p>
                                <input type="file" name="image" id="input-column-image"
                                    accept="image/png, image/jpg, image/jpeg" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order mt-4 py-4">
                                <h4 class="mb-4 font-weight-normal">Image</h4>
                                <img id="product-image" src="{{asset($data['barang']['gambar_barang'])}}"
                                    alt="Product Image">
                                <button onclick="event.preventDefault()" data-toggle="modal" data-target="#EditImage"
                                    class="site-btn py-2 edit-image">Edit
                                    Image</button>
                            </div>
                            <button type="submit" id="site-btn-detail-product"
                                class="site-btn mt-4 site-btn-detail-product">UPDATE
                                PRODUCT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    @include('admin.modal.edit-image')
</div>
@endsection

@push('script')
<script src="{{asset('js/admin.js')}}"></script>
@endpush