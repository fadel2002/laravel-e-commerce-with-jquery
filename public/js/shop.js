$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", ".pagination a", function (event) {
        event.preventDefault();
        let page = $(this).attr("href").split("page=")[1];
        let search = $("input[name=oldSearch]").val();
        let kategori = $("input[name=oldKategori]").val();
        if (kategori == "*") {
            kategori = "";
        }
        if (!search) {
            search = "";
        }
        // console.log("p" + page, "s" + search, "k" + kategori);
        fetch_data(search, page, kategori);
    });

    function fetch_data(val, page = 1, kat) {
        $.ajax({
            type: "GET",
            url: "/shop/search-ajax?page=" + page,
            data: { search: val, kategori: kat },
            success: function (data) {
                // console.log(data.data);
                $("#table_data_produk").html(data);
            },
        });
    }

    // $(document).on("keyup", "#search", function (event) {
    //     event.preventDefault();
    //     var value = $(this).val();
    //     searchOnType(value);
    // });

    // function searchOnType(val) {
    //     $.ajax({
    //         type: "GET",
    //         url: "/shop/search-on-type?page=" + val,
    //         data: { search: val },
    //         success: function (data) {
    //             // console.log(data);
    //             $("#table_data_produk").html(data);
    //         },
    //     });
    // }

    $(document).on("click", ".ajax-delete-item", function (event) {
        event.preventDefault();
        let id_dt = $(this).attr("id");
        var id_transaksi = $("input[name=id_transaksi]").val();
        // console.log(id);
        swal({
            title: "Confirmation!",
            text: "Anda yakin menghapus barang ini dari cart?",
            type: "warning",
            showConfirmButton: true,
            showCancelButton: true,
        })
            .then(function (val) {
                if (val) ajaxDeleteItem(id_dt, id_transaksi);
            })
            .catch(function (timeout) {});
    });

    function ajaxDeleteItem(id_dt, id_transaksi) {
        $.ajax({
            type: "DELETE",
            url: "/shop/delete-item-ajax",
            data: { id_dt: id_dt, id_transaksi: id_transaksi },
            success: function (data) {
                data = data.data;
                // console.log(data.data);
                $("#item-" + id_dt).remove();
                $(".span-total-transaksi").text(
                    "Rp " + data["total_transaksi"]
                );
                swal({
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

    $(document).on("click", "#ajax-search", function (event) {
        event.preventDefault();
        var search = $("input[name=search]").val();
        ajaxSearch(search);
        $("input[name=oldSearch]").val(search);
        window.history.pushState("", "", "/shop");
        $("input[name=oldKategori]").val("");
    });

    function ajaxSearch(val, page = 1) {
        $.ajax({
            type: "GET",
            url: "/shop/search-ajax?page=" + page,
            data: { search: val },
            success: function (data) {
                // console.log(data);
                $("#table_data_produk").html(data);
                swal({
                    title: "Done!",
                    text: "Search Success",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1000,
                }).catch(function (timeout) {});
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Search Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }

    $(document).on("click", "#ajax-add-to-cart", function (event) {
        event.preventDefault();
        let data = [];
        data[0] = $("input[name=id_barang]").val();
        data[1] = $("input[name=id_user]").val();
        data[2] = $("input[name=nama]").val();
        data[3] = $("input[name=kuantitas]").val();
        data[4] = $("input[name=harga]").val();
        // console.log(data);
        ajaxAddToCart(data);
    });

    function ajaxAddToCart(data) {
        $.ajax({
            type: "POST",
            url: "/shop/add-to-cart-ajax",
            data: {
                id_barang: data[0],
                id_user: data[1],
                nama: data[2],
                kuantitas: data[3],
                harga: data[4],
            },
            success: function (datas) {
                if (datas.status != 200) {
                    // console.log(datas.status);
                    swal({
                        title: "Interupt!",
                        text: "Stok Tidak Cukup",
                        type: "warning",
                        showConfirmButton: false,
                        timer: 1500,
                    }).catch(function (timeout) {});
                    return;
                }
                $(".span-total-transaksi").text(
                    "Rp " + data["total_transaksi"]
                );
                swal({
                    title: "Done!",
                    text: "Update Success",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1000,
                }).catch(function (timeout) {});
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Update Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }

    $(document).on("click", "#ajax-update-cart", function (event) {
        event.preventDefault();
        let updated_data = [];
        if ($("input").hasClass("input-kuantitas")) {
            var id_transaksi = $("input[name=id_transaksi]").val();

            $(".input-kuantitas").each(function () {
                updated_data.push({
                    id_detail_transaksi: this.id,
                    kuantitas_baru: this.value,
                });

                if (this.value == 0) {
                    console.log("masuk");
                    $("#item-" + this.id).addClass("delete-item");
                }
            });
        }
        ajaxUpdateCart(updated_data, id_transaksi);
    });

    function ajaxUpdateCart(data, id) {
        $.ajax({
            type: "POST",
            url: "/shop/update-cart-ajax",
            data: { updated_data: data, id_transaksi: id },
            success: function (datas) {
                data = datas.data;
                // console.log(datas.status);
                if (datas.status != 200) {
                    swal({
                        title: "Interupt!",
                        text: `Stok ${datas.nama_barang} Tidak Cukup`,
                        type: "warning",
                        showConfirmButton: false,
                        timer: 1500,
                    }).catch(function (timeout) {});
                    return;
                }
                for (let i = 0; i < data["transaksi_per_data"].length; i++) {
                    $("#span-transaksi-per-data-" + i).text(
                        "Rp " + data["transaksi_per_data"][i]
                    );
                }
                $(".delete-item").remove();
                $(".span-total-transaksi").text(
                    "Rp " + data["total_transaksi"]
                );
                swal({
                    title: "Done!",
                    text: "Update Success",
                    type: "success",
                    showConfirmButton: false,
                    timer: 1000,
                }).catch(function (timeout) {});
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Update Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }

    $(document).on("click", "#ajax-checkout-payment", function (event) {
        event.preventDefault();
        let data = [];
        if ($(".input-column")[0]) {
            $(".input-column").each(function () {
                data[this.name] = this.value;
            });
        }
        if (!data["id_transaksi"] || data["subtotal"] == 0) {
            return swal({
                title: "Interupt!",
                text: "Anda belum berbelanja",
                type: "warning",
                showConfirmButton: false,
                timer: 1500,
            }).catch(function (timeout) {});
        }
        navigator.geolocation.getCurrentPosition(
            (position) => {
                // console.log(
                //     position.coords.latitude,
                //     position.coords.longitude
                // );
                data["latitude"] = position.coords.latitude;
                data["longitude"] = position.coords.longitude;
                // console.log(data);
                ajaxCheckoutPayment(data);
            },
            (err) => {
                console.log(err);
            },
            {
                enableHighAccuracy: true,
                maximumAge: 0,
            }
        );
    });

    function ajaxCheckoutPayment(data) {
        $.ajax({
            type: "POST",
            url: "/shop/checkout-payment-ajax",
            data: {
                address: data["address"],
                id_transaksi: data["id_transaksi"],
                payment: data["payment"],
                latitude: data["latitude"],
                longitude: data["longitude"],
            },
            timeout: 5000,
            success: function (data) {
                data = data.data;
                // console.log(data);
                $(".alert-danger").text("");
                if (data.status == 2) {
                    $(".alert-danger").hide();
                    return swal({
                        title: "Interupt!",
                        text: data.message,
                        type: "warning",
                        showConfirmButton: false,
                        timer: 1500,
                    }).catch(function (timeout) {});
                } else if (data.status == 1) {
                    $(".alert-danger").hide();
                    $(".input-column[name=address]").val("");
                    $("span.subtotal-reload").text("Rp 0");
                    $("li.item-reload").remove();
                    $("span.total-reload").text("Rp " + data.ongkir);
                    $("span.span-total-transaksi").text("Rp 0");
                    return swal({
                        title: "Success!",
                        text: "Payment Success",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000,
                    }).catch(function (timeout) {});
                } else {
                    $.each(data.status, function (key, value) {
                        $(".alert-danger").show();
                        $(".alert-danger").append(
                            '<p class="mb-0">' + value + "</p>"
                        );
                    });
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                swal({
                    title: "Interupt!",
                    text: "Payment Failed",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                }).catch(function (timeout) {});
            },
        });
    }
});
