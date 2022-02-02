window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var banners_html = '';
    var banner_status = '';
    var banner_language = '';
    var added_by = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/homeBanners/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){
            
            $("#home_banners_counter").text(response.banners_count);
            $('#pagination').html(response.pagination);

            response.banners.data.forEach(function(banner) {


                if(banner.status == 1)
                    banner_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    banner_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(banner.region){
                    banner_language = banner.language.name;
                }

                if(banner.user){
                    added_by = banner.user.name;
                }


                banners_html = banners_html +
                
                "<div class=\"modal fade\" id=\"delete_banner_"+ banner.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ banner.title +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ banner.title +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_banner("+ banner.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"banner_id[]\" value=\""+ banner.id +"\" ></input> </td>\n" +
                "<td> <img src=\" " + banner.slider + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td> <a href=\""+ public_url + banner.link +"\" target=\"_blank\"> "+ banner.link +" </a> </td>\n"+
                "<td>"+ banner.title +"</td>\n"+
                "<td>"+ banner_language +"</td>\n"+ 
                "<td>"+ banner.date_added +"</td>\n"+
                "<td>"+ added_by +"</td>\n"+
                "<td>"+ banner_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/homeBanners/"+ banner.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#home_banners_table_body").html(banners_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var banners_html = '';
    var banner_status = '';
    var banner_language = '';
    var added_by = '';

    // filter data
    var banner_title = $('#banner_title').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/homeBanners/filter",
        type: "post",
        data: {
            'banner_title': banner_title,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
            '_token': csrf_token
        },
        success: function(response){

            $("#home_banners_counter").text(response.banners_count);
            $('#pagination').html(response.pagination);

            response.banners.data.forEach(function(banner) {


                if(banner.status == 1)
                    banner_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    banner_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(banner.region){
                    banner_language = banner.language.name;
                }

                if(banner.user){
                    added_by = banner.user.name;
                }


                banners_html = banners_html +
                
                "<div class=\"modal fade\" id=\"delete_banner_"+ banner.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ banner.title +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ banner.title +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_banner("+ banner.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"banner_id[]\" value=\""+ banner.id +"\" ></input> </td>\n" +
                "<td> <img src=\" " + banner.slider + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td> <a href=\""+ public_url + banner.link  +"\" target=\"_blank\"> "+ banner.link +" </a> </td>\n"+
                "<td>"+ banner.title +"</td>\n"+
                "<td>"+ banner_language +"</td>\n"+
                "<td>"+ banner.date_added +"</td>\n"+
                "<td>"+ added_by +"</td>\n"+
                "<td>"+ banner_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/homeBanners/"+ banner.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#home_banners_table_body").html(banners_html);

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

    var banners_html = '';
    var banner_status = '';
    var banner_language = '';
    var added_by = '';

    // filter data
    var banner_title = $('#banner_title').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/homeBanners/filter",
        type: "post",
        data: {
            'banner_title': banner_title,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
            '_token': csrf_token
        },
        success: function(response){

            $("#home_banners_counter").text(response.banners_count);
            $('#pagination').html(response.pagination);

            response.banners.data.forEach(function(banner) {


                if(banner.status == 1)
                    banner_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    banner_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(banner.region){
                    banner_language = banner.language.name;
                }

                if(banner.user){
                    added_by = banner.user.name;
                }


                banners_html = banners_html +
                
                "<div class=\"modal fade\" id=\"delete_banner_"+ banner.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ banner.title +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ banner.title +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_banner("+ banner.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"banner_id[]\" value=\""+ banner.id +"\" ></input> </td>\n" +
                "<td> <img src=\" " + banner.slider + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td> <a href=\""+ public_url + banner.link  +"\" target=\"_blank\"> "+ banner.link +" </a> </td>\n"+
                "<td>"+ banner.title +"</td>\n"+
                "<td>"+ banner_language +"</td>\n"+
                "<td>"+ banner.date_added +"</td>\n"+
                "<td>"+ added_by +"</td>\n"+
                "<td>"+ banner_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/homeBanners/"+ banner.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#home_banners_table_body").html(banners_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) banner
function archive_banner(banner_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/homeBanners/" + banner_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}