window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () { 

    $("#ajax_loader").css('display', 'block');

    var verifications_html = '';
    var supplier_name = '';
    var is_paid = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/suppliers/"+ supplier_id +"/verifications/json",
        type: "get",
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#verifications_counter").text(response.verifications_count);
            $('#pagination').html(response.pagination);

            response.verifications.data.forEach(function(verification) {

                if(verification.supplier){
                    supplier_name = verification.supplier.full_name;
                }else supplier_name = '';

                if(verification.paid == 1){
                    is_paid = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_paid = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                verifications_html = verifications_html +
                
                // archive modal
                "<div class=\"modal fade\" id=\"delete_verification_"+ verification.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this verification</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this verification to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_verification("+ verification.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // about comany modal
                "<div class=\"modal fade\" id=\"about_company"+ verification.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                    "<div class=\"modal-dialog\" role=\"document\">\n"+
                        "<div class=\"modal-content\">\n"+
                            "<div class=\"modal-header\">\n"+
                                "<h5 class=\"modal-title\"> Buying request message </h5>\n"+
                                "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                    "<span aria-hidden=\"true\">&times;</span>\n"+
                                "</button>\n"+
                            "</div>\n"+
                            "<div class=\"modal-body m-3\">\n"+
                                "<p class=\"mb-0\">\n"+
                                verification.about_company +
                                "</p>\n"+
                            "</div>\n"+
                            "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                                "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n"+ 

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"verification_id[]\" value=\""+ verification.id +"\" ></input> </td>\n" +
                "<td>"+ verification.id +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td>"+ verification.document_uploaded +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#about_company"+ verification.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ verification.youtube_link +"</td>\n"+
                "<td>"+ is_paid +"</td>\n"+
                "<td>"+ verification.date_time +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/verifications/"+ verification.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/verifications/"+ verification.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_verification_"+ verification.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#verifications_table_body").html(verifications_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var verifications_html = '';
    var supplier_name = '';
    var is_paid = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/suppliers/"+ supplier_id +"/verifications/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#verifications_counter").text(response.verifications_count);
            $('#pagination').html(response.pagination); 

            response.verifications.data.forEach(function(verification) {

                if(verification.supplier){
                    supplier_name = verification.supplier.full_name;
                }else supplier_name = '';

                if(verification.paid == 1){
                    is_paid = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_paid = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                verifications_html = verifications_html +
                
                // archive modal
                "<div class=\"modal fade\" id=\"delete_verification_"+ verification.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this verification</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this verification to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_verification("+ verification.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // about comany modal
                "<div class=\"modal fade\" id=\"about_company"+ verification.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                    "<div class=\"modal-dialog\" role=\"document\">\n"+
                        "<div class=\"modal-content\">\n"+
                            "<div class=\"modal-header\">\n"+
                                "<h5 class=\"modal-title\"> Buying request message </h5>\n"+
                                "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                    "<span aria-hidden=\"true\">&times;</span>\n"+
                                "</button>\n"+
                            "</div>\n"+
                            "<div class=\"modal-body m-3\">\n"+
                                "<p class=\"mb-0\">\n"+
                                verification.about_company +
                                "</p>\n"+
                            "</div>\n"+
                            "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                                "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n"+ 

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"verification_id[]\" value=\""+ verification.id +"\" ></input> </td>\n" +
                "<td>"+ verification.id +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td>"+ verification.document_uploaded +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#about_company"+ verification.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ verification.youtube_link +"</td>\n"+
                "<td>"+ is_paid +"</td>\n"+
                "<td>"+ verification.date_time +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/verifications/"+ verification.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/verifications/"+ verification.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_verification_"+ verification.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#verifications_table_body").html(verifications_html);

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

    var verifications_html = '';
    var supplier_name = '';
    var is_paid = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/suppliers/"+ supplier_id +"/verifications/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#verifications_counter").text(response.verifications_count);
            $('#pagination').html(response.pagination); 

            response.verifications.data.forEach(function(verification) {

                if(verification.supplier){
                    supplier_name = verification.supplier.full_name;
                }else supplier_name = '';

                if(verification.paid == 1){
                    is_paid = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_paid = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                verifications_html = verifications_html +
                
                // archive modal
                "<div class=\"modal fade\" id=\"delete_verification_"+ verification.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this verification</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this verification to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_verification("+ verification.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // about comany modal
                "<div class=\"modal fade\" id=\"about_company"+ verification.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                    "<div class=\"modal-dialog\" role=\"document\">\n"+
                        "<div class=\"modal-content\">\n"+
                            "<div class=\"modal-header\">\n"+
                                "<h5 class=\"modal-title\"> Buying request message </h5>\n"+
                                "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                    "<span aria-hidden=\"true\">&times;</span>\n"+
                                "</button>\n"+
                            "</div>\n"+
                            "<div class=\"modal-body m-3\">\n"+
                                "<p class=\"mb-0\">\n"+
                                verification.about_company +
                                "</p>\n"+
                            "</div>\n"+
                            "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                                "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n"+ 

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"verification_id[]\" value=\""+ verification.id +"\" ></input> </td>\n" +
                "<td>"+ verification.id +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td>"+ verification.document_uploaded +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#about_company"+ verification.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ verification.youtube_link +"</td>\n"+
                "<td>"+ is_paid +"</td>\n"+
                "<td>"+ verification.date_time +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/verifications/"+ verification.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/verifications/"+ verification.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_verification_"+ verification.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#verifications_table_body").html(verifications_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// to delete (archive) verification
function archive_verification(verification_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/suppliers/verifications/" + verification_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}