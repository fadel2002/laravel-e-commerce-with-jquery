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
        var table = $("#list-product").DataTable();
        // console.log(id_barang);
        delete_item(id_barang, table, $button);
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

    // $(document).on("click", ".delete-button", function (event) {
    //     event.preventDefault();
    //     let page = $(this).attr("href").split("page=")[1];
    //     fetch_data(page);
    // });

    // function fetch_data(page = 1) {
    //     $.ajax({
    //         type: "GET",
    //         url: "/admin/more-data?page=" + page,
    //         success: function (data) {
    //             // console.log(data.data);
    //             $("#table_data_admin_produk").html(data);
    //         },
    //     });
    // }
});
