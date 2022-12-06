@extends('layouts.master')

@section('content')
<div>
    <input type="hidden" id="tipe-user" value="{{ auth()->user()->tipe_user }}">
    @if($data['transaksi'] != null)
    <input type="hidden" id="admin-id" value="{{ $data['admin']['id'] }}">
    @endif
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>My Warung</h2>
                        <div class="breadcrumb__option">
                            <span>Chat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container msg my-5">
        <h4 class="msg_header">Message</h4>
        <div class="messaging">
            <div class="inbox_msg">
                <div>
                    <div id="msg_history" class="msg_history">
                    </div>
                    <div class="type_msg">
                        @if($data['transaksi'] != null)
                        <div class="input_msg_write">
                            <input type="text" id="write_msg" class="write_msg" placeholder="Type a message" />
                            <button id="msg_send_btn" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o"
                                    aria-hidden="true"></i></button>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

@endsection

@push('script')
<script src="{{asset('js/chat.js')}}"></script>
@endpush