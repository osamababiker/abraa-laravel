window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var buyers_html = '';
    var is_verified = '';
    var is_organic = '';
    var buyer_country = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/buyers/json",
        type: "get",
        data: {"rows_numbers": rows_numbers},
        success: function(response){

            $("#buyers_counter").text(response.buyers_count); 
            $('#pagination').html(response.pagination); 

            response.buyers.data.forEach(function(buyer) {
                if(buyer.buyer_country){
                    buyer_country = buyer.buyer_country.en_name;
                }else buyer_country = '';

                if(buyer.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
                if(buyer.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }

                buyers_html = buyers_html +

                "<div class=\"modal fade\" id=\"delete_buyer_"+ buyer.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ buyer.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ buyer.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_buyer("+ buyer.id  +")\"  class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"buyer_id[]\" value=\""+ buyer.id +"\" ></input> </td>\n" +
                "<td>"+ buyer.id +"</td>\n"+
                "<td>"+ buyer.full_name +"</td>\n"+
                "<td>"+ buyer.email +"</td>\n"+
                "<td>"+ buyer.phone +"</td>\n"+
                "<td>"+ buyer.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>"+
                "<td>"+ buyer_country +"</td>"+
                "<td>"+ buyer.company +"</td>"+
                "<td>"+ is_organic +"</td>"+
                "<td> </td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buyers/"+ buyer.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/buyers/"+ buyer.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyer_"+ buyer.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyers_table_body").html(buyers_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var buyers_html = '';
    var is_verified = '';
    var is_organic = '';
    var buyer_country = '';

    // filter data
    var countries = $('#filter_by_country').val(); 
    var keywords = $('#filter_by_keywords').val(); 
    var buyer_name = $('#buyer_name').val(); 
    var date_range = $('#date_range').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/buyers/filter",
        type: "post",
        data: {
            'countries': countries,
            'keywords': keywords,
            'rows_numbers': rows_numbers,
            'buyer_name': buyer_name,
            'date_range': date_range,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#buyers_counter").text(response.buyers_count);
            $('#pagination').html(response.pagination); 

            response.buyers.data.forEach(function(buyer) {
                if(buyer.buyer_country){
                    buyer_country = buyer.buyer_country.en_name;
                }else buyer_country = '';

                if(buyer.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
                if(buyer.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }

                buyers_html = buyers_html +
                
                "<div class=\"modal fade\" id=\"delete_buyer_"+ buyer.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ buyer.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ buyer.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_buyer("+ buyer.id  +")\"  class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"buyer_id[]\" value=\""+ buyer.id +"\" ></input> </td>\n" +
                "<td>"+ buyer.id +"</td>\n"+
                "<td>"+ buyer.full_name +"</td>\n"+
                "<td>"+ buyer.email +"</td>\n"+
                "<td>"+ buyer.phone +"</td>\n"+
                "<td>"+ buyer.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>"+
                "<td>"+ buyer_country +"</td>"+
                "<td>"+ buyer.company +"</td>"+
                "<td>"+ is_organic +"</td>"+
                "<td> </td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buyers/"+ buyer.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/buyers/"+ buyer.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyer_"+ buyer.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyers_table_body").html(buyers_html);

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

    var buyers_html = '';
    var is_verified = '';
    var is_organic = '';
    var buyer_country = '';

    // filter data
    var countries = $('#filter_by_country').val(); 
    var keywords = $('#filter_by_keywords').val(); 
    var buyer_name = $('#buyer_name').val(); 
    var date_range = $('#date_range').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/buyers/filter",
        type: "post",
        data: {
            'countries': countries,
            'keywords': keywords,
            'rows_numbers': rows_numbers,
            'buyer_name': buyer_name,
            'date_range': date_range,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#buyers_counter").text(response.buyers_count);
            $('#pagination').html(response.pagination); 

            response.buyers.data.forEach(function(buyer) {
                if(buyer.buyer_country){
                    buyer_country = buyer.buyer_country.en_name;
                }else buyer_country = '';

                if(buyer.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
                if(buyer.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }

                buyers_html = buyers_html +
                
                "<div class=\"modal fade\" id=\"delete_buyer_"+ buyer.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ buyer.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ buyer.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_buyer("+ buyer.id  +")\"  class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"buyer_id[]\" value=\""+ buyer.id +"\" ></input> </td>\n" +
                "<td>"+ buyer.id +"</td>\n"+
                "<td>"+ buyer.full_name +"</td>\n"+
                "<td>"+ buyer.email +"</td>\n"+
                "<td>"+ buyer.phone +"</td>\n"+
                "<td>"+ buyer.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>"+
                "<td>"+ buyer_country +"</td>"+
                "<td>"+ buyer.company +"</td>"+
                "<td>"+ is_organic +"</td>"+
                "<td> </td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buyers/"+ buyer.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/buyers/"+ buyer.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyer_"+ buyer.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyers_table_body").html(buyers_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// to delete (archive) buyer
function archive_buyer(buyer_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/buyers/" + buyer_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}