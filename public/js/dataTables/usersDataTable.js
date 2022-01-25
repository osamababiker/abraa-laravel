window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var users_html = '';
    var user_level = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/users/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#users_counter").text(response.users_count);
            $('#pagination').html(response.pagination);

            response.users.data.forEach(function(user) {

                if(user.userlevel == 1){
                    user_level = 'Admin';
                }

                users_html = users_html +
                
                "<div class=\"modal fade\" id=\"delete_user_"+ user.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ user.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ user.name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_user("+ user.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"user_id[]\" value=\""+ user.id +"\" ></input> </td>\n" +
                "<td>"+ user.id +"</td>\n"+
                "<td>"+ user.name +"</td>\n"+
                "<td>"+ user.username +"</td>\n"+
                "<td>"+ user.password +"</td>\n"+
                "<td>"+ user.email +"</td>\n"+
                "<td>"+ user_level +"</td>\n"+ 
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/users/"+ user.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/users/"+ user.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_user_"+ user.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#users_table_body").html(users_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var users_html = '';
    var user_level = '';

    // filter data
    var name = $('#name').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/users/filter",
        type: "post",
        data: {
            'name': name,
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            "_token": csrf_token
        },
        success: function(response){

            $("#users_counter").text(response.users_count);
            $('#pagination').html(response.pagination);

            response.users.data.forEach(function(user) {

                if(user.userlevel == 1){
                    user_level = 'Admin';
                }

                users_html = users_html +
                
                "<div class=\"modal fade\" id=\"delete_user_"+ user.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ user.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ user.name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_user("+ user.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"user_id[]\" value=\""+ user.id +"\" ></input> </td>\n" +
                "<td>"+ user.id +"</td>\n"+
                "<td>"+ user.name +"</td>\n"+
                "<td>"+ user.username +"</td>\n"+
                "<td>"+ user.password +"</td>\n"+
                "<td>"+ user.email +"</td>\n"+
                "<td>"+ user_level +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/users/"+ user.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/users/"+ user.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_user_"+ user.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#users_table_body").html(users_html);

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

    var users_html = '';
    var user_level = '';

    // filter data
    var name = $('#name').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/users/filter",
        type: "post",
        data: {
            'name': name,
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            "_token": csrf_token
        },
        success: function(response){

            $("#users_counter").text(response.users_count);
            $('#pagination').html(response.pagination);

            response.users.data.forEach(function(user) {

                if(user.userlevel == 1){
                    user_level = 'Admin';
                }

                users_html = users_html +
                
                "<div class=\"modal fade\" id=\"delete_user_"+ user.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ user.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ user.name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_user("+ user.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"user_id[]\" value=\""+ user.id +"\" ></input> </td>\n" +
                "<td>"+ user.id +"</td>\n"+
                "<td>"+ user.name +"</td>\n"+
                "<td>"+ user.username +"</td>\n"+
                "<td>"+ user.password +"</td>\n"+
                "<td>"+ user.email +"</td>\n"+
                "<td>"+ user_level +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/users/"+ user.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/users/"+ user.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_user_"+ user.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#users_table_body").html(users_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) user
function archive_user(user_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/users/" + user_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}