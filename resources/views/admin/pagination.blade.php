<div class="row">
    <div class="col-lg-12">
        <div class="shoping__cart__table">
            <table>
                <thead>
                    <tr>
                        <th class="shoping__product col-7">Product</th>
                        <th>Stok</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data['produk'] as $produk)
                    <tr>
                        <td class="shoping__cart__item__d py-0">
                            <img src="{{asset($produk->gambar_barang)}}" width="90px" alt="">
                        </td>
                        <td class="shoping__cart__quantity__d py-0">
                            <span>
                                {{ $produk->stok_barang }}
                            </span>
                        </td>
                        <td class="shoping__cart__total py-0">
                            <span>
                                Rp
                                {{ $produk->harga_barang }}
                            </span>
                        </td>
                        <td class="shoping__cart__item__close py-0">
                            <form action="#">
                                @csrf
                                <input type="hidden" name="id" value="{{$produk->id_barang}}">
                                <a href="#" onClick="event.preventDefault(); $(this).closest('form').submit();">
                                    <span class="icon_grid-2x2"></span>
                                </a>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="shoping__cart__item">
                            <h5>Barang Empty!</h5>
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