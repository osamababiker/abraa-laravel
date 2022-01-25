window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var currencies_html = '';
    var currency_status = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/currencies/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#currencies_counter").text(response.currencies_count);
            $('#pagination').html(response.pagination);

            response.currencies.data.forEach(function(currency) {

                if(currency.status == 1){
                    currency_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    currency_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                currencies_html = currencies_html +
                
                "<div class=\"modal fade\" id=\"delete_currency_"+ currency.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ currency.en_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ currency.en_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_currency("+ currency.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"currency_id[]\" value=\""+ currency.id +"\" ></input> </td>\n" +
                "<td>"+ currency.id +"</td>\n"+
                "<td>"+ currency.code +"</td>\n"+
                "<td>"+ currency.name_ar +"</td>\n"+
                "<td>"+ currency.name_en +"</td>\n"+
                "<td>"+ currency_status +"</td>\n"+
                "<td class=\"table-action\" style=\"justify-content: center;\">\n"+
                    "<a target=\"_blank\" href=\"/currencies/"+ currency.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/currencies/"+ currency.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_currency_"+ currency.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#currencies_table_body").html(currencies_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var currencies_html = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var currency_name = $('#currency_name').val();

    $.ajax({
        url: "/currencies/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'currency_name': currency_name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#currencies_counter").text(response.currencies_count);
            $('#pagination').html(response.pagination);

            response.currencies.data.forEach(function(currency) {

                if(currency.status == 1){
                    currency_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    currency_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                currencies_html = currencies_html +
                
                "<div class=\"modal fade\" id=\"delete_currency_"+ currency.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ currency.en_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ currency.en_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_currency("+ currency.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"currency_id[]\" value=\""+ currency.id +"\" ></input> </td>\n" +
                "<td>"+ currency.id +"</td>\n"+
                "<td>"+ currency.code +"</td>\n"+
                "<td>"+ currency.name_ar +"</td>\n"+
                "<td>"+ currency.name_en +"</td>\n"+
                "<td>"+ currency_status +"</td>\n"+
                "<td class=\"table-action\" style=\"justify-content: center;\">\n"+
                    "<a target=\"_blank\" href=\"/currencies/"+ currency.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/currencies/"+ currency.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_currency_"+ currency.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#currencies_table_body").html(currencies_html);

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

    var currencies_html = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var currency_name = $('#currency_name').val();

    $.ajax({
        url: "/currencies/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'currency_name': currency_name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#currencies_counter").text(response.currencies_count);
            $('#pagination').html(response.pagination);

            response.currencies.data.forEach(function(currency) {

                if(currency.status == 1){
                    currency_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    currency_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                currencies_html = currencies_html +
                
                "<div class=\"modal fade\" id=\"delete_currency_"+ currency.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ currency.en_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ currency.en_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_currency("+ currency.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"currency_id[]\" value=\""+ currency.id +"\" ></input> </td>\n" +
                "<td>"+ currency.id +"</td>\n"+
                "<td>"+ currency.code +"</td>\n"+
                "<td>"+ currency.name_ar +"</td>\n"+
                "<td>"+ currency.name_en +"</td>\n"+
                "<td>"+ currency_status +"</td>\n"+
                "<td class=\"table-action\" style=\"justify-content: center;\">\n"+
                    "<a target=\"_blank\" href=\"/currencies/"+ currency.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/currencies/"+ currency.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_currency_"+ currency.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#currencies_table_body").html(currencies_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) currency
function archive_currency(currency_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/currencies/" + currency_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}