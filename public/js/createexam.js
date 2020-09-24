var max_fields = 100000; //maximum input boxes allowed
var wrapper = $(".createquestion"); //Fields wrapper
var add_button = $(".addquestionexam"); //Add button ID

var x = 2; //initlal text box count
$(add_button).click(function (e) { //on add input button click
    e.preventDefault();
    if (x < max_fields) { //max input box allowed
        x++; //text box increment
        $(wrapper).append(`<div class="row">
            <div class="col-md-1 mt-2">
                                            <input type="checkbox" name="" id="" checked>
                                        </div>
                         <div class=" col-md-11 p-0  mx-0">
                             p                           
                                    <label for="exampleInputQuestion` + x + `" class="align-top">Question ` + x + `</label>
                                    <a href="#" style="float:right;" class="remove_field"><i class="fas fa-times"></i></a>
                                   <div class="form-group mb-0 pb-1">                                   
                                      <textarea name="" id="exampleInputQuestion` + x + `" class="w-100 form-control" rows="3" placeholder="Insert your question" style="resize: none;" ></textarea>
                                    </div>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                                <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                                                <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                                <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="mb-0 mt-0 pt-0 pb-1">
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 1">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                                 <td class="mb-0 mt-0 pt-0 pb-1">
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 2">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mb-0 mt-0 pt-1 pb-0">
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 3">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 4">
                                                </td>
                                                <td class="mb-0 mt-0 pt-1 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                            </tr>                     
                                        </tbody>
                                   </table>                                    
                            </div>
                            </div>`); //add input box
    }
});

$(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
    e.preventDefault();
    $(this).parent().parent('div').remove();
    x--;
});



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

        if ((!str1.localeCompare($(this).attr('id')) && val1 == true) || (!str2.localeCompare($(
                this).attr('id')) && val2 == true) || (!str3.localeCompare($(
                this).attr('id')) && val3 == true)) {
            current_fs = $(this).parent().parent().parent();
            next_fs = $(this).parent().parent().parent().next();

            $(current_fs).removeClass("show");
            $(next_fs).addClass("show");

            $("#progressbar li").eq($(".card-hidden").index(next_fs)).addClass("active");

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