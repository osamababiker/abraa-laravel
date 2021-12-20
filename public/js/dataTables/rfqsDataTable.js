$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var buying_requests_html = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var buying_requests_status = $('#buying_requests_status').val();
    var buying_request_category = '';
    var buying_request_unit = ''; 

    $.ajax({
        url: "/rfq/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
            "buying_requests_status": buying_requests_status
        },
        success: function(response){

            $("#rfqs_counter").text(response.buying_requests_count);

            response.buying_requests.forEach(function(buying_request) {

                if(buying_request.category){
                    buying_request_category = buying_request.category.en_title;
                }

                if(buying_request.unit){
                    buying_request_unit = buying_request.unit.unit_en;
                }

                buying_requests_html = buying_requests_html +
                
                "<div class=\"modal fade\" id=\"delete_buying_request_"+ buying_request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/buying_requests/"+ buying_request.id +"/destroy\" id=\"delete_buying_request_form_"+ buying_request.id +"\" method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this buying request</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move buying request to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"submit\" form=\"delete_buying_request_form_"+ buying_request.id +"\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"buying_request_id[]\" value=\""+ buying_request.id +"\" ></input> </td>\n" +
                "<td>"+ buying_request.id +"</td>\n"+
                "<td>"+ buying_request.product_name +"</td>\n"+
                "<td>"+ buying_request_category +"</td>\n"+
                "<td></td>\n"+
                "<td></td>\n"+
                "<td></td>\n"+
                "<td>"+ buying_request.quantity +"</td>\n"+
                "<td>"+ buying_request_unit +"</td>\n"+
                "<td>"+ buying_request.target_price +"</td>\n"+
                "<td>"+ buying_request.target_price * buying_request.quantity +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#buying_message_"+ buying_request.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ buying_request.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/rfq/"+ buying_request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/rfq/"+ buying_request.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buying_request_"+ buying_request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buying_requests_table_body").html(buying_requests_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var buying_requests_html = '';
    var buying_request_category = '';
    var buying_request_unit = ''; 

    // filter data
    var product_name = $('#product_name').val(); 
    var shipping_country = $('#shipping_country').val(); 
    var meta_keyword = $('#meta_keyword').val(); 
    var rows_numbers = $('#rows_numbers').val(); 
    var request_type = $("#request_type").val();
    var buying_requests_status = $('#buying_requests_status').val();

    $.ajax({
        url: "/rfq/filter",
        type: "post",
        data: {
            'product_name': product_name,
            'shipping_country': shipping_country,
            'request_type': request_type,
            'meta_keyword': meta_keyword,
            "buying_requests_status": buying_requests_status,
            "rows_numbers": rows_numbers
        },
        success: function(response){

            $("#rfqs_counter").text(response.buying_requests_count);

            response.buying_requests.forEach(function(buying_request) {

                if(buying_request.category){
                    buying_request_category = buying_request.category.en_title;
                }

                if(buying_request.unit){
                    buying_request_unit = buying_request.unit.unit_en;
                }

                buying_requests_html = buying_requests_html +
                
                "<div class=\"modal fade\" id=\"delete_buying_request_"+ buying_request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/buying_requests/"+ buying_request.id +"/destroy\" id=\"delete_buying_request_form_"+ buying_request.id +"\" method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this buying request</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move buying request to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"submit\" form=\"delete_buying_request_form_"+ buying_request.id +"\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"buying_request_id[]\" value=\""+ buying_request.id +"\" ></input> </td>\n" +
                "<td>"+ buying_request.id +"</td>\n"+
                "<td>"+ buying_request.product_name +"</td>\n"+
                "<td>"+ buying_request_category +"</td>\n"+
                "<td></td>\n"+
                "<td></td>\n"+
                "<td></td>\n"+
                "<td>"+ buying_request.quantity +"</td>\n"+
                "<td>"+ buying_request_unit +"</td>\n"+
                "<td>"+ buying_request.target_price +"</td>\n"+
                "<td>"+ buying_request.target_price * buying_request.quantity +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#buying_message_"+ buying_request.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ buying_request.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/rfq/"+ buying_request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/rfq/"+ buying_request.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buying_request_"+ buying_request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buying_requests_table_body").html(buying_requests_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});