$(document).ready(function () {

    //First example button
    $("#first_example_btn").click(function () {
        populateFirstExample();
    });

    //Second example button
    $("#second_example_btn").click(function () {
        populateSecondExample();
    });

    //Transition between pages
    $(".pagination_btn").click(function () {
        $("#current_page").val($(this).text());
        $("#current_page_indicator").html($(this).text());
        $(".pagination_btn").removeClass("selected_btn");
        $(this).addClass("selected_btn");
    });

    //Refresh button
    $("#refresh_btn").click(function () {
        var current_page = $("#current_page").val(),
            total_pages = $("#total_pages").val(),
            boundaries = $("#boundaries").val(),
            around = $("#around").val();
        if (current_page === "" || boundaries === "" || around === "" || total_pages === "") {
            alert("Please fill in all the fields before clicking the refresh button");
        } else {
            $.ajax({
                type: "POST",
                url: '/control/refresh.php',
                data: {currentPage: current_page, boundaries: boundaries, around:around, totalPages:total_pages},
                success: function (returnedData) {
                    alert(returnedData);
                }
            })
        }

    })

});


/*
* First Example:
$current_page = 4;
$total_pages  = 5;
$boundaries   = 1;
$around       = 0;
Expected result: 1 ... 4 5
* */

/*
* Second Example:
$current_page = 4;
$total_pages = 10;
$boundaries = 2;
$around = 2;
Expected result: 1 2 3 4 5 6 ... 9 10
* */

function populateFirstExample() {
    $("#current_page").val(4);
    $("#total_pages").val(5);
    $("#boundaries").val(1);
    $("#around").val(0);
}

function populateSecondExample() {
    $("#current_page").val(4);
    $("#total_pages").val(10);
    $("#boundaries").val(2);
    $("#around").val(2);
}
