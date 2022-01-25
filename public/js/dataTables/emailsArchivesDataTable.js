window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var emails_html = '';
    var email_status = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/emailsArchives/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#emails_counter").text(response.emails_count);
            $('#pagination').html(response.pagination);

            response.emails.data.forEach(function(email) {

                if(email.status == 1){
                    email_status = '<i class=\'fa fa-check\' style=\'color: green\'></i>';
                }else email_status = '<i class=\'fa fa-times\' style=\'color: red\'></i>';

                emails_html = emails_html +
                
                "<div class=\"modal fade\" id=\"delete_email_"+ email.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this email </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this email to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_email("+ email.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"email_id[]\" value=\""+ email.id +"\" ></input> </td>\n" +
                "<td>"+ email.id +"</td>\n"+
                "<td>"+ email.sent_to +"</td>\n"+
                "<td>"+ email.subject +"</td>\n"+
                "<td>"+ email.sent_on +"</td>\n"+
                "<td>"+ email_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/emailsArchives/"+ email.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/emailsArchives/"+ email.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_email_"+ email.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#emails_table_body").html(emails_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var emails_html = '';
    var email_status = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var email = $('#email').val();
    var subject = $('#subject').val();

    $.ajax({
        url: "/emailsArchives/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'email': email,
            'subject': subject,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#emails_counter").text(response.emails_count);
            $('#pagination').html(response.pagination);

            response.emails.data.forEach(function(email) {

                if(email.status == 1){
                    email_status = '<i class=\'fa fa-check\' style=\'color: green\'></i>';
                }else email_status = '<i class=\'fa fa-times\' style=\'color: red\'></i>';

                emails_html = emails_html +
                
                "<div class=\"modal fade\" id=\"delete_email_"+ email.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this email </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this email to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_email("+ email.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"email_id[]\" value=\""+ email.id +"\" ></input> </td>\n" +
                "<td>"+ email.id +"</td>\n"+
                "<td>"+ email.sent_to +"</td>\n"+
                "<td>"+ email.subject +"</td>\n"+
                "<td>"+ email.sent_on +"</td>\n"+
                "<td>"+ email_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/emailsArchives/"+ email.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/emailsArchives/"+ email.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_email_"+ email.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#emails_table_body").html(emails_html);

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

    var emails_html = '';
    var email_status = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var email = $('#email').val();
    var subject = $('#subject').val();

    $.ajax({
        url: "/emailsArchives/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'email': email,
            'subject': subject,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#emails_counter").text(response.emails_count);
            $('#pagination').html(response.pagination);

            response.emails.data.forEach(function(email) {

                if(email.status == 1){
                    email_status = '<i class=\'fa fa-check\' style=\'color: green\'></i>';
                }else email_status = '<i class=\'fa fa-times\' style=\'color: red\'></i>';

                emails_html = emails_html +
                
                "<div class=\"modal fade\" id=\"delete_email_"+ email.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this email </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this email to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_email("+ email.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"email_id[]\" value=\""+ email.id +"\" ></input> </td>\n" +
                "<td>"+ email.id +"</td>\n"+
                "<td>"+ email.sent_to +"</td>\n"+
                "<td>"+ email.subject +"</td>\n"+
                "<td>"+ email.sent_on +"</td>\n"+
                "<td>"+ email_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/emailsArchives/"+ email.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/emailsArchives/"+ email.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_email_"+ email.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#emails_table_body").html(emails_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) email
function archive_email(email_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/emails/" + email_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}