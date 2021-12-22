$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var membershipsPlans_html = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/membershipsPlans/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){
            
            $("#memberships_plans_counter").text(response.membershipsPlans_count);

            response.membershipsPlans.forEach(function(plan) {

                membershipsPlans_html = membershipsPlans_html +
                
                "<div class=\"modal fade\" id=\"delete_plan_"+ plan.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ plan.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ plan.name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_plan("+ plan.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"plan_id[]\" value=\""+ plan.id +"\" ></input> </td>\n" +
                "<td>"+ plan.id +"</td>\n"+
                "<td>"+ plan.code +"</td>\n"+
                "<td>"+ plan.name +"</td>\n"+
                "<td>"+ plan.short_description +"</td>\n"+
                "<td>"+ plan.package_price +"</td>\n"+
                "<td>"+ plan.duration +"</td>\n"+
                "<td>"+ plan.sales +"</td>\n"+
                "<td>"+ plan.country_code +"</td>\n"+
                "<td>"+ plan.created_on +"</td>\n"+
                "<td>"+ plan.modified_on +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/membershipsPlans/"+ plan.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/membershipsPlans/"+ plan.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_plan_"+ plan.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#memberships_plans_table_body").html(membershipsPlans_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var membershipsPlans_html = '';

    // filter data
    var memberships_plan_name = $('#memberships_plan_name').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/membershipsPlans/filter",
        type: "post",
        data: {
            'memberships_plan_name': memberships_plan_name,
            "rows_numbers": rows_numbers
        },
        success: function(response){
            
            $("#memberships_plans_counter").text(response.membershipsPlans_count);

            response.membershipsPlans.forEach(function(plan) {

                membershipsPlans_html = membershipsPlans_html +
                
                "<div class=\"modal fade\" id=\"delete_plan_"+ plan.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ plan.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ plan.name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_plan("+ plan.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"plan_id[]\" value=\""+ plan.id +"\" ></input> </td>\n" +
                "<td>"+ plan.id +"</td>\n"+
                "<td>"+ plan.code +"</td>\n"+
                "<td>"+ plan.name +"</td>\n"+
                "<td>"+ plan.short_description +"</td>\n"+
                "<td>"+ plan.package_price +"</td>\n"+
                "<td>"+ plan.duration +"</td>\n"+
                "<td>"+ plan.sales +"</td>\n"+
                "<td>"+ plan.country_code +"</td>\n"+
                "<td>"+ plan.created_on +"</td>\n"+
                "<td>"+ plan.modified_on +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/membershipsPlans/"+ plan.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/membershipsPlans/"+ plan.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_plan_"+ plan.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#memberships_plans_table_body").html(membershipsPlans_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) plan
function archive_plan(category_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/membershipsPlans/" + category_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}