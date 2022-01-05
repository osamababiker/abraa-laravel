$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var units_html = '';
    var is_active = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/units/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#units_counter").text(response.units_count);

            response.units.forEach(function(unit) {

                if(unit.active == 1){
                    is_active = "<i class=\"fa fa-check\" style=\"color: green\">";
                }else {
                    is_active = "<i class=\"fa fa-times\" style=\"color: red\">";
                }

                units_html = units_html +
                
                "<div class=\"modal fade\" id=\"delete_unit_"+ unit.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ unit.unit_en +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ unit.unit_en +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_unit("+ unit.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"unit_id[]\" value=\""+ unit.id +"\" ></input> </td>\n" +
                "<td>"+ unit.id +"</td>\n"+
                "<td>"+ unit.unit_en +"</td>\n"+
                "<td>"+ unit.unit_ar +"</td>\n"+
                "<td>"+ unit.unit_cn +"</td>\n"+
                "<td>"+ unit.unit_ru +"</td>\n"+
                "<td>"+ unit.unit_tr +"</td>\n"+
                "<td>"+ unit.unit_pr +"</td>\n"+
                "<td>"+ is_active +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/units/"+ unit.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/units/"+ unit.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_unit_"+ unit.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#units_table_body").html(units_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var units_html = '';
    var is_active = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var unit_name = $("#unit_name").val();

    $.ajax({
        url: "/units/filter",
        type: "post",
        data: {
            "rows_numbers": rows_numbers,
            "unit_name": unit_name,
            "_token": csrf_token
        },
        success: function(response){

            $("#units_counter").text(response.units_count);

            response.units.forEach(function(unit) {

                if(unit.active == 1){
                    is_active = "<i class=\"fa fa-check\" style=\"color: green\">";
                }else {
                    is_active = "<i class=\"fa fa-times\" style=\"color: red\">";
                }

                units_html = units_html +
                
                "<div class=\"modal fade\" id=\"delete_unit_"+ unit.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ unit.unit_en +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ unit.unit_en +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_unit("+ unit.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"unit_id[]\" value=\""+ unit.id +"\" ></input> </td>\n" +
                "<td>"+ unit.id +"</td>\n"+
                "<td>"+ unit.unit_en +"</td>\n"+
                "<td>"+ unit.unit_ar +"</td>\n"+
                "<td>"+ unit.unit_cn +"</td>\n"+
                "<td>"+ unit.unit_ru +"</td>\n"+
                "<td>"+ unit.unit_tr +"</td>\n"+
                "<td>"+ unit.unit_pr +"</td>\n"+
                "<td>"+ is_active +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/units/"+ unit.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/units/"+ unit.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_unit_"+ unit.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#units_table_body").html(units_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) unit
function archive_unit(unit_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/units/" + unit_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}