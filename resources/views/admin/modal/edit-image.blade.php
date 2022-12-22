<div class="modal fade text-left" id="EditImage" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title">{{ __('Edit Image') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="icon_close"></span>
                </button>
            </div>
            <form id="add-image-form">
                <div class="modal-body px-4">
                    <div class="checkout__input alert alert-danger print-error-msg" style="display:none">
                        <ul style="list-style-type: none;"></ul>
                    </div>
                    <div class="checkout__input mb-2">
                        <p class="my-0">Add Image<span>*</span></p>
                        <div class="row pl-3">
                            <input type="hidden" value="{{$data['barang']->id_barang}}" name="id_barang">
                            <input type="file" name="image" id="input-column-image"
                                accept="image/png, image/jpg, image/jpeg" class="form-control col-6">
                            &nbsp <button id="add-image" class="site-btn py-2 rounded ">Add
                                Image
                            </button>
                        </div>
                    </div>
                    <div class="checkout__input mt-2 border px-2">
                        <p class="my-0">Other Image<span>*</span></p>
                        <div id="image-container" class="row">
                            @foreach($data['gambar_lain'] as $produk)
                            <div class="col-lg-2 col-sm-3 col-4 mb-2" style="height:100px;">
                                <div class="featured__item">
                                    <a href="#" id="change-main-image" data-id-gb="{{$produk->id_gambar_barang}}"
                                        data-id-barang="{{$data['barang']->id_barang}}">
                                        <div id="gambar-barang-{{$produk->id_gambar_barang}}"
                                            class="featured__item__pic set-bg" style="width: 100px; height:100px;"
                                            data-setbg="{{asset($produk->gambar_barang)}}">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="checkout__input mb-2">
                        <button id="delete-change-toogle-button" type="button" class="site-btn bg-primary py-2 rounded"
                            data-mode="change">Change Mode</button>
                        <span id="image-instruction">Tap other image to make it main image</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>