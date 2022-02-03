window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var files_html = '';
    var file_item = '';
    var is_main = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/itemsFiles/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){
            
            $("#files_counter").text(response.files_count);
            $('#pagination').html(response.pagination);

            response.files.data.forEach(function(file) {

                if(file.main == 1)
                    is_main = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    is_main = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(file.item){
                    file_item = file.item.title;
                }

                files_html = files_html +
                
                "<div class=\"modal fade\" id=\"delete_file_"+ file.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this file </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this file to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_file("+ file.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+ 
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"file_id[]\" value=\""+ file.id +"\" ></input> </td>\n" +
                "<td>"+ file_item +"</td>\n"+
                "<td> <img src=\" " + file.file_url + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td>"+ is_main +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/itemsFiles/"+ file.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "<a target=\"_blank\" href=\"/itemsFiles/"+ file.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_file_"+ file.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#items_files_table_body").html(files_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var files_html = '';
    var file_item = '';
    var is_main = '';


    // filter data
    var item_title = $('#item_title').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/itemsFiles/filter",
        type: "post",
        data: {
            'item_title': item_title,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
            '_token': csrf_token
        },
        success: function(response){
            
            $("#files_counter").text(response.files_count);
            $('#pagination').html(response.pagination);

            response.files.data.forEach(function(file) {

                if(file.main == 1)
                    is_main = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    is_main = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(file.item){
                    file_item = file.item.title;
                }

                files_html = files_html +
                
                "<div class=\"modal fade\" id=\"delete_file_"+ file.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this file </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this file to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_file("+ file.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+ 
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"file_id[]\" value=\""+ file.id +"\" ></input> </td>\n" +
                "<td>"+ file_item +"</td>\n"+
                "<td> <img src=\" " + file.file_url + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td>"+ is_main +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/itemsFiles/"+ file.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "<a target=\"_blank\" href=\"/itemsFiles/"+ file.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_file_"+ file.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#items_files_table_body").html(files_html);

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

    var files_html = '';
    var file_item = '';
    var is_main = '';


    // filter data
    var itemsFiles = $('#itemsFiles').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/itemsFiles/filter",
        type: "post",
        data: {
            'itemsFiles': itemsFiles,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
            '_token': csrf_token
        },
        success: function(response){
            
            $("#files_counter").text(response.files_count);
            $('#pagination').html(response.pagination);

            response.files.data.forEach(function(file) {

                if(file.main == 1)
                    is_main = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    is_main = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(file.item){
                    file_item = file.item.title;
                }

                files_html = files_html +
                
                "<div class=\"modal fade\" id=\"delete_file_"+ file.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this file </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this file to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_file("+ file.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+ 
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"file_id[]\" value=\""+ file.id +"\" ></input> </td>\n" +
                "<td>"+ file_item +"</td>\n"+
                "<td> <img src=\" " + file.file_url + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td>"+ is_main +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/itemsFiles/"+ file.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "<a target=\"_blank\" href=\"/itemsFiles/"+ file.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_file_"+ file.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#items_files_table_body").html(files_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) file
function archive_file(file_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/itemsFiles/" + file_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}