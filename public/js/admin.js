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
            url: "/admin/more-data?page=" + page,
            success: function (data) {
                // console.log(data.data);
                $("#table_data_admin_produk").html(data);
            },
        });
    }

    var deleteSpan = $(".delete-span");
    deleteSpan.on("click", ".delete-button", function () {
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
    });

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
        let data = [];
        if ($(".input-column")[0]) {
            $(".input-column").each(function () {
                if (this.name != undefined && this.value != undefined)
                    console.log(this.name, this.value);
            });
        }
        // create_product_item();
    });

    function create_product_item(id_barang, table, $button) {
        $.ajax({
            type: "POST",
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
});
