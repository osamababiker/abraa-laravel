window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var members_html = '';
    var member_country = '';
    var is_loggedin = '';
    var is_returning = '';
    var full_name = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/members/json",
        type: "get",
        data: {"rows_numbers": rows_numbers},
        success: function(response){

            $("#members_counter").text(response.members_count);
            $('#pagination').html(response.pagination);

            response.members.data.forEach(function(member) {

                if(member.user_country){
                    member_country = member.user_country.en_name;
                }else member_country = '';

                if(member.user){
                    full_name = member.user.full_name;
                }else full_name = '';

                if(member.is_loggedin == 1){
                    is_loggedin = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_loggedin = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(member.is_returning == 1){
                    is_returning = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_returning = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                

                members_html = members_html +
                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_member_"+ member.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/members/"+ member.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ member.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ member.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_member("+ member.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"member_id[]\" value=\""+ member.id +"\" ></input> </td>\n" +
                "<td>"+ member.id +"</td>\n"+
                "<td>"+ full_name +"</td>\n"+
                "<td>"+ member.user_ip +"</td>\n"+
                "<td>"+ member_country +"</td>\n"+
                "<td>"+ is_loggedin +"</td>\n"+
                "<td>"+ is_returning +"</td>\n"+
                "<td>"+ member.visits_count +"</td>\n"+
                "<td> <a target=\"_blank\" href=\""+ member.page_url +"\"> "+ member.page_url +" </a> </td>"+
                "<td> "+ member.total_time_inseconds +" </td>"+
                "<td> "+ member.searched_items +" </td>"+
                "<td> "+ member.datevsiited +" </td>"+
                "<td> "+ member.timevisited +" </td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/members/"+ member.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/members/"+ member.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_member_"+ member.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#members_table_body").html(members_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var members_html = '';
    var member_country = '';
    var is_loggedin = '';
    var is_returning = '';
    var full_name = '';

    // filter data
    var countries = $('#filter_by_country').val(); 
    var member_name = $('#member_name').val(); 
    var date_range = $('#date_range').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/members/filter",
        type: "post",
        data: {
            'countries': countries,
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            'date_range': date_range,
            'member_name': member_name,
            '_token': csrf_token
        },
        success: function(response){

            $("#members_counter").text(response.members_count);
            $('#pagination').html(response.pagination);

            response.members.data.forEach(function(member) {

                if(member.user_country){
                    member_country = member.user_country.en_name;
                }else member_country = '';

                if(member.user){
                    full_name = member.user.full_name;
                }else full_name = '';

                if(member.is_loggedin == 1){
                    is_loggedin = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_loggedin = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(member.is_returning == 1){
                    is_returning = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_returning = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                

                members_html = members_html +
                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_member_"+ member.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/members/"+ member.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ member.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ member.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_member("+ member.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"member_id[]\" value=\""+ member.id +"\" ></input> </td>\n" +
                "<td>"+ member.id +"</td>\n"+
                "<td>"+ full_name +"</td>\n"+
                "<td>"+ member.user_ip +"</td>\n"+
                "<td>"+ member_country +"</td>\n"+
                "<td>"+ is_loggedin +"</td>\n"+
                "<td>"+ is_returning +"</td>\n"+
                "<td>"+ member.visits_count +"</td>\n"+
                "<td> <a target=\"_blank\" href=\""+ member.page_url +"\"> "+ member.page_url +" </a> </td>"+
                "<td> "+ member.total_time_inseconds +" </td>"+
                "<td> "+ member.searched_items +" </td>"+
                "<td> "+ member.datevsiited +" </td>"+
                "<td> "+ member.timevisited +" </td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/members/"+ member.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/members/"+ member.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_member_"+ member.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#members_table_body").html(members_html);

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

    var members_html = '';
    var member_country = '';
    var is_loggedin = '';
    var is_returning = '';
    var full_name = '';

    // filter data
    var countries = $('#filter_by_country').val(); 
    var member_name = $('#member_name').val(); 
    var date_range = $('#date_range').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/members/filter",
        type: "post",
        data: {
            'countries': countries,
            'rows_numbers': rows_numbers,
            'date_range': date_range,
            'current_page': window.current_page,
            'member_name': member_name,
            '_token': csrf_token
        },
        success: function(response){

            $("#members_counter").text(response.members_count);
            $('#pagination').html(response.pagination);

            response.members.data.forEach(function(member) {

                if(member.user_country){
                    member_country = member.user_country.en_name;
                }else member_country = '';

                if(member.user){
                    full_name = member.user.full_name;
                }else full_name = '';

                if(member.is_loggedin == 1){
                    is_loggedin = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_loggedin = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(member.is_returning == 1){
                    is_returning = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_returning = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                

                members_html = members_html +
                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_member_"+ member.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/members/"+ member.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ member.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ member.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_member("+ member.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"member_id[]\" value=\""+ member.id +"\" ></input> </td>\n" +
                "<td>"+ member.id +"</td>\n"+
                "<td>"+ full_name +"</td>\n"+
                "<td>"+ member.user_ip +"</td>\n"+
                "<td>"+ member_country +"</td>\n"+
                "<td>"+ is_loggedin +"</td>\n"+
                "<td>"+ is_returning +"</td>\n"+
                "<td>"+ member.visits_count +"</td>\n"+
                "<td> <a target=\"_blank\" href=\""+ member.page_url +"\"> "+ member.page_url +" </a> </td>"+
                "<td> "+ member.total_time_inseconds +" </td>"+
                "<td> "+ member.searched_items +" </td>"+
                "<td> "+ member.datevsiited +" </td>"+
                "<td> "+ member.timevisited +" </td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/members/"+ member.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/members/"+ member.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_member_"+ member.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#members_table_body").html(members_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// to delete (archive) member
function archive_member(member_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/members/" + member_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}