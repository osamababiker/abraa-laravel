window.current_page = 1; 
// ==============================================================//
// when the pavillion is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var pavillions_html = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/pavillions/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#pavillions_counter").text(response.pavillions_count);
            $('#pagination').html(response.pagination);

            response.pavillions.data.forEach(function(pavillion) {

                pavillions_html = pavillions_html +
                
                "<div class=\"modal fade\" id=\"delete_pavillion_"+ pavillion.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this "+ pavillion.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this pavillion to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_pavillion("+ pavillion.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"pavillion_id[]\" value=\""+ pavillion.id +"\" ></input> </td>\n" +
                "<td>"+ pavillion.id +"</td>\n"+
                "<td>"+ pavillion.name +"</td>\n"+
                "<td>"+ pavillion.slug +"</td>\n"+
                "<td> <img src=\""+ pavillion.logo +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.main_banner +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.right_banner_1 +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.right_banner_2 +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.left_banner +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/pavillions/"+ pavillion.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/pavillions/"+ pavillion.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_pavillion_"+ pavillion.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#pavillions_table_body").html(pavillions_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var pavillions_html = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var name = $('#name').val();

    $.ajax({
        url: "/pavillions/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'name': name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#pavillions_counter").text(response.pavillions_count);
            $('#pagination').html(response.pagination);

            response.pavillions.data.forEach(function(pavillion) {

                pavillions_html = pavillions_html +
                
                "<div class=\"modal fade\" id=\"delete_pavillion_"+ pavillion.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this "+ pavillion.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this pavillion to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_pavillion("+ pavillion.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"pavillion_id[]\" value=\""+ pavillion.id +"\" ></input> </td>\n" +
                "<td>"+ pavillion.id +"</td>\n"+
                "<td>"+ pavillion.name +"</td>\n"+
                "<td>"+ pavillion.slug +"</td>\n"+
                "<td> <img src=\""+ pavillion.logo +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.main_banner +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.right_banner_1 +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.right_banner_2 +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.left_banner +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/pavillions/"+ pavillion.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/pavillions/"+ pavillion.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_pavillion_"+ pavillion.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#pavillions_table_body").html(pavillions_html);

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

    var pavillions_html = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var name = $('#name').val();

    $.ajax({
        url: "/pavillions/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'name': name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#pavillions_counter").text(response.pavillions_count);
            $('#pagination').html(response.pagination);

            response.pavillions.data.forEach(function(pavillion) {

                pavillions_html = pavillions_html +
                
                "<div class=\"modal fade\" id=\"delete_pavillion_"+ pavillion.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this "+ pavillion.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this pavillion to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_pavillion("+ pavillion.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"pavillion_id[]\" value=\""+ pavillion.id +"\" ></input> </td>\n" +
                "<td>"+ pavillion.id +"</td>\n"+
                "<td>"+ pavillion.name +"</td>\n"+
                "<td>"+ pavillion.slug +"</td>\n"+
                "<td> <img src=\""+ pavillion.logo +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.main_banner +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.right_banner_1 +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.right_banner_2 +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td> <img src=\""+ pavillion.left_banner +"\" alt=\""+ pavillion.name +"\" width=\"150\" height=\"150\" /> </td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/pavillions/"+ pavillion.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/pavillions/"+ pavillion.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_pavillion_"+ pavillion.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#pavillions_table_body").html(pavillions_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) pavillion
function archive_pavillion(pavillion_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/pavillions/" + pavillion_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}