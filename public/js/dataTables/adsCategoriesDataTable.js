$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var adsCategories_html = '';
    var is_active = '';
    var category = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/adsCategories/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){
            
            $("#adsCategories_counter").text(response.adsCategories_count);

            response.adsCategories.forEach(function(adsCategory) {


                if(adsCategory.active == 1)
                    is_active = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    is_active = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(adsCategory.category){
                    category = adsCategory.category.en_title;
                }

                adsCategories_html = adsCategories_html +
                
                "<div class=\"modal fade\" id=\"delete_adsCategory_"+ adsCategory.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ adsCategory.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ adsCategory.name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_adsCategory("+ adsCategory.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"adsCategory_id[]\" value=\""+ adsCategory.id +"\" ></input> </td>\n" +
                "<td>"+ adsCategory.name +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td> <a href=\"\" target=\"_blank\"> ads list <i class=\"fa fa-list\"></i> </a> </td>\n"+
                "<td>"+ is_active +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/adsCategories/"+ adsCategory.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#ads_categories_table_body").html(adsCategories_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var adsCategories_html = '';
    var is_active = '';
    var category = '';

    // filter data
    var ads_category_name = $('#ads_category_name').val(); 
    var filter_by_category = $('#filter_by_category').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/adsCategories/filter",
        type: "post",
        data: {
            'filter_by_category': filter_by_category,
            'ads_category_name': ads_category_name,
            "rows_numbers": rows_numbers,
            "_token": csrf_token
        },
        success: function(response){
            
            $("#adsCategories_counter").text(response.adsCategories_count);

            response.adsCategories.forEach(function(adsCategory) {


                if(adsCategory.active == 1)
                    is_active = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    is_active = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(adsCategory.category){
                    category = adsCategory.category.en_title;
                }

                adsCategories_html = adsCategories_html +
                
                "<div class=\"modal fade\" id=\"delete_adsCategory_"+ adsCategory.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ adsCategory.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ adsCategory.name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_adsCategory("+ adsCategory.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"adsCategory_id[]\" value=\""+ adsCategory.id +"\" ></input> </td>\n" +
                "<td>"+ adsCategory.name +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td> <a href=\"\" target=\"_blank\"> ads list <i class=\"fa fa-list\"></i> </a> </td>\n"+
                "<td>"+ is_active +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/adsCategories/"+ adsCategory.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#ads_categories_table_body").html(adsCategories_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) adsCategory
function archive_adsCategory(category_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/adsCategories/" + category_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}