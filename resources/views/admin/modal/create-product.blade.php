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
                <div class="modal-body">
                    <div class="checkout__input mb-2">
                        <p class="my-0">Product Name<span>*</span></p>
                        <input class="input-column" placeholder="Product Name" type="text" name="nama">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="checkout__input mb-2">
                                <p class="my-0">Price<span>*</span></p>
                                <input class="input-column" placeholder="Price" name="price" type="number" min="1">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="checkout__input mb-2">
                                <p class="my-0">Weight (gr)<span>*</span></p>
                                <input class="input-column" placeholder="Weight" name="weight" type="number" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="checkout__input mb-2">
                                <p class="my-0">Stock<span>*</span></p>
                                <input class="input-column" placeholder="Stock" name="stock" type="number" min="1">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="checkout__input mb-2">
                                <p class="my-0">Category<span>*</span></p>
                                <select class="select2 input-column" name="kategori" required>
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
                    <div class="checkout__input mb-2">
                        <p class="my-0">Description<span>*</span></p>
                        <textarea class="input-column" id="description" name="description" rows="3" class="col-12"
                            placeholder="Description">{{old('description')}}</textarea>
                    </div>
                    <div class="checkout__input">
                        <button type="button" class="btn btn-outline-danger"
                            data-dismiss="modal">{{ __('Back') }}</button>
                        <button type="submit" id="create-product-button"
                            class="btn btn-outline-success">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
Footer
© 2022 GitHub, Inc.