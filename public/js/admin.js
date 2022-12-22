$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", ".pagination a", function (event) {
        event.preventDefault();
        let page = $(this).attr("href").split("page=")[1];
        fetch_data(page);
    });

    function fetch_data(page = 1) {
        $.ajax({
            type: "GET",
            url: "/admin/more-transkasi?page=" + page,
            success: function (data) {
                // console.log(data.data);
                $("#table_data_transaksi_admin").html(data);
            },
        });
    }

    $(".delete-span").on("click", ".delete-button", deleteBarangOnClick);

    function deleteBarangOnClick() {
        let $button = $(this);
        let id_barang = $button.parent().find("input[name=id_barang]").val();
        let table = $("#list-product").DataTable();
        swal({
            title: "Confirmation!",
            text: "Anda yakin menghapus barang id " + id_barang,
            type: "warning",
            showConfirmButton: true,
            showCancelButton: true,
        })
            .then(function (val) {
                if (val) delete_item(id_barang, table, $button);
            })
            .catch(function (timeout) {});
    }

    function delete_item(id_barang, table, $button) {
        $.ajax({
            type: "DELETE",
            url: "/admin/delete",
            data: {
                id_barang: id_barang,
            },
            success: function (data) {
                // console.log(data.status);
                table.row($button.parents("tr")).remove().draw();

                return swal({
                    title: "Done!",
                    text: "Delete Success",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1000,
                }).catch(function (timeout) {});
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Delete Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }

    $(document).on("click", "#create-product-button", function () {
        event.preventDefault();
        let kategori = $("#input-column-select").val();
        let formData = new FormData();
        let form = this.form;
        let $parent = $("#form-create-product");
        // create_product_item(formData);
        if (validateCreateProduct($(".input-column"))) {
            formData.append("kategori", kategori);
            formData.append("image", $("#input-column-image").prop("files")[0]);
            $(".input-column").each(function () {
                // console.log(this.name, this.value);
                formData.append(this.name, this.value);
            });

            // for (const pair of formData.entries()) {
            //     console.log(`${pair[0]}, ${pair[1]}`);
            // }
            create_product_item(formData, form, $parent);
        }
    });

    function validateCreateProduct($elem) {
        if ($elem[0]) {
            for (let i = 0; i < $elem.length; i++) {
                if (
                    $elem[i].name == undefined ||
                    $elem[i].value == undefined ||
                    $elem[i].name == "" ||
                    $elem[i].value == ""
                ) {
                    if (!$elem[i].checkValidity()) $elem[i].reportValidity();
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    function printErrorMsg(msg, $parent) {
        $parent.find(".print-error-msg").find("ul").html("");
        $parent.find(".print-error-msg").css("display", "block");
        $.each(msg, function (key, value) {
            $parent
                .find(".print-error-msg")
                .find("ul")
                .append("<li>" + value + "</li>");
        });
    }

    function create_product_item(formData, form, $parent) {
        $.ajax({
            "Content-Type": "application/x-www-form-urlencoded;charset=UTF-8",
            type: "POST",
            url: "/admin/create-product",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                // console.log(data.barang.id_barang);
                if ($.isEmptyObject(data.error)) {
                    form.reset();
                    let rowAdd = $("#list-product")
                        .DataTable()
                        .row.add([
                            `<td class="p-1">${data.barang.id_barang}</td>`,
                            `<img src="${data.barang.gambar_barang}" width="90px" alt="Gambar Produk">`,
                            `<td class="p-1">${data.barang.nama_barang}</td>`,
                            `<td class="p-1">${data.barang.harga_barang}</td>`,
                            `<td class="p-1">${data.barang.berat_barang}</td>`,
                            `<td class="p-1">${data.barang.stok_barang}</td>`,
                            `<td class="p-1">${data.barang.nama_kategori}</td>`,
                            `<td class="p-1">${data.barang.deskripsi_barang}</td>`,
                            `<td class="p-1" style="justify-content-center">
                                <span class="d-flex justify-content-around delete-span" style="border:none;">
                                    <a href="/admin/product/detail/${data.barang.id_barang}" class="btn btn-success btn-sm">Edit</a>
                                    <input type="hidden" name="id_barang" value="${data.barang.id_barang}">
                                    <input type="submit" value="Delete" class="btn btn-danger delete-button btn-sm">
                                </span>
                            </td>`,
                        ])
                        .draw()
                        .node();
                    $(rowAdd).find("td").addClass("p-1");
                    $(document).on(
                        "click",
                        ".delete-button",
                        deleteBarangOnClick
                    );
                    swal({
                        title: "Done!",
                        text: "Create Product Success",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000,
                    }).catch(function (timeout) {});
                } else {
                    printErrorMsg(data.error, $parent);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Create Product Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }

    $(document).on("click", "#get-user-location", function () {
        event.preventDefault();
        var id = $(".input-column[name=id_transaksi]").val();
        getUserLocation(id);
    });

    function getUserLocation(id_transaksi) {
        $.ajax({
            type: "GET",
            url: "/admin/get-user-location",
            data: {
                id_transaksi: id_transaksi,
            },
            success: function (data) {
                // console.log(data.location);
                window.open(
                    `https://google.com/maps?q=${data.location.latitude}, ${data.location.longitude}`,
                    "_blank"
                );
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Confirm Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }

    $(document).on("click", "#change-status-done", function () {
        event.preventDefault();
        var id = $(".input-column[name=id_transaksi]").val();
        let $button = $(this);
        swal({
            title: "Confirmation!",
            text: "Anda yakin mengubah status transaksi ini",
            type: "warning",
            showConfirmButton: true,
            showCancelButton: true,
        })
            .then(function (val) {
                if (val) changeStatusDone(id, $button);
            })
            .catch(function (timeout) {});
    });

    function changeStatusDone(id_transaksi, $button) {
        $.ajax({
            type: "PUT",
            url: "/admin/change-status-done",
            data: {
                id_transaksi: id_transaksi,
            },
            success: function (data) {
                // console.log(data.status);
                if (data.status == 1) {
                    $(".input-column[name=id_transaksi]").remove();
                    $button.remove();
                    $("#get-user-location-li").remove();
                    return swal({
                        title: "Done!",
                        text: "Confirm Success",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000,
                    }).catch(function (timeout) {});
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Confirm Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }

    $(document).on("click", "#site-btn-detail-product", function () {
        event.preventDefault();

        let kategori = $("#input-column-select").val();
        let formData = new FormData();
        let $parent = $("#detail-product-form");
        // create_product_item(formData);
        if (validateCreateProduct($(".input-column"))) {
            formData.append("kategori", kategori);
            formData.append("image", $("#input-column-image").prop("files")[0]);
            $(".input-column").each(function () {
                // console.log(this.name, this.value);
                formData.append(this.name, this.value);
            });
            // for (const pair of formData.entries()) {
            //     console.log(`${pair[0]}, ${pair[1]}`);
            // }

            update_data_product(formData, $parent);
        }
    });

    function update_data_product(formData, $parent) {
        $.ajax({
            "Content-Type": "application/x-www-form-urlencoded;charset=UTF-8",
            type: "POST",
            url: "/admin/update-product",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                // console.log(data.status_update);

                if (data.img_update_status == 1) {
                    $("#product-image").attr(
                        "src",
                        `/${data.status_update.gambar_barang}`
                    );
                }
                if ($.isEmptyObject(data.error)) {
                    swal({
                        title: "Done!",
                        text: "Update Product Success",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000,
                    }).catch(function (timeout) {});
                } else {
                    printErrorMsg(data.error, $parent);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Update Product Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }

    $(document).on("click", "#change-main-image", function () {
        event.preventDefault();
        let id_gb = this.getAttribute("data-id-gb");
        let id_barang = this.getAttribute("data-id-barang");
        let formData = new FormData();
        formData.append("id_gambar_barang", id_gb);
        formData.append("id_barang", id_barang);
        mode = $("#delete-change-toogle-button").attr("data-mode");
        if (mode == "change") {
            changeMainImage(formData);
        } else {
            let $button = $(this);
            swal({
                title: "Confirmation!",
                text: "Anda yakin menghapus gambar ini ?",
                type: "warning",
                showConfirmButton: true,
                showCancelButton: true,
            })
                .then(function (val) {
                    if (val) deleteImage(formData, $button);
                    w;
                })
                .catch(function (timeout) {});
        }
    });

    function deleteImage(formData, $img) {
        $.ajax({
            type: "POST",
            url: "/admin/delete-image",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                // console.log(data.status);
                if (data.status != 200) {
                    swal({
                        title: "Interupt!",
                        text: "Delete Image Failed",
                        type: "warning",
                        showConfirmButton: false,
                        timer: 1500,
                    }).catch(function (timeout) {});
                    return;
                }
                $img.parent().parent().remove();
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Delete Image Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }

    function changeMainImage(formData) {
        $.ajax({
            type: "POST",
            url: "/admin/change-main-image",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                // console.log(data.status);
                if (data.status != 200) {
                    swal({
                        title: "Interupt!",
                        text: "Change Image Failed",
                        type: "warning",
                        showConfirmButton: false,
                        timer: 1500,
                    }).catch(function (timeout) {});
                    return;
                }

                $(`#gambar-barang-${data.data.id_gb}`).attr(
                    "data-setbg",
                    `/${data.data.gambar_barang_lama}`
                );

                $(`#gambar-barang-${data.data.id_gb}`).css(
                    "background-image",
                    `url(/${data.data.gambar_barang_lama})`
                );

                $("#product-image").attr("src", `/${data.data.gambar_barang}`);

                $("#EditImage").modal("hide");
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Change Image Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }

    $(document).on("click", "#delete-change-toogle-button", function () {
        event.preventDefault();
        $span = $("#image-instruction");

        if ($(this).html() == "Delete Mode") {
            $(this).removeClass("bg-danger");
            $(this).addClass("bg-primary");
            $(this).html("Change Mode");
            $span.text("Tap other image to make it main image");
            $(this).attr("data-mode", "change");
        } else {
            $(this).removeClass("bg-primary");
            $(this).addClass("bg-danger");
            $(this).html("Delete Mode");
            $span.text("Tap other image to delete the image");
            $(this).attr("data-mode", "delete");
        }
    });

    $(document).on("click", "#add-image", function () {
        event.preventDefault();
        let $form = $("#add-image-form");
        let formData = new FormData();
        let form = this.form;
        formData.append(
            "image",
            $form.find("#input-column-image").prop("files")[0]
        );
        formData.append("id_barang", $form.find("input[name=id_barang]").val());
        addImage(formData, $form, form);
    });

    function addImage(formData, $parent, form) {
        $.ajax({
            "Content-Type": "application/x-www-form-urlencoded;charset=UTF-8",
            type: "POST",
            url: "/admin/add-image",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    data = data.data;
                    $("#image-container").append(
                        `
                        <div class="col-lg-2 col-sm-3 col-4 mb-2" style="height:100px;">
                            <div class="featured__item">
                                <a href="#" id="change-main-image" data-id-gb="${data.id_gambar_barang}"
                                    data-id-barang="${data.id_barang}">
                                    <div id="gambar-barang-${data.id_gambar_barang}"
                                        class="featured__item__pic set-bg" style="width: 100px; height:100px;"
                                        data-setbg="/${data.gambar_barang}">
                                    </div>
                                </a>
                            </div>
                        </div>
                        `
                    );
                    $(`#gambar-barang-${data.id_gambar_barang}`).css(
                        "background-image",
                        `url(/${data.gambar_barang})`
                    );
                    form.reset();
                    $parent.find(".print-error-msg").find("ul").html("");
                    $parent.find(".print-error-msg").css("display", "none");
                    swal({
                        title: "Done!",
                        text: "Add Image Success",
                        type: "success",
                        showConfirmButton: false,
                        timer: 800,
                    }).catch(function (timeout) {});
                } else {
                    printErrorMsg(data.error, $parent);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Add Image Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }
});
