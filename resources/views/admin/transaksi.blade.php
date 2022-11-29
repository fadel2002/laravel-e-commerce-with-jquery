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

    <!-- History Section Begin -->
    <section class="shoping-cart spad">
        <div class="container" id="table_data_transaksi_admin">
            <div class="msg_header mb-2 mx-1 pb-0 row d-flex justify-content-between align-items-center">
                <h4 class="mb-3 font_header">Transaction</h4>
                <form action="{{route('admin.export-transaksi')}}">
                    <label for="date-start">Start:</label>
                    <input id="date-start" type="date" name="start">
                    <label for="date-end">End:</label>
                    <input id="date-end" type="date" name="end">
                    <button type="submit" class="site-btn cart-btn-right mb-2 rounded">Create
                        Product</button>
                </form>
            </div>
            @include('admin.pagination')
        </div>
    </section>
    <!-- History Section End -->
</div>
@endsection

@push('script')
<script src="{{asset('js/admin.js')}}"></script>
@endpush