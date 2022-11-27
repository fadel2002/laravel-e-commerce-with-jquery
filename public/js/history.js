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
            url: "/history/more-data?page=" + page,
            success: function (data) {
                // console.log(data.data);
                $("#table_data_histori_produk").html(data);
            },
        });
    }
});
