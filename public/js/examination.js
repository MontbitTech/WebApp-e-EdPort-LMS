$(document).ready(function () {
    $('#questions').DataTable({
        "dom": '<"top"i><"clear">',
        'info': false,
    });
    $('#studentreportshow').DataTable();
    $('#studentreport').DataTable({
        "dom": '<"top"i>rt<"row"<"col-md-6  w-100"l >"col-md-6"p><"clear">',
        'info': false,
        "paging": true,
        "searching": false,

    });
    $(".comment").shorten({
        "showChars": 100,
        "moreText": "See More",
    });

    $(".comment-small").shorten({
        showChars: 10
    });
    $("select").change(function () {
        $(this).find("option:selected").each(function () {
            var optionValue = $(this).attr("value");
            if (optionValue) {
                $(".new").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else {
                $(".new").hide();
            }
        });
    }).change();
    $("select").change(function () {
        $(this).find("option:selected").each(function () {
            var optionValue = $(this).attr("value");
            if (optionValue) {
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else {
                $(".box").hide();
            }
        });
    }).change();

});