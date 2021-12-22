$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var ads_html = '';
    var is_active = '';
    var category = '';
    var language = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/ads/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){
            
            $("#ads_counter").text(response.ads_count);

            response.ads.forEach(function(ads) {


                if(ads.active == 1)
                    is_active = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    is_active = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(ads.category){
                    category = ads.category.name;
                }

                if(ads.language){
                    language = ads.language.name;
                }


                ads_html = ads_html +
                
                "<div class=\"modal fade\" id=\"delete_ads_"+ ads.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ ads.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ ads.name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_ads("+ ads.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+ 

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"ads_id[]\" value=\""+ ads.id +"\" ></input> </td>\n" +
                "<td>"+ ads.name +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td> <img src=\""+ ads.pic_url +"\" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td> <a href=\""+ ads.link +"\" target=\"_blank\"> "+ ads.link +" <i class=\"fa fa-list\"></i> </a> </td>\n"+
                "<td>"+ ads.start_on +"</td>\n"+
                "<td>"+ ads.expire_on +"</td>\n"+
                "<td>"+ ads.views +"</td>\n"+
                "<td>"+ ads.clicks +"</td>\n"+
                "<td>"+ is_active +"</td>\n"+
                "<td>"+ ads.alt_txt +"</td>\n"+
                "<td>"+ language +"</td>\n"+
                "<td>"+ ads.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/ads/"+ ads.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/ads/"+ ads.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_ads_"+ ads.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#ads_categories_table_body").html(ads_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var ads_html = '';
    var is_active = '';
    var category = '';
    var language = '';

    // filter data
    var ads_name = $('#ads_name').val(); 
    var filter_by_category = $('#filter_by_category').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/ads/filter",
        type: "post",
        data: {
            'filter_by_category': filter_by_category,
            'ads_name': ads_name,
            "rows_numbers": rows_numbers
        },
        success: function(response){
            
            $("#ads_counter").text(response.ads_count);

            response.ads.forEach(function(ads) {


                if(ads.active == 1)
                    is_active = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    is_active = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(ads.category){
                    category = ads.category.name;
                }

                if(ads.language){
                    language = ads.language.name;
                }

                ads_html = ads_html +
                
                "<div class=\"modal fade\" id=\"delete_ads_"+ ads.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ ads.name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ ads.name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_ads("+ ads.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+ 

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"ads_id[]\" value=\""+ ads.id +"\" ></input> </td>\n" +
                "<td>"+ ads.name +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td> <img src=\""+ ads.pic_url +"\" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td> <a href=\""+ ads.link +"\" target=\"_blank\"> "+ ads.link +" <i class=\"fa fa-list\"></i> </a> </td>\n"+
                "<td>"+ ads.start_on +"</td>\n"+
                "<td>"+ ads.expire_on +"</td>\n"+
                "<td>"+ ads.views +"</td>\n"+
                "<td>"+ ads.clicks +"</td>\n"+
                "<td>"+ is_active +"</td>\n"+
                "<td>"+ ads.alt_txt +"</td>\n"+
                "<td>"+ language +"</td>\n"+
                "<td>"+ ads.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/ads/"+ ads.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/ads/"+ ads.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_ads_"+ ads.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#ads_categories_table_body").html(ads_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) ads
function archive_ads(ads_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/ads/" + ads_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}