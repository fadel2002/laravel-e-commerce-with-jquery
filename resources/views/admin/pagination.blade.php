<div class="row">
    <div class="col-lg-12">
        <div class="shoping__cart__table">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data['produk'] as $produk)
                    <tr class="@if($produk->status_transaksi == 1) bg-light @endif">
                        @php
                        if (!is_array($produk)) {
                        $produk = json_decode($produk);
                        }
                        $count = 0;
                        @endphp
                        <td class="shoping__cart__total">
                            {{$produk->user->name}}
                        </td>
                        <td class="shoping__cart__quantity__d">
                            {{$produk->user->no_telp_user}}
                        </td>
                        <td class="shoping__cart__quantity__d">
                            {{$produk->alamat_dikirim}}
                        </td>
                        <td class="shoping__cart__quantity__d">
                            <span>
                                @if($produk->status_transaksi == 2)
                                {{ Carbon\Carbon::parse($produk->updated_at)->translatedFormat('d F Y') }}
                                @else
                                Pending
                                @endif
                            </span>
                        </td>
                        <td class="shoping__cart__quantity__d">
                            <span>
                                @foreach($produk->detail_transaksis as $item)
                                @php
                                $count = $count + $item->kuantitas_barang;
                                @endphp
                                @endforeach
                                {{ $count }}
                            </span>
                        </td>
                        <td class="shoping__cart__total">
                            <span>
                                Rp
                                {{ $produk->total_transaksi }}
                            </span>
                        </td>
                        <td class="shoping__cart__item__close pr-3">
                            <form action="{{route('admin.transaksi-detail')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$produk->id_transaksi}}">
                                <a href="#" onClick="event.preventDefault(); $(this).closest('form').submit();">
                                    <span class="icon_grid-2x2"></span>
                                </a>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="shoping__cart__item">
                            <h5>Transaksi Empty!</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        {!! $data['produk']->links() !!}
    </div>
</div>