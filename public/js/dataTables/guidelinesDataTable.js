window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var guidelines_html = '';
    var is_active = '';
    var guideline_type = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/guidelines/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){
            
            $("#guidelines_counter").text(response.guidelines_count);
            $('#pagination').html(response.pagination);

            response.guidelines.data.forEach(function(guideline) {

                if(guideline.active == 1){
                    is_active = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else is_active = "<i class=\"fa fa-times\" style=\"color: red\"></i>";

                if(guideline.type){
                    guideline_type = guideline.type.guideline_type;
                }

                guidelines_html = guidelines_html +
                
                "<div class=\"modal fade\" id=\"delete_guideline_"+ guideline.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this guideline  </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this guideline to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_guideline("+ guideline.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"guideline_id[]\" value=\""+ guideline.id +"\" ></input> </td>\n" +
                "<td>"+ guideline.id +"</td>\n"+
                "<td>"+ guideline_type +"</td>\n"+
                "<td>"+ guideline.en_title +"</td>\n"+
                "<td>"+ guideline.ar_title +"</td>\n"+
                "<td>"+ is_active +"</td>\n"+
                "<td>"+ guideline.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/guidelines/"+ guideline.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/guidelines/"+ guideline.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_guideline_"+ guideline.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#guidelines_table_body").html(guidelines_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var guidelines_html = '';
    var is_active = '';
    var guideline_type = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var title = $('#title').val();

    $.ajax({
        url: "/guidelines/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'title': title,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){
            
            $("#guidelines_counter").text(response.guidelines_count);
            $('#pagination').html(response.pagination);

            response.guidelines.data.forEach(function(guideline) {

                if(guideline.active == 1){
                    is_active = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else is_active = "<i class=\"fa fa-times\" style=\"color: red\"></i>";

                if(guideline.type){
                    guideline_type = guideline.type.guideline_type;
                }

                guidelines_html = guidelines_html +
                
                "<div class=\"modal fade\" id=\"delete_guideline_"+ guideline.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this guideline  </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this guideline to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_guideline("+ guideline.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"guideline_id[]\" value=\""+ guideline.id +"\" ></input> </td>\n" +
                "<td>"+ guideline.id +"</td>\n"+
                "<td>"+ guideline_type +"</td>\n"+
                "<td>"+ guideline.en_title +"</td>\n"+
                "<td>"+ guideline.ar_title +"</td>\n"+
                "<td>"+ is_active +"</td>\n"+
                "<td>"+ guideline.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/guidelines/"+ guideline.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/guidelines/"+ guideline.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_guideline_"+ guideline.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#guidelines_table_body").html(guidelines_html);

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

    var guidelines_html = '';
    var is_active = '';
    var guideline_type = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var title = $('#title').val();

    $.ajax({
        url: "/guidelines/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'title': title,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){
            
            $("#guidelines_counter").text(response.guidelines_count);
            $('#pagination').html(response.pagination);

            response.guidelines.data.forEach(function(guideline) {

                if(guideline.active == 1){
                    is_active = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else is_active = "<i class=\"fa fa-times\" style=\"color: red\"></i>";

                if(guideline.type){
                    guideline_type = guideline.type.guideline_type;
                }

                guidelines_html = guidelines_html +
                
                "<div class=\"modal fade\" id=\"delete_guideline_"+ guideline.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this guideline  </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this guideline to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_guideline("+ guideline.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"guideline_id[]\" value=\""+ guideline.id +"\" ></input> </td>\n" +
                "<td>"+ guideline.id +"</td>\n"+
                "<td>"+ guideline_type +"</td>\n"+
                "<td>"+ guideline.en_title +"</td>\n"+
                "<td>"+ guideline.ar_title +"</td>\n"+
                "<td>"+ is_active +"</td>\n"+
                "<td>"+ guideline.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/guidelines/"+ guideline.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/guidelines/"+ guideline.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_guideline_"+ guideline.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#guidelines_table_body").html(guidelines_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) guideline
function archive_guideline(guideline_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/guidelines/" + guideline_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}