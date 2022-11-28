<form enctype="multipart/form-data">
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title">{{ __('Create New Product') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="icon_close"></span>
                    </button>
                </div>
                <form id="form-create-product">
                    <div class="modal-body">
                        <div class="checkout__input alert alert-danger print-error-msg" style="display:none">
                            <ul style="list-style-type: none;"></ul>
                        </div>
                        <div class="checkout__input mb-2">
                            <p class="my-0">Product Name<span>*</span></p>
                            <input class="input-column" placeholder="Product Name" type="text" name="nama" required>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="checkout__input mb-2">
                                    <p class="my-0">Price<span>*</span></p>
                                    <input class="input-column" placeholder="Price" name="price" type="number" min="1"
                                        required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="checkout__input mb-2">
                                    <p class="my-0">Weight (gr)<span>*</span></p>
                                    <input class="input-column" placeholder="Weight" name="berat" type="number" min="1"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="checkout__input mb-2">
                                    <p class="my-0">Stock<span>*</span></p>
                                    <input class="input-column" placeholder="Stock" name="stok" type="number" min="1"
                                        required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="checkout__input mb-2">
                                    <p class="my-0">Category<span>*</span></p>
                                    <select id="input-column-select" class="select2" name="kategori" required>
                                        <option value="" disabled selected hidden>
                                            Choose Category
                                        </option>
                                        @foreach ($data['kategori'] as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input mb-0">
                            <p class="my-0">Description<span>*</span></p>
                            <textarea class="input-column" id="deskripsi" name="deskripsi" rows="3" class="col-12"
                                placeholder="Description" required>{{old('description')}}</textarea>
                        </div>
                        <div class="checkout__input mb-2">
                            <p class="my-0">Image<span>*</span></p>
                            <input type="file" name="image" id="input-column-image"
                                accept="image/png, image/jpg, image/jpeg" class="form-control">
                        </div>
                        <div class="checkout__input">
                            <button type="button" class="btn btn-outline-danger"
                                data-dismiss="modal">{{ __('Back') }}</button>
                            <button type="submit" id="create-product-button"
                                class="btn btn-outline-success">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>
Footer
© 2022 GitHub, Inc.