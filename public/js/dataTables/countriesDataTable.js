window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var countries_html = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/countries/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#countries_counter").text(response.countries_count);
            $('#pagination').html(response.pagination);

            response.countries.data.forEach(function(country) {

                countries_html = countries_html +
                
                "<div class=\"modal fade\" id=\"delete_country_"+ country.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ country.en_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ country.en_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_country("+ country.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+ 
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"country_id[]\" value=\""+ country.id +"\" ></input> </td>\n" +
                "<td>"+ country.id +"</td>\n"+
                "<td>"+ country.co_code +"</td>\n"+
                "<td>"+ country.ar_name +"</td>\n"+
                "<td>"+ country.en_name +"</td>\n"+
                "<td>"+ country.ph_code +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/countries/"+ country.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/countries/"+ country.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_country_"+ country.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#countries_table_body").html(countries_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var countries_html = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var country_name = $('#country_name').val();

    $.ajax({
        url: "/countries/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'country_name': country_name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#countries_counter").text(response.countries_count);
            $('#pagination').html(response.pagination);

            response.countries.data.forEach(function(country) {

                countries_html = countries_html +
                
                "<div class=\"modal fade\" id=\"delete_country_"+ country.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ country.en_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ country.en_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_country("+ country.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"country_id[]\" value=\""+ country.id +"\" ></input> </td>\n" +
                "<td>"+ country.id +"</td>\n"+
                "<td>"+ country.co_code +"</td>\n"+
                "<td>"+ country.ar_name +"</td>\n"+
                "<td>"+ country.en_name +"</td>\n"+
                "<td>"+ country.ph_code +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/countries/"+ country.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/countries/"+ country.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_country_"+ country.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#countries_table_body").html(countries_html);

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

    var countries_html = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var country_name = $('#country_name').val();

    $.ajax({
        url: "/countries/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'country_name': country_name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#countries_counter").text(response.countries_count);
            $('#pagination').html(response.pagination);

            response.countries.data.forEach(function(country) {

                countries_html = countries_html +
                
                "<div class=\"modal fade\" id=\"delete_country_"+ country.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ country.en_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ country.en_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_country("+ country.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"country_id[]\" value=\""+ country.id +"\" ></input> </td>\n" +
                "<td>"+ country.id +"</td>\n"+
                "<td>"+ country.co_code +"</td>\n"+
                "<td>"+ country.ar_name +"</td>\n"+
                "<td>"+ country.en_name +"</td>\n"+
                "<td>"+ country.ph_code +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/countries/"+ country.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/countries/"+ country.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_country_"+ country.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#countries_table_body").html(countries_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) country
function archive_country(country_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/countries/" + country_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}