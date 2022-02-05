window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var messages_html = '';
    var username = '';
    var is_read = '';
    var sent_by = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/abraaMessages/json",
        type: "get",
        data: {"rows_numbers": rows_numbers},
        success: function(response){

            $("#messages_counter").text(response.messages_count); 
            $('#pagination').html(response.pagination); 

            response.messages.data.forEach(function(message) {

                if(message.user){
                    username = message.user.full_name;
                }

                if(message.sender){
                    sent_by = message.sender.name;
                }

                if(message.message_read == 1){
                    is_read = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else is_read = "<i class=\"fa fa-times\" style=\"color: red\"></i>";

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
                "<div class=\"modal fade\" id=\"message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
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
                "<td>"+ username +"</td>\n"+
                "<td>"+ message.subject +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#message_"+ message.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ message.datetime +"</td>"+
                "<td>"+ is_read +"</td>"+
                "<td>"+ message.read_at +"</td>"+
                "<td>"+ sent_by +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/abraaMessages/"+ message.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_message_"+ message.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#messages_table_body").html(messages_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var messages_html = '';
    var username = '';
    var is_read = '';
    var sent_by = '';

    // filter data
    var username = $('#username').val(); 
    var subject = $('#subject').val(); 
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/abraaMessages/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'subject': subject,
            'username': username,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#messages_counter").text(response.messages_count); 
            $('#pagination').html(response.pagination); 

            response.messages.data.forEach(function(message) {

                if(message.user){
                    username = message.user.full_name;
                }

                if(message.sender){
                    sent_by = message.sender.name;
                }

                if(message.message_read == 1){
                    is_read = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else is_read = "<i class=\"fa fa-times\" style=\"color: red\"></i>";

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
                "<div class=\"modal fade\" id=\"message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
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
                "<td>"+ username +"</td>\n"+
                "<td>"+ message.subject +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#message_"+ message.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ message.datetime +"</td>"+
                "<td>"+ is_read +"</td>"+
                "<td>"+ message.read_at +"</td>"+
                "<td>"+ sent_by +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/abraaMessages/"+ message.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_message_"+ message.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#messages_table_body").html(messages_html);

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
    var username = '';
    var is_read = '';
    var sent_by = '';

    // filter data
    var username = $('#username').val(); 
    var subject = $('#subject').val(); 
    var rows_numbers = $('#rows_numbers').val();  

    $.ajax({
        url: "/abraaMessages/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'subject': subject,
            'username': username,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#messages_counter").text(response.messages_count); 
            $('#pagination').html(response.pagination); 

            response.messages.data.forEach(function(message) {

                if(message.user){
                    username = message.user.full_name;
                }

                if(message.sender){
                    sent_by = message.sender.name;
                }

                if(message.message_read == 1){
                    is_read = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else is_read = "<i class=\"fa fa-times\" style=\"color: red\"></i>";

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
                "<div class=\"modal fade\" id=\"message_"+ message.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
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
                "<td>"+ username +"</td>\n"+
                "<td>"+ message.subject +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#message_"+ message.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ message.datetime +"</td>"+
                "<td>"+ is_read +"</td>"+
                "<td>"+ message.read_at +"</td>"+
                "<td>"+ sent_by +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/abraaMessages/"+ message.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_message_"+ message.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#messages_table_body").html(messages_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// to delete (archive) message
function archive_message(message_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/abraaMessages/" + message_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}