/*  ---------------------------------------------------
    Template Name: Ogani
    Description:  Ogani eCommerce  HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

"use strict";

(function ($) {
    /*------------------
        Preloader
    --------------------*/
    $(window).on("load", function () {
        $(".loader").fadeOut();
        $("#preloder").fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/

        if (
            window.location.href.includes("shop/cart") ||
            window.location.href.includes("shop/checkout")
        )
            $(".pages-menu").addClass("active");
        else if (window.location.href.includes("shop"))
            $(".shop-menu").addClass("active");
        else if (window.location.href.includes("contact"))
            $(".contact-menu").addClass("active");
        else $(".home-menu").addClass("active");

        $(".featured__controls li").on("click", function () {
            $(".featured__controls li").removeClass("active");
            $(this).addClass("active");
        });
        if ($(".featured__filter").length > 0) {
            var containerEl = document.querySelector(".featured__filter");
            var mixer = mixitup(containerEl);
        }
    });

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
            ajaxDeleteItem(id_dt, id_transaksi);
        });

        function ajaxDeleteItem(id_dt, id_transaksi) {
            $.ajax({
                type: "POST",
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
                        text: "Search Success",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000,
                    }).catch(function (timeout) {});
                },
                fail: function (xhr, textStatus, errorThrown) {
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

        $(document).on("click", "#ajax-search", function (event) {
            event.preventDefault();
            var search = $("input[name=search]").val();
            ajaxSearch(search);
            $("input[name=oldSearch]").val(search);
            window.history.pushState("", "", "/shop");
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
                fail: function (xhr, textStatus, errorThrown) {
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
                success: function (data) {
                    // console.log(data);
                    swal({
                        title: "Done!",
                        text: "Update Success",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000,
                    }).catch(function (timeout) {});
                },
                fail: function (xhr, textStatus, errorThrown) {
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
                });
            }
            ajaxUpdateCart(updated_data, id_transaksi);
        });

        function ajaxUpdateCart(data, id) {
            $.ajax({
                type: "POST",
                url: "/shop/update-cart-ajax",
                data: { updated_data: data, id_transaksi: id },
                success: function (data) {
                    data = data.data;
                    // console.log(data);
                    for (
                        let i = 0;
                        i < data["transaksi_per_data"].length;
                        i++
                    ) {
                        $("#span-transaksi-per-data-" + i).text(
                            "Rp " + data["transaksi_per_data"][i]
                        );
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
                fail: function (xhr, textStatus, errorThrown) {
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
    });

    /*------------------
        Background Set
    --------------------*/
    $(".set-bg").each(function () {
        var bg = $(this).data("setbg");
        $(this).css("background-image", "url(" + bg + ")");
    });

    //Humberger Menu
    $(".humberger__open").on("click", function () {
        $(".humberger__menu__wrapper").addClass(
            "show__humberger__menu__wrapper"
        );
        $(".humberger__menu__overlay").addClass("active");
        $("body").addClass("over_hid");
    });

    $(".humberger__menu__overlay").on("click", function () {
        $(".humberger__menu__wrapper").removeClass(
            "show__humberger__menu__wrapper"
        );
        $(".humberger__menu__overlay").removeClass("active");
        $("body").removeClass("over_hid");
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: "#mobile-menu-wrap",
        allowParentLinks: true,
    });

    /*-----------------------
        Categories Slider
    ------------------------*/
    $(".categories__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        dots: false,
        nav: true,
        navText: [
            "<span class='fa fa-angle-left'><span/>",
            "<span class='fa fa-angle-right'><span/>",
        ],
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 3,
            },

            992: {
                items: 4,
            },
        },
    });

    $(".hero__categories__all").on("click", function () {
        $(".hero__categories ul").slideToggle(400);
    });

    /*--------------------------
        Latest Product Slider
    ----------------------------*/
    $(".latest-product__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: [
            "<span class='fa fa-angle-left'><span/>",
            "<span class='fa fa-angle-right'><span/>",
        ],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*-----------------------------
        Product Discount Slider
    -------------------------------*/
    $(".product__discount__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 3,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            320: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 2,
            },

            992: {
                items: 3,
            },
        },
    });

    /*---------------------------------
        Product Details Pic Slider
    ----------------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: true,
        margin: 20,
        items: 4,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*-----------------------
		Price Range Slider
	------------------------ */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data("min"),
        maxPrice = rangeSlider.data("max");
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            minamount.val("$" + ui.values[0]);
            maxamount.val("$" + ui.values[1]);
        },
    });
    minamount.val("$" + rangeSlider.slider("values", 0));
    maxamount.val("$" + rangeSlider.slider("values", 1));

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*------------------
		Single Product
	--------------------*/
    $(".product__details__pic__slider img").on("click", function () {
        var imgurl = $(this).data("imgbigurl");
        var bigImg = $(".product__details__pic__item--large").attr("src");
        if (imgurl != bigImg) {
            $(".product__details__pic__item--large").attr({
                src: imgurl,
            });
        }
    });

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $(".pro-qty");
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on("click", ".qtybtn", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input[name=kuantitas]").val();
        var maxValue = $button.parent().find("input[name=maxQuantity]").val();
        // console.log(maxValue);
        if ($button.hasClass("inc")) {
            // console.log(oldValue, maxValue);
            // console.log(oldValue < maxValue);
            if (parseFloat(oldValue) < parseFloat(maxValue)) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                newVal = parseFloat(maxValue);
            }
        } else {
            // Don't allow decrementing below zero
            if (parseFloat(oldValue) > parseFloat(maxValue)) {
                newVal = parseFloat(maxValue);
            } else if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input[name=kuantitas]").val(newVal);
    });
})(jQuery);
