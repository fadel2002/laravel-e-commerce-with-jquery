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
            create_product_item(formData, form);
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

    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html("");
        $(".print-error-msg").css("display", "block");
        $.each(msg, function (key, value) {
            $(".print-error-msg")
                .find("ul")
                .append("<li>" + value + "</li>");
        });
    }

    function create_product_item(formData, form) {
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
                                    <a href="#" class="btn btn-success btn-sm">Edit</a>
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
                    printErrorMsg(data.error);
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

    $(document).on("click", "#change-status-done", function () {
        event.preventDefault();
        var id = $(".input-column[name=id_transaksi]").val();
        changeStatusDone(id, $(this));
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
});
