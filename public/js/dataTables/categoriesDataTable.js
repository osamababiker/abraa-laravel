$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var categories_html = '';
    var parent_category = '';
    var category_status = '';
    var is_home_thumb = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/categories/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#categories_counter").text(response.categories_count);

            response.categories.forEach(function(category) {

                if(category.parent){
                    parent_category = category.parent.en_title;
                }

                if(category.status == 1)
                    category_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    category_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(category.is_home_thumb == 1)
                    is_home_thumb = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    is_home_thumb = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }


                categories_html = categories_html +
                
                "<div class=\"modal fade\" id=\"delete_category_"+ category.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ category.en_title +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ category.en_title +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_category("+ category.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"category_id[]\" value=\""+ category.id +"\" ></input> </td>\n" +
                "<td>"+ category.id +"</td>\n"+
                "<td>"+ parent_category +"</td>\n"+
                "<td>"+ category.en_title +"</td>\n"+
                "<td>"+ category_status +"</td>\n"+
                "<td>"+ is_home_thumb +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/categories/"+ category.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/categories/"+ category.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_category_"+ category.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#categories_table_body").html(categories_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var categories_html = '';
    var parent_category = '';
    var category_status = '';
    var is_home_thumb = '';

    // filter data
    var category_title = $('#category_title').val(); 
    var meta_keyword = $('#meta_keyword').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/categories/filter",
        type: "post",
        data: {
            'category_title': category_title,
            'meta_keyword': meta_keyword,
            "rows_numbers": rows_numbers
        },
        success: function(response){

            $("#categories_counter").text(response.categories_count);

            response.categories.forEach(function(category) {

                if(category.parent){
                    parent_category = category.parent.en_title;
                }

                if(category.status == 1)
                    category_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    category_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(category.is_home_thumb == 1)
                    is_home_thumb = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    is_home_thumb = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }


                categories_html = categories_html +
                
                "<div class=\"modal fade\" id=\"delete_category_"+ category.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ category.en_title +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ category.en_title +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_category("+ category.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"category_id[]\" value=\""+ category.id +"\" ></input> </td>\n" +
                "<td>"+ category.id +"</td>\n"+
                "<td>"+ parent_category +"</td>\n"+
                "<td>"+ category.en_title +"</td>\n"+
                "<td>"+ category_status +"</td>\n"+
                "<td>"+ is_home_thumb +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/categories/"+ category.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/categories/"+ category.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_category_"+ category.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#categories_table_body").html(categories_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) category
function archive_category(category_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/categories/" + category_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}