$(document).ready(() => {
    if ($(".min-inner-height").length > 1) {
        $(".min-inner-height").each(function (item, index) {
            $(this).css("height", window.innerHeight);
        });
    } else {
        $(".min-inner-height").css("height", window.innerHeight);
    }

    /*if ($(".update_gate_button").length > 1){
        $(".update_gate_button").each((x,y) => {
            $(y).click(() => {
                $("#gates_update_table").fadeIn(300);

                $("#gates_update_new").val($(y).attr("domain"));

                $("#new_domain_name").val($(y).attr("domain"));

                $("#domain_id").val($(y).attr("domain_id"));

                $("#new_domain_callback").val($(y).attr("domain_callback"));
            });
        });
    }
    else{
        $(".update_gate_button").click(() => {

            $("#websites_update_table").fadeIn(300);

            $("#old_domain").val($(".update_domain_button").attr("domain"));

            $("#new_domain_name").val($(".update_domain_button").attr("domain"));

            $("#domain_id").val($(".update_domain_button").attr("domain_id"));

            $("#new_domain_callback").val($(".update_domain_button").attr("domain_callback"));

        });
    }

    $("#websites_update_close_button").click(() => {

        $("#websites_update_table").fadeOut(300);

    });*/

    $("#tahsilat_add_openbutton").click(() => {

        $("#tahsilat_add_gate").val($("#tahsilat_add_gate").attr("default-payment-gate"));
        $("#tahsilat_add_tutar").val(1);
        $("#tahsilat_add_currency").val(949);

        $("#tahsilat_add_table").fadeIn(300);
    });

    $("#tahsilat_add_closebutton").click(() => {
        $("#tahsilat_add_table").fadeOut(300);
    });


    /* TAHSILAT DETAY KISMI BAŞLANGICI */


    if ($(".tahsilat_detay_openbutton").length > 1) {
        $(".tahsilat_detay_openbutton").each((x, y) => {
            $(y).click(() => {

                $("#tahsilat_detay_area").html($(y).attr("tahsilat-detay"));

                $("#tahsilat_detay_table").fadeIn(300);

            });
        });
    } else {
        $(".tahsilat_detay_openbutton").click(() => {

            $("#tahsilat_detay_area").html($(".tahsilat_detay_openbutton").attr("tahsilat-detay"));

            $("#tahsilat_detay_table").fadeIn(300);
        });
    }

    $("#tahsilat_detay_closebutton").click(() => {
        $("#tahsilat_detay_table").fadeOut(300);
    });

    /* TAHSILAT DETAY KISMI BITISI */


});