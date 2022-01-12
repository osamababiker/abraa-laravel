$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var items_html = '';
    var item_category = '';
    var item_status = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/items/json",
        type: "get",
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#items_counter").text(response.items_count);

            response.items.forEach(function(item) {
                
                if(item.category){
                    item_category = item.category.en_title;
                }

                if(item.status == 1){
                    item_status = "<i style=\"color: green\">approved - <i style=\"color: green\" class=\"fa fa-check\"></i></i>";
                }else if(item.status == 0){
                    item_status = "<button type=\"button\" onclick=\"approve_item("+ item.id +")\" class=\"btn\" name=\"approve_single_item_btn\">  <i class=\"fa fa-check\"> pending - </i> </button>";
                } 
                if(item.status == 0 && item.rejected == 1){
                    item_status = "<button type=\"button\" onclick=\"approve_item("+ item.id +")\" class=\"btn\" name=\"approve_single_item_btn\"> <i style=\"color: red\">rejected - <i class=\"fa fa-times\"></i> </button>";
                } 

                items_html = items_html +
                
                "<div class=\"modal fade\" id=\"delete_item_"+ item.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ item.title +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ item.title +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_item("+ item.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"item_id[]\" value=\""+ item.id +"\" ></input> </td>\n" +
                "<td>"+ item.id +"</td>\n"+
                "<td>"+ item.title +"</td>\n"+
                "<td>"+ item_category +"</td>\n"+
                "<td> <a target=\"_blank\" href=\"http://localhost/abraa/item/"+ item.slug +"\">"+ item.slug +"</a> </td>\n"+
                "<td>"+ item_status +"</td>\n"+
                "<td>"+ item.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/items/"+ item.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/items/"+ item.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_item_"+ item.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#items_table_body").html(items_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var items_html = '';
    var item_category = '';
    var item_status = '';

    // filter data
    var product_name = $('#product_name').val(); 
    var manufacture_country = $('#manufacture_country').val(); 
    var meta_keyword = $('#meta_keyword').val(); 
    var rows_numbers = $('#rows_numbers').val(); 
    var items_status = $('#items_status').val();
    var store_status = $("#store_status").val();

    $.ajax({
        url: "/items/filter",
        type: "post",
        data: {
            'product_name': product_name,
            'manufacture_country': manufacture_country,
            'rows_numbers': rows_numbers,
            'meta_keyword': meta_keyword,
            "items_status": items_status,
            "store_status": store_status,
            "_token": csrf_token
        },
        success: function(response){

            $("#items_counter").text(response.items_count);

            response.items.forEach(function(item) {
                
                if(item.category){
                    item_category = item.category.en_title;
                }

                if(item.status == 1){
                    item_status = "<i style=\"color: green\">approved - <i style=\"color: green\" class=\"fa fa-check\"></i></i>";
                }else if(item.status == 0){
                    item_status = "<button type=\"button\" onclick=\"approve_item("+ item.id +")\" class=\"btn\" name=\"approve_single_item_btn\"> <i style=\"color: red\">rejected - <i class=\"fa fa-times\"></i> </button>";
                } 

                items_html = items_html +
                
                "<div class=\"modal fade\" id=\"delete_item_"+ item.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ item.title +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ item.title +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_item("+ item.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"item_id[]\" value=\""+ item.id +"\" ></input> </td>\n" +
                "<td>"+ item.id +"</td>\n"+
                "<td>"+ item.title +"</td>\n"+
                "<td>"+ item_category +"</td>\n"+
                "<td> <a target=\"_blank\" href=\"http://localhost/abraa/item/"+ item.slug +"\">"+ item.slug +"</a> </td>\n"+
                "<td>"+ item_status +"</td>\n"+
                "<td>"+ item.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/items/"+ item.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/items/"+ item.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_item_"+ item.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#items_table_body").html(items_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// to delete (archive) item
function archive_item(item_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/items/" + item_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}

// to approve single item
function approve_item(item_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/items/actions",
        type: "post",
        data: {
            "_token": csrf_token,
            'item_id': item_id, 
            'approve_single_item_btn': ''
        },
        success: function(response){
            location.reload();
        }
    });
}