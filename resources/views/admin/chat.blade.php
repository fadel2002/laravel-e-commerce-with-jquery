@extends('layouts.master')

@section('content')
<div>
    <input type="hidden" id="tipe-user" value="{{ auth()->user()->tipe_user }}">
    <input type="hidden" id="old-user-id" value="">
    <input type="hidden" id="old-room-id" value="">
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
            <div class="inbox_msg border-bottom ">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Recent</h4>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        @forelse($data['transaksis'] as $transaksi)
                        <a href="#" class="chat_list d-block user" data-id="{{$transaksi['user']['id_user']}}">
                            <div class="chat_people">
                                <div class="chat_ib">
                                    <h5>{{$transaksi['user']['name']}} {{$transaksi['user']['id_user']}}<span
                                            class="chat_date">{{$transaksi['updated_at']->translatedFormat('d F')}}</span>
                                    </h5>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="chat_list d-block">
                            <div class="chat_people">
                                <div class="chat_ib">
                                    <h5 class="text-center">No Order</h5>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="mesgs">
                    <div id="msg_history" class="msg_history">

                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <input type="text" id="write_msg" class="write_msg" placeholder="Type a message" />
                            <button id="msg_send_btn" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o"
                                    aria-hidden="true"></i></button>
                        </div>
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