window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var moderators_html = '';
    var is_verified = '';
    var is_organic = '';
    var country = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/moderators/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#moderators_counter").text(response.moderators_count);
            $('#pagination').html(response.pagination);

            response.moderators.data.forEach(function(moderator) {

                if(moderator.is_organic == 1){
                    is_organic  = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_organic  = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(moderator.verified == 1){
                    is_verified  = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_verified  = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(moderator.member_country){
                    country = moderator.member_country.en_name;
                }

                moderators_html = moderators_html +
                
                "<div class=\"modal fade\" id=\"delete_moderator_"+ moderator.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ moderator.full_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ moderator.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_moderator("+ moderator.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"moderator_id[]\" value=\""+ moderator.id +"\" ></input> </td>\n" +
                "<td>"+ moderator.id +"</td>\n"+
                "<td>"+ moderator.full_name +"</td>\n"+
                "<td>"+ moderator.email +"</td>\n"+
                "<td>"+ moderator.phone +"</td>\n"+
                "<td>"+ moderator.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ moderator.company +"</td>\n"+
                "<td>"+ is_organic +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/moderators/"+ moderator.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/moderators/"+ moderator.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_moderator_"+ moderator.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#moderators_table_body").html(moderators_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var moderators_html = '';
    var is_verified = '';
    var is_organic = '';
    var country = '';

    // filter data
    var moderator_name = $('#moderator_name').val(); 
    var countries = $('#countries').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/moderators/filter",
        type: "post",
        data: {
            'moderator_name': moderator_name,
            'countries': countries,
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#moderators_counter").text(response.moderators_count);
            $('#pagination').html(response.pagination);

            response.moderators.data.forEach(function(moderator) {

                if(moderator.is_organic == 1){
                    is_organic  = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_organic  = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(moderator.verified == 1){
                    is_verified  = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_verified  = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(moderator.member_country){
                    country = moderator.member_country.en_name;
                }

                moderators_html = moderators_html +
                
                "<div class=\"modal fade\" id=\"delete_moderator_"+ moderator.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ moderator.full_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ moderator.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_moderator("+ moderator.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"moderator_id[]\" value=\""+ moderator.id +"\" ></input> </td>\n" +
                "<td>"+ moderator.id +"</td>\n"+
                "<td>"+ moderator.full_name +"</td>\n"+
                "<td>"+ moderator.email +"</td>\n"+
                "<td>"+ moderator.phone +"</td>\n"+
                "<td>"+ moderator.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ moderator.company +"</td>\n"+
                "<td>"+ is_organic +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/moderators/"+ moderator.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/moderators/"+ moderator.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_moderator_"+ moderator.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#moderators_table_body").html(moderators_html);

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

    var moderators_html = '';
    var is_verified = '';
    var is_organic = '';
    var country = '';

    // filter data
    var moderator_name = $('#moderator_name').val(); 
    var countries = $('#countries').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/moderators/filter",
        type: "post",
        data: {
            'moderator_name': moderator_name,
            'countries': countries,
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#moderators_counter").text(response.moderators_count);
            $('#pagination').html(response.pagination);

            response.moderators.data.forEach(function(moderator) {

                if(moderator.is_organic == 1){
                    is_organic  = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_organic  = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(moderator.verified == 1){
                    is_verified  = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_verified  = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(moderator.member_country){
                    country = moderator.member_country.en_name;
                }

                moderators_html = moderators_html +
                
                "<div class=\"modal fade\" id=\"delete_moderator_"+ moderator.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ moderator.full_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ moderator.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_moderator("+ moderator.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"moderator_id[]\" value=\""+ moderator.id +"\" ></input> </td>\n" +
                "<td>"+ moderator.id +"</td>\n"+
                "<td>"+ moderator.full_name +"</td>\n"+
                "<td>"+ moderator.email +"</td>\n"+
                "<td>"+ moderator.phone +"</td>\n"+
                "<td>"+ moderator.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ moderator.company +"</td>\n"+
                "<td>"+ is_organic +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/moderators/"+ moderator.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/moderators/"+ moderator.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_moderator_"+ moderator.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#moderators_table_body").html(moderators_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) moderator
function archive_moderator(moderator_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/moderators/" + moderator_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}