window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var sliders_html = '';
    var slider_status = '';
    var slider_language = '';
    var added_by = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/homeSliders/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){
            
            $("#home_sliders_counter").text(response.sliders_count);
            $('#pagination').html(response.pagination);

            response.sliders.data.forEach(function(slider) {


                if(slider.status == 1)
                    slider_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    slider_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(slider.region){
                    slider_language = slider.language.name;
                }else slider_language = '';

                if(slider.user){
                    added_by = slider.user.name;
                }else added_by = '';


                sliders_html = sliders_html +
                
                "<div class=\"modal fade\" id=\"delete_slider_"+ slider.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ slider.title +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ slider.title +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_slider("+ slider.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+ 
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"slider_id[]\" value=\""+ slider.id +"\" ></input> </td>\n" +
                "<td> <img src=\" " + slider.slider + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td> <a href=\""+ slider.link +"\" target=\"_blank\"> "+ slider.link +" </a> </td>\n"+
                "<td>"+ slider.title +"</td>\n"+
                "<td>"+ slider_language +"</td>\n"+
                "<td>"+ slider.date_added +"</td>\n"+
                "<td>"+ added_by +"</td>\n"+
                "<td>"+ slider_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/homeSliders/"+ slider.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_slider_"+ slider.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#home_sliders_table_body").html(sliders_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var sliders_html = '';
    var slider_status = '';
    var slider_language = '';
    var added_by = '';

    // filter data
    var slider_title = $('#slider_title').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/homeSliders/filter",
        type: "post",
        data: {
            'slider_title': slider_title,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
            '_token': csrf_token
        },
        success: function(response){

            $("#home_sliders_counter").text(response.sliders_count);
            $('#pagination').html(response.pagination);

            response.sliders.data.forEach(function(slider) {


                if(slider.status == 1)
                    slider_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    slider_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(slider.region){
                    slider_language = slider.language.name;
                }else slider_language = '';

                if(slider.user){
                    added_by = slider.user.name;
                }else added_by = '';


                sliders_html = sliders_html +
                
                "<div class=\"modal fade\" id=\"delete_slider_"+ slider.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ slider.title +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ slider.title +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_slider("+ slider.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"slider_id[]\" value=\""+ slider.id +"\" ></input> </td>\n" +
                "<td> <img src=\" " + slider.slider + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td> <a href=\""+ slider.link +"\" target=\"_blank\"> "+ slider.link +" </a> </td>\n"+
                "<td>"+ slider.title +"</td>\n"+
                "<td>"+ slider_language +"</td>\n"+
                "<td>"+ slider.date_added +"</td>\n"+
                "<td>"+ added_by +"</td>\n"+
                "<td>"+ slider_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/homeSliders/"+ slider.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_slider_"+ slider.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#home_sliders_table_body").html(sliders_html);

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

    var sliders_html = '';
    var slider_status = '';
    var slider_language = '';
    var added_by = '';

    // filter data
    var slider_title = $('#slider_title').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/homeSliders/filter",
        type: "post",
        data: {
            'slider_title': slider_title,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
            '_token': csrf_token
        },
        success: function(response){

            $("#home_sliders_counter").text(response.sliders_count);
            $('#pagination').html(response.pagination);

            response.sliders.data.forEach(function(slider) {


                if(slider.status == 1)
                    slider_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    slider_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(slider.region){
                    slider_language = slider.language.name;
                }else slider_language = '';

                if(slider.user){
                    added_by = slider.user.name;
                }else added_by = '';


                sliders_html = sliders_html +
                
                "<div class=\"modal fade\" id=\"delete_slider_"+ slider.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ slider.title +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ slider.title +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_slider("+ slider.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"slider_id[]\" value=\""+ slider.id +"\" ></input> </td>\n" +
                "<td> <img src=\" " + slider.slider + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td> <a href=\""+ slider.link +"\" target=\"_blank\"> "+ slider.link +" </a> </td>\n"+
                "<td>"+ slider.title +"</td>\n"+
                "<td>"+ slider_language +"</td>\n"+
                "<td>"+ slider.date_added +"</td>\n"+
                "<td>"+ added_by +"</td>\n"+
                "<td>"+ slider_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/homeSliders/"+ slider.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_slider_"+ slider.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#home_sliders_table_body").html(sliders_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) slider
function archive_slider(slider_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/homeSliders/" + slider_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}