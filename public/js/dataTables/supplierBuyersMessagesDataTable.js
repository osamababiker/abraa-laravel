window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var buyers_messages_html = '';
    var supplier_name = '';
    var buyer_name = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/suppliers/"+ supplier_id +"/buyersMessages/json",
        type: "get",
        cache: false,
        data: {"rows_numbers": rows_numbers},
        success: function(response){

            $("#buyers_messages_counter").text(response.buyers_messages_count);
            $('#pagination').html(response.pagination);

            response.buyers_messages.data.forEach(function(message) {

                if(message.supplier){
                    supplier_name = message.supplier.full_name;
                }

                if(message.buyer){
                    buyer_name = message.buyer.full_name;
                }

                buyers_messages_html = buyers_messages_html +
                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/buyers_messages/"+ message.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this message</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this message to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_message("+ message.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // buyers message modal
                "<div class=\"modal fade\" id=\"buying_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
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
                "<td> <input type=\"checkbox\" class=\"message_id\" name=\"message_id[]\" value=\""+ message.id +"\" ></input> </td>\n" +
                "<td>"+ message.buyer_id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#buying_message_"+ message.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buyers_messages/"+ message.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/buyers_messages/"+ message.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_message_"+ message.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyersMessages_table_body").html(buyers_messages_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var buyers_messages_html = '';
    var supplier_name = '';
    var buyer_name = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/suppliers/"+ supplier_id +"/buyersMessages/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#buyers_messages_counter").text(response.buyers_messages_count);
            $('#pagination').html(response.pagination); 

            response.buyers_messages.data.forEach(function(message) {
                
                if(message.supplier){
                    supplier_name = message.supplier.full_name;
                }

                if(message.buyer){
                    buyer_name = message.buyer.full_name;
                }

                buyers_messages_html = buyers_messages_html +
                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/buyers_messages/"+ message.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this message</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this message to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_message("+ message.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // buyers message modal
                "<div class=\"modal fade\" id=\"buying_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
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
                "<td> <input type=\"checkbox\" class=\"message_id\" name=\"message_id[]\" value=\""+ message.id +"\" ></input> </td>\n" +
                "<td>"+ message.buyer_id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#buying_message_"+ message.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buyers_messages/"+ message.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/buyers_messages/"+ message.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_message_"+ message.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyersMessages_table_body").html(buyers_messages_html);

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

    var buyers_messages_html = '';
    var supplier_name = '';
    var buyer_name = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/suppliers/"+ supplier_id +"/buyersMessages/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#buyers_messages_counter").text(response.buyers_messages_count);
            $('#pagination').html(response.pagination); 

            response.buyers_messages.data.forEach(function(message) {
                
                if(message.supplier){
                    supplier_name = message.supplier.full_name;
                }

                if(message.buyer){
                    buyer_name = message.buyer.full_name;
                }

                buyers_messages_html = buyers_messages_html +
                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/buyers_messages/"+ message.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this message</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this message to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_message("+ message.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // buyers message modal
                "<div class=\"modal fade\" id=\"buying_message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
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
                "<td> <input type=\"checkbox\" class=\"message_id\" name=\"message_id[]\" value=\""+ message.id +"\" ></input> </td>\n" +
                "<td>"+ message.buyer_id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#buying_message_"+ message.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buyers_messages/"+ message.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/buyers_messages/"+ message.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_message_"+ message.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyersMessages_table_body").html(buyers_messages_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// to delete (archive) message
function archive_message(message_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/suppliers/buyers_messages/" + message_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}


