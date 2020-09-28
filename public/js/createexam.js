function validate1(val) {
    v1 = document.getElementById("examname");
    // v2 = document.getElementById("examname");

    flag1 = true;
    //  flag2 = true;

    if (val >= 1 || val == 0) {
        if (v1.value == "") {
            v1.style.borderColor = "red";
            // v1.style.color = "red";
            flag1 = false;
        } else {
            v1.style.borderColor = "#373c8e";
            flag1 = true;
        }
    }

    // if (val >= 2 || val == 0) {
    //     if (v2.value == "") {
    //         v2.style.borderColor = "red";
    //         flag2 = false;
    //     } else {
    //         v2.style.borderColor = "#ced4da";
    //         flag2 = true;
    //     }
    // }

    //flag = flag1 && flag2;
    flag = flag1;
    return flag;
}

// function validate3(val) {
//     // v1 = $('#questionmarks');
//     // console.log(v1);
//     v1 = document.getElementById("questionmarks");
//     // v2 = document.getElementById("examname");

//     flag1 = true;
//     //  flag2 = true;

//     if (val >= 1 || val == 0) {
//         if (v1.value == "") {
//             v1.style.borderColor = "red";
//             flag1 = false;
//         } else {
//             v1.style.borderColor = "pink";
//             flag1 = true;
//         }
//     }

//     // if (val >= 2 || val == 0) {
//     //     if (v2.value == "") {
//     //         v2.style.borderColor = "red";
//     //         flag2 = false;
//     //     } else {
//     //         v2.style.borderColor = "#ced4da";
//     //         flag2 = true;
//     //     }
//     // }

//     //flag = flag1 && flag2;
//     flag = flag1;
//     return flag;
// }

function validate4(val) {
    v1 = document.getElementById("select1");
    v2 = document.getElementById("hh");
    v3 = document.getElementById("ss");
    v4 = document.getElementById("timestart");
    v5 = document.getElementById("timeend");

    flag1 = true;
    flag2 = true;
    flag3 = true;
    flag4 = true;
    flag5 = true;

    if (val >= 1 || val == 0) {
        if (v1.value == "") {
            v1.style.borderColor = "red";
            flag1 = false;
        } else {
            v1.style.borderColor = "#ced4da";
            flag1 = true;
        }
    }

    if (val >= 2 || val == 0) {
        if (v2.value == "") {
            v2.style.borderColor = "red";
            flag2 = false;
        } else {
            v2.style.borderColor = "#ced4da";
            flag2 = true;
        }
    }

    if (val >= 3 || val == 0) {
        if (v3.value == "") {
            v3.style.borderColor = "red";
            flag3 = false;
        } else {
            v3.style.borderColor = "#ced4da";
            flag3 = true;
        }
    }

    if (val >= 4 || val == 0) {
        if (v4.value == "" ) {
            v4.style.borderColor = "red";
            flag4 = false;
        } else {
            v4.style.borderColor = "#ced4da";
            flag4 = true;
        }
    }

    if (val >= 5 || val == 0) {
        if (v5.value == "" || v5.value <= v4.value) {
            v5.style.borderColor = "red";
            flag5 = false;
        } else {
            v5.style.borderColor = "#ced4da";
            flag5 = true;
        }
    }

    flag = flag1 && flag4 && flag5;

    return flag;
}

// function addQuestionToPaper(val) {
//     v1 = document.getElementById("exampleInputQuestion3");
//     v2 = document.getElementById("option13");
//     v3 = document.getElementById("option23");
//     v4 = document.getElementById("option33");
//     v5 = document.getElementById("option43");
//     v6 = document.getElementById("checkbox13");
//     v7 = document.getElementById("checkbox23");
//     v8 = document.getElementById("checkbox33");
//     v9 = document.getElementById("checkbox43");
//     v0 = document.getElementById("timeend");

//     flag1 = true;
//     flag2 = true;
//     flag3 = true;
//     flag4 = true;

//     if (val >= 1 || val > 3 || val == 0) {
//         if (v1.value == "" || v2.value == "") {
//             v1.style.borderColor = "red";
//             v3.style.borderColor = "red";
//             flag1 = false;
//         } else {
//             v3.style.borderColor = "#ced4da";
//             v1.style.borderColor = "#ced4da";
//             flag1 = true;
//         }
//     }

//     if (val >= 2 || val == 0) {
//         if (v2.value == "") {
//             v2.style.borderColor = "red";
//             flag2 = false;
//         } else {
//             v2.style.borderColor = "#ced4da";
//             flag2 = true;
//         }
//     }
//     if (val >= 3 || val == 0) {
//         if (v3.value == "") {
//             v3.style.borderColor = "red";
//             flag3 = false;
//         } else {
//             v3.style.borderColor = "#ced4da";
//             flag2 = true;
//         }
//     }
//     if (val >= 4 || val == 0) {
//         if (v4.value == "") {
//             v4.style.borderColor = "red";
//             flag4 = false;
//         } else {
//             v4.style.borderColor = "#ced4da";
//             flag4 = true;
//         }
//     }

//     flag = flag1 && flag2 && flag3 && flag4;

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
//             v1.style.borderColor = "#ced4da";
//             flag1 = true;
//         }
//     }

//     if (val >= 2 || val == 0) {
//         if (v2.value == "") {
//             v2.style.borderColor = "red";
//             flag2 = false;
//         } else {
//             v2.style.borderColor = "#ced4da";
//             flag2 = true;
//         }
//     }

//     flag = flag1 && flag2;

//     return flag;
// }
// $(document).ready(function () {
//     $.validator.setDefaults({
//         ClickHandler: function (form) {
//             form.click();
//         }
//     });
//     $('#createdata').validate({
//         rules: {
//             exampleInputQuestion: {
//                 required: true,
//                 minlength: 5
//             },
//         },
//         messages: {
//             exampleInputQuestion: {
//                 required: "Enter The Name",
//                 minlength: "Please, at least {0} characters are necessary"
//             },
//         }


//     });
// });
$(document).ready(function () {

    var current_fs, next_fs, previous_fs;

    $(".next").click(function () {

        str1 = "next1";
        str2 = "next2";
        str3 = "next3";
        str4 = "next4";


        if (!str1.localeCompare($(this).attr('id')) && validate1(0) == true) {
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
        if (!str4.localeCompare($(this).attr('id')) && validate4(0) == true) {
            val4 = true;
        } else {
            val4 = false;
        }

        if ((!str1.localeCompare($(this).attr('id')) && val1 == true) || (!str2.localeCompare($(this).attr('id')) && val2 == true) || (!str3.localeCompare($(this).attr('id')) && val3 == true) || (!str4.localeCompare($(this).attr('id')) && val4 == true)) {
            current_fs = $(this).parent().parent().parent();
            next_fs = $(this).parent().parent().parent().next();

            $(current_fs).removeClass("show");
            $(next_fs).addClass("show");

            $("#progressbar li").eq($(".bg-data").index(next_fs)).addClass("active");

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

        $("#progressbar li").eq($(".bg-data").index(next_fs)).removeClass("active");
        $("#progressbar li").eq($(".bg-data").index(current_fs)).removeClass("active");
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