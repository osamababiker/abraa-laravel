window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var messages_html = '';
    var supplier_name = '';
    var buyer_name = '';
    var message_from = '';
    var is_approved = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/buyerMessages/json",
        type: "get",
        data: {"rows_numbers": rows_numbers},
        success: function(response){

            $("#messages_counter").text(response.messages_count); 
            $('#pagination').html(response.pagination); 

            response.messages.data.forEach(function(message) {

                if(message.buyer){
                    buyer_name = message.buyer.full_name;
                }

                if(message.supplier){
                    supplier_name = message.supplier.full_name;
                }

                if(message.message_from == 1){
                    message_from = "Buyer";
                }else if(message.message_from == 2){
                    message_from = "Supplier";
                }

                if(message.is_approved == 1){
                    is_approved = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_approved = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }

                messages_html = messages_html +

                // Archive modal
                "<div class=\"modal fade\" id=\"delete_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this message</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this message to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_message("+ message.id  +")\"  class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // message body modal
                "<div class=\"modal fade\" id=\"buyer_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                    "<div class=\"modal-dialog\" role=\"document\">\n"+
                        "<div class=\"modal-content\">\n"+
                            "<div class=\"modal-header\">\n"+
                                "<h5 class=\"modal-title\"> Buyers message </h5>\n"+
                                "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                    "<span aria-hidden=\"true\">&times;</span>\n"+
                                "</button>\n"+
                            "</div>\n"+
                            "<div class=\"modal-body m-3\">\n"+
                                "<p class=\"mb-0\">\n"+
                                message.message +
                                "</p>\n"+
                            "</div>\n"+
                            "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                                "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"message_id[]\" value=\""+ message.id +"\" ></input> </td>\n" +
                "<td>"+ message.id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td>"+ message_from +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#buyer_message_"+ message.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ is_approved +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buyerMessages/"+ message.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_message_"+ message.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyer_messages_table_body").html(messages_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var messages_html = '';
    var supplier_name = '';
    var buyer_name = '';
    var message_from = '';
    var is_approved = '';

    // filter data
    var supplier_name = $('#supplier_name').val(); 
    var buyer_name = $('#buyer_name').val(); 
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/buyerMessages/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'buyer_name': buyer_name,
            'supplier_name': supplier_name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#messages_counter").text(response.messages_count); 
            $('#pagination').html(response.pagination); 

            response.messages.data.forEach(function(message) {

                if(message.buyer){
                    buyer_name = message.buyer.full_name;
                }

                if(message.supplier){
                    supplier_name = message.supplier.full_name;
                }

                if(message.message_from == 1){
                    message_from = "Buyer";
                }else if(message.message_from == 2){
                    message_from = "Supplier";
                }

                if(message.is_approved == 1){
                    is_approved = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_approved = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }

                messages_html = messages_html +

                // Archive modal
                "<div class=\"modal fade\" id=\"delete_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this message</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this message to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_message("+ message.id  +")\"  class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // message body modal
                "<div class=\"modal fade\" id=\"buyer_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                    "<div class=\"modal-dialog\" role=\"document\">\n"+
                        "<div class=\"modal-content\">\n"+
                            "<div class=\"modal-header\">\n"+
                                "<h5 class=\"modal-title\"> Buyers message </h5>\n"+
                                "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                    "<span aria-hidden=\"true\">&times;</span>\n"+
                                "</button>\n"+
                            "</div>\n"+
                            "<div class=\"modal-body m-3\">\n"+
                                "<p class=\"mb-0\">\n"+
                                message.message +
                                "</p>\n"+
                            "</div>\n"+
                            "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                                "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"message_id[]\" value=\""+ message.id +"\" ></input> </td>\n" +
                "<td>"+ message.id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td>"+ message_from +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#buyer_message_"+ message.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ is_approved +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buyerMessages/"+ message.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_message_"+ message.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyer_messages_table_body").html(messages_html);

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

    var messages_html = '';
    var supplier_name = '';
    var buyer_name = '';
    var message_from = '';
    var is_approved = '';

    // filter data
    var supplier_name = $('#supplier_name').val(); 
    var buyer_name = $('#buyer_name').val(); 
    var rows_numbers = $('#rows_numbers').val();  

    $.ajax({
        url: "/buyerMessages/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'buyer_name': buyer_name,
            'supplier_name': supplier_name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#messages_counter").text(response.messages_count); 
            $('#pagination').html(response.pagination); 

            response.messages.data.forEach(function(message) {

                if(message.buyer){
                    buyer_name = message.buyer.full_name;
                }

                if(message.supplier){
                    supplier_name = message.supplier.full_name;
                }

                if(message.message_from == 1){
                    message_from = "Buyer";
                }else if(message.message_from == 2){
                    message_from = "Supplier";
                }

                if(message.is_approved == 1){
                    is_approved = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_approved = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }

                messages_html = messages_html +

                // Archive modal
                "<div class=\"modal fade\" id=\"delete_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this message</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this message to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_message("+ message.id  +")\"  class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // message body modal
                "<div class=\"modal fade\" id=\"buyer_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                    "<div class=\"modal-dialog\" role=\"document\">\n"+
                        "<div class=\"modal-content\">\n"+
                            "<div class=\"modal-header\">\n"+
                                "<h5 class=\"modal-title\"> Buyers message </h5>\n"+
                                "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                    "<span aria-hidden=\"true\">&times;</span>\n"+
                                "</button>\n"+
                            "</div>\n"+
                            "<div class=\"modal-body m-3\">\n"+
                                "<p class=\"mb-0\">\n"+
                                message.message +
                                "</p>\n"+
                            "</div>\n"+
                            "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                                "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"message_id[]\" value=\""+ message.id +"\" ></input> </td>\n" +
                "<td>"+ message.id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td>"+ message_from +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#buyer_message_"+ message.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ is_approved +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buyerMessages/"+ message.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_message_"+ message.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyer_messages_table_body").html(messages_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// to delete (archive) message
function archive_message(message_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/buyerMessages/" + message_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}