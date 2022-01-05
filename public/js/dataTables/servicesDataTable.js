$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var services_html = '';
    var service_status = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/services/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#services_counter").text(response.services_count);

            response.services.forEach(function(service) {

                if(service.active == 1){
                    service_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    service_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                services_html = services_html +
                
                "<div class=\"modal fade\" id=\"delete_service_"+ service.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this service </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this service to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_service("+ service.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"service_id[]\" value=\""+ service.id +"\" ></input> </td>\n" +
                "<td>"+ service.id +"</td>\n"+
                "<td>"+ service.name +"</td>\n"+
                "<td>"+ service.slug +"</td>\n"+
                "<td>"+ service.stype +"</td>\n"+
                "<td> <img src=\""+ service.page_image +"\" / style=\"width: 100px; height: 100px\"> </td>\n"+
                "<td>"+ service_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/services/"+ service.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/services/"+ service.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_service_"+ service.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#services_table_body").html(services_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var services_html = '';
    var service_status = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/services/filter",
        type: "post",
        data: {
            "rows_numbers": rows_numbers,
            "_token": csrf_token
        },
        success: function(response){

            $("#services_counter").text(response.services_count);

            response.services.forEach(function(service) {

                if(service.active == 1){
                    service_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    service_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                services_html = services_html +
                
                "<div class=\"modal fade\" id=\"delete_service_"+ service.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this service </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this service to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_service("+ service.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"service_id[]\" value=\""+ service.id +"\" ></input> </td>\n" +
                "<td>"+ service.id +"</td>\n"+
                "<td>"+ service.name +"</td>\n"+
                "<td>"+ service.slug +"</td>\n"+
                "<td>"+ service.stype +"</td>\n"+
                "<td> <img src=\""+ service.page_image +"\" / style=\"width: 100px; height: 100px\"> </td>\n"+
                "<td>"+ service_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/services/"+ service.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/services/"+ service.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_service_"+ service.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#services_table_body").html(services_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) service
function archive_service(service_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/services/" + service_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}