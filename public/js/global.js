$(document).ready(function () {
    /** add active class and stay opened when selected */
    var url = window.location;

    // for navbar menu entirely but
    $("ul.navbar-nav a")
        .filter(function () {
            return this.href == url;
        })
        .addClass("active");

    // for sidebar menu entirely but not cover treeview
    $("ul.nav-sidebar a")
        .filter(function () {
            return this.href == url;
        })
        .addClass("active");

    // for treeview
    $("ul.nav-treeview a")
        .filter(function () {
            return this.href == url;
        })
        .parentsUntil(".nav-sidebar > .nav-treeview")
        .addClass("menu-open")
        .prev("a")
        .addClass("active");
});

$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Initialize Select2 Elements
    $(".select2bs4").select2({
        theme: "bootstrap4",
    });

    $(".summernote").summernote({
        minHeight: 300,
    });

    $("#image-click").on("click", function () {
        $("#image-preview").attr("src", $("#image-resource").attr("src")); // here asign the image to the modal when the user click the enlarge link
        $("#image-modal").modal("show"); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
    });
});

function doRequest(
    request_type,
    request_url,
    request_data,
    with_swal,
    access_token
) {
    console.log("doRequest");
    var response;

    let process_data;
    let content_type = "application/x-www-form-urlencoded; charset=UTF-8";
    if (request_data instanceof FormData) {
        process_data = false;
        content_type = false;
    } else {
        process_data = true;
    }

    console.log(process_data);
    $.ajax({
        type: request_type,
        beforeSend: function (request) {
            request.setRequestHeader("Authorization", access_token);
        },
        async: false,
        url: request_url,
        data: request_data,
        processData: process_data,
        contentType: content_type,
        success: function (res) {
            if (with_swal) {
                if (res.success) {
                    Swal.fire({
                        icon: "success",
                        title: res.message,
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Something went wrong !",
                        text: res.message,
                    });
                }
            }
            response = res;
        },
        error: function (err) {
            console.log(err);
            Swal.fire({
                icon: "error",
                title: err.status + " " + err.statusText,
                html:
                    "message : " +
                    err.responseJSON.message +
                    "<br>" +
                    "Exception : " +
                    err.responseJSON.exception,
            });
        },
    });
    return response;
}
