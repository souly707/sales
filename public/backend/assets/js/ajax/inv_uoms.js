$(document).ready(function () {
    // Inv Uoums Ajax Search
    $(document).on("input", "#search_by_text", function (e) {
        makeSearch();
    });

    $(document).on("change", "#is_master_search", function (e) {
        makeSearch();
    });

    function makeSearch() {
        var search_text = $("#search_by_text").val();
        var is_master_search = $("#is_master_search").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();

        //Start Ajax Search
        $.ajax({
            type: "post",
            url: ajax_search_url,
            dataType: "html",
            cache: false,
            data: {
                search_text: search_text,
                is_master_search: is_master_search,
                _token: token_search,
            },
            success: function (data) {
                $("#ajax_response_div").html(data);
            },
            error: function () {},
        });
    }
});
