window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var paymentOptions_html = '';
    var payment_status = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/paymentOptions/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#paymentOptions_counter").text(response.paymentOptions_count);
            $('#pagination').html(response.pagination);

            response.paymentOptions.data.forEach(function(paymentOption) {

                if(paymentOption.status == 1){
                    payment_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    payment_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                paymentOptions_html = paymentOptions_html +
                
                "<div class=\"modal fade\" id=\"delete_paymentOption_"+ paymentOption.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this option value </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this payment option to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_paymentOption("+ paymentOption.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"option_id[]\" value=\""+ paymentOption.id +"\" ></input> </td>\n" +
                "<td>"+ paymentOption.id +"</td>\n"+
                "<td>"+ paymentOption.type +"</td>\n"+
                "<td>"+ paymentOption.method +"</td>\n"+
                "<td> <img src=\""+ paymentOption.image +"\" / style=\"width: 100px; height: 100px\"> </td>\n"+
                "<td>"+ payment_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/paymentOptions/"+ paymentOption.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/paymentOptions/"+ paymentOption.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_paymentOption_"+ paymentOption.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#paymentOptions_table_body").html(paymentOptions_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var paymentOptions_html = '';
    var payment_status = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/paymentOptions/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#paymentOptions_counter").text(response.paymentOptions_count);
            $('#pagination').html(response.pagination);

            response.paymentOptions.data.forEach(function(paymentOption) {

                if(paymentOption.status == 1){
                    payment_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    payment_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                paymentOptions_html = paymentOptions_html +
                
                "<div class=\"modal fade\" id=\"delete_paymentOption_"+ paymentOption.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this option value </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this payment option to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_paymentOption("+ paymentOption.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"option_id[]\" value=\""+ paymentOption.id +"\" ></input> </td>\n" +
                "<td>"+ paymentOption.id +"</td>\n"+
                "<td>"+ paymentOption.type +"</td>\n"+
                "<td>"+ paymentOption.method +"</td>\n"+
                "<td> <img src=\""+ paymentOption.image +"\" / style=\"width: 100px; height: 100px\"> </td>\n"+
                "<td>"+ payment_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/paymentOptions/"+ paymentOption.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/paymentOptions/"+ paymentOption.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_paymentOption_"+ paymentOption.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#paymentOptions_table_body").html(paymentOptions_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// ==============================================================// 
// to handel pagination  
$("#pagination").on('click', 'a', function(e) {
    e.preventDefault();
    window.current_page = this.href.split('=')[1];
    $("#ajax_loader").css('display', 'block');

    var paymentOptions_html = '';
    var payment_status = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/paymentOptions/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#paymentOptions_counter").text(response.paymentOptions_count);
            $('#pagination').html(response.pagination);

            response.paymentOptions.data.forEach(function(paymentOption) {

                if(paymentOption.status == 1){
                    payment_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    payment_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                paymentOptions_html = paymentOptions_html +
                
                "<div class=\"modal fade\" id=\"delete_paymentOption_"+ paymentOption.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this option value </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this payment option to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_paymentOption("+ paymentOption.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"option_id[]\" value=\""+ paymentOption.id +"\" ></input> </td>\n" +
                "<td>"+ paymentOption.id +"</td>\n"+
                "<td>"+ paymentOption.type +"</td>\n"+
                "<td>"+ paymentOption.method +"</td>\n"+
                "<td> <img src=\""+ paymentOption.image +"\" / style=\"width: 100px; height: 100px\"> </td>\n"+
                "<td>"+ payment_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/paymentOptions/"+ paymentOption.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/paymentOptions/"+ paymentOption.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_paymentOption_"+ paymentOption.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#paymentOptions_table_body").html(paymentOptions_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) paymentOption
function archive_paymentOption(paymentOption_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/paymentOptions/" + paymentOption_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}