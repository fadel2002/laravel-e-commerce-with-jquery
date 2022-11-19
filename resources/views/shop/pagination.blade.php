<div class="filter__item">
    <div class="row">
        <div class="col-lg col-md">
            <div class="filter__found">
                <h6><span>{{count($data['produk'])}}</span> Products found</h6>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @forelse ($data['produk'] as $produk)
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" style="background-image: url('{{asset($produk->gambar_barang)}}');"
                data-setbg="{{asset($produk->gambar_barang)}}">
                <ul class="product__item__pic__hover">
                    <li>
                        <a href="#"><i class="fa fa-heart"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-retweet"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-shopping-cart"></i></a>
                    </li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="./shop/detail/{{$produk->id_barang}}">{{$produk->nama_barang}}</a></h6>
                <h5>Rp {{$produk->harga_barang}}</h5>
            </div>
        </div>
    </div>
    @empty

    @endforelse

</div>
{!! $data['produk']->links() !!}