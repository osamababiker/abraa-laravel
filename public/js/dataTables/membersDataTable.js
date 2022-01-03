
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

            response.members.forEach(function(member) {

                if(member.user_country){
                    member_country = member.user_country.en_name;
                }

                if(member.user){
                    full_name = member.user.full_name;
                }

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
                "<td> <input type=\"checkbox\" name=\"member_id[]\" value=\""+ member.id +"\" ></input> </td>\n" +
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



$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var members_html = '';
    var member_country = '';
    var is_login = '';
    var is_returning = '';

    // filter data
    var countries = $('#filter_by_country').val(); 
    var member_name = $('#member_name').val(); 
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/members/filter",
        type: "post",
        data: {
            'countries': countries,
            'rows_numbers': rows_numbers,
            'member_name': member_name
        },
        success: function(response){

            $("#members_counter").text(response.members_count);

            response.members.forEach(function(member) {

                if(member.member_country){
                    member_country = member.member_country.en_name;
                }

                if(member.is_login == 1){
                    is_login = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_login = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(member.is_login == 1){
                    is_login = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_login = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
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
                "<td> <input type=\"checkbox\" name=\"member_id[]\" value=\""+ member.id +"\" ></input> </td>\n" +
                "<td>"+ member.id +"</td>\n"+
                "<td>"+ member.full_name +"</td>\n"+
                "<td>"+ member.last_ip +"</td>\n"+
                "<td>"+ member_country +"</td>\n"+
                "<td>"+ is_login +"</td>\n"+
                "<td>"+ is_returning +"</td>\n"+
                "<td> </td>"+
                "<td> </td>"+
                "<td> </td>"+
                "<td> </td>"+
                "<td> </td>"+
                "<td> </td>"+
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