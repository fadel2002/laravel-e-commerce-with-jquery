@extends('layouts.master')

@section('content')
<div>
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
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

    <!-- Admin Section Begin -->
    <section class="shoping-cart spad">
        <div class="container" id="table_data_admin_produk">
            @include('admin.pagination')
        </div>
    </section>
    <!-- Admin Section End -->
</div>
@endsection

@push('script')
<script src="{{asset('js/admin.js')}}"></script>
@endpush