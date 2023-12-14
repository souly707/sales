$(document).ready(function () {
    // Treasuries Ajax Search

    $(document).on("input", "#search_by_text", function (e) {
        var search_text = $(this).val();
        var token_search = $("#token_search").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        // console.log(token_search);
        // alert(ajax_search_url)

        //Start Ajax Search
        jQuery.ajax({
            url: ajax_search_url,
            type: "post",
            dataType: "html",
            cache: false,
            data: {
                search_text: search_text,
                _token: token_search,
                // ajax_search_url:    ajax_search_url,
            },

            success: function (data) {
                $("#ajax_response_div").html(data);
            },
            error: function () {},
        });
    });

    // Start Handle Pagination Ajax Search
    $(document).on("click", "#search_ajax_pagination a", function (e) {
        e.preventDefault();
        var search_text = $("#search_by_text").val();
        var url = $(this).attr("href");
        var token_search = $("#token_search").val();

        jQuery.ajax({
            url: url,
            type: "post",
            dataType: "html",
            cache: false,
            data: {
                search_text: search_text,
                _token: token_search,
            },

            success: function (data) {
                $("#ajax_response_div").html(data);
            },

            error: function () {
                alert("error");
            },
        });
    });
});
