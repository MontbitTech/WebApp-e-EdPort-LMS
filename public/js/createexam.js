// function validate1(val) {
//     // v1 = document.getElementById("name");
//     v2 = document.getElementById("examname");

//     //flag1 = true;
//     flag2 = true;

//     // if (val >= 1 || val == 0) {
//     //     if (v1.value == "") {
//     //         v1.style.borderColor = "red";
//     //         flag1 = false;
//     //     } else {
//     //         v1.style.borderColor = "white";
//     //         flag1 = true;
//     //     }
//     // }

//     if (val >= 2 || val == 0) {
//         if (v2.value == "") {
//             v2.style.borderColor = "red";
//             flag2 = false;
//         } else {
//             v2.style.borderColor = "white";
//             flag2 = true;
//         }
//     }

//     // flag = flag1 && flag2;
//     flag = flag2;
//     return flag;
// }

// function validate2(val) {
//     v1 = document.getElementById("web-title");
//     v2 = document.getElementById("desc");

//     flag1 = true;
//     flag2 = true;

//     if (val >= 1 || val == 0) {
//         if (v1.value == "") {
//             v1.style.borderColor = "red";
//             flag1 = false;
//         } else {
//             v1.style.borderColor = "white";
//             flag1 = true;
//         }
//     }

//     if (val >= 2 || val == 0) {
//         if (v2.value == "") {
//             v2.style.borderColor = "red";
//             flag2 = false;
//         } else {
//             v2.style.borderColor = "white";
//             flag2 = true;
//         }
//     }

//     flag = flag1 && flag2;

//     return flag;
// }

$(document).ready(function () {

    var current_fs, next_fs, previous_fs;

    $(".next").click(function () {

        str1 = "next1";
        str2 = "next2";
        str3 = "next3";

        if (!str1.localeCompare($(this).attr('id')) == true) {
            val1 = true;
        } else {
            val1 = false;
        }

        if (!str2.localeCompare($(this).attr('id')) == true) {
            val2 = true;
        } else {
            val2 = false;
        }
        if (!str3.localeCompare($(this).attr('id')) == true) {
            val3 = true;
        } else {
            val3 = false;
        }

        if ((!str1.localeCompare($(this).attr('id')) && val1 == true) || (!str2.localeCompare($(this).attr('id')) && val2 == true) || (!str3.localeCompare($(this).attr('id')) && val3 == true)) {
            current_fs = $(this).parent().parent().parent();
            next_fs = $(this).parent().parent().parent().next();

            $(current_fs).removeClass("show");
            $(next_fs).addClass("show");

            $("#progressbar li").eq($(".card").index(next_fs)).addClass("active");

            current_fs.animate({}, {
                step: function () {

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });

                    next_fs.css({
                        'display': 'block'
                    });
                }
            });
        }
    });

    $(".prev").click(function () {
        current_fs = $(this).parent().parent().parent();
        previous_fs = $(this).parent().parent().parent().prev();
        // current_fs = $(this).parent();
        // previous_fs = $(this).parent().prev();

        $(current_fs).removeClass("show");
        $(previous_fs).addClass("show");

        $("#progressbar li").eq($(".card").index(next_fs)).removeClass("active");

        current_fs.animate({}, {
            step: function () {

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });

                previous_fs.css({
                    'display': 'block'
                });
            }
        });
    });

});


function collapse(el) {
    $(el).parent().removeAttr('open');
    $(el).siblings(':not(summary)').removeAttr('style');
}
$(function () {
    //Set accessibility attributes
    $('summary').each(function () {
        $(this).attr('role', 'button');
        if ($(this).parent().is('[open]')) {
            $(this).attr('aria-expanded', 'true');
        } else {
            $(this).attr('aria-expanded', 'false');
        }
    });

    //Event handler
    $('summary').on('click', function (e) {
        e.preventDefault();
        if ($(this).parent().is('[open]')) {
            $(this).attr('aria-expanded', 'false');
            $(this).siblings(':not(summary)').css('transform', 'scaleY(0)');
            window.setTimeout(collapse, 300, $(this));
        } else {
            $(this).parent().attr('open', '');
            $(this).attr('aria-expanded', 'true');
        }
    });
});