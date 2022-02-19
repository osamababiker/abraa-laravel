window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var buying_request_invoices_html = '';
    var buying_request = '';
    var supplier = '';
    var supplier_email = '';
    var is_confirmed = '';
    var type = '';

    // filter data 
    var rows_numbers = $('#rows_numbers').val();
    var buying_request_status = $('#buying_request_status').val();
    var request_unit = ''; 

    $.ajax({
        url: "/rfqInvoices/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
            "buying_request_status": buying_request_status
        },
        success: function(response){

            $("#buying_request_invoices_counter").text(response.buying_requests_count);
            $('#pagination').html(response.pagination); 

            response.buying_requests.data.forEach(function(request) {

                if(request.unit){
                    request_unit = request.unit.unit_en;
                }

                if(request.buying_request){
                    buying_request = request.buying_request.product_name;
                }

                if(request.supplier){
                    supplier = request.supplier.full_name;
                    supplier_email = request.supplier.email;
                }

                if(request.confirmed == 1){
                    is_confirmed = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_confirmed = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(request.type == 1){
                    type = "Quotation";
                }else if(request.type == 2) {
                    type = "Offer";
                } else if(request.type == 3){
                    type = "Invoice";
                }

                buying_request_invoices_html = buying_request_invoices_html +

                // archive confirmation modal
                "<div class=\"modal fade\" id=\"delete_buyingRequestInvoice_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
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
                            "<button type=\"button\" onclick=\"archive_buyingRequestInvoice("+ request.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // buying message modal
                "<div class=\"modal fade\" id=\"buying_message_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                    "<div class=\"modal-dialog\" role=\"document\">\n"+
                        "<div class=\"modal-content\">\n"+
                            "<div class=\"modal-header\">\n"+
                                "<h5 class=\"modal-title\"> Buying request message </h5>\n"+
                                "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                    "<span aria-hidden=\"true\">&times;</span>\n"+
                                "</button>\n"+
                            "</div>\n"+
                            "<div class=\"modal-body m-3\">\n"+
                                "<p class=\"mb-0\">\n"+
                                request.message +
                                "</p>\n"+
                            "</div>\n"+
                            "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                                "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n"+ 

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"buyingRequestInvoice_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buying_request +"</td>\n"+
                "<td>"+ supplier +"</td>\n"+
                "<td>"+ supplier_email +"</td>\n"+
                "<td>"+ request.quantity +"</td>\n"+
                "<td>"+ request_unit +"</td>\n"+
                "<td>"+ request.price +"</td>\n"+
                "<td>"+ request.total_price +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#buying_message_"+ request.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ is_confirmed +"</td>\n"+ 
                "<td>"+ request.datetime +"</td>\n"+
                "<td>"+ type +"</td>\n"+
                "<td>"+ request.vat +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/rfqInvoices/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/rfqInvoices/"+ request.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyingRequestInvoice_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buying_requests_table_body").html(buying_request_invoices_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var buying_request_invoices_html = '';
    var request_unit = ''; 
    var type = '';

    // filter data
    var product_name = $('#product_name').val(); 
    var shipping_country = $('#shipping_country').val(); 
    var rows_numbers = $('#rows_numbers').val(); 
    var request_type = $("#request_type").val();
    var date_range = $('#date_range').val();
    var buying_request_status = $('#buying_request_status').val();

    $.ajax({
        url: "/rfqInvoices/filter",
        type: "post",
        data: {
            'product_name': product_name,
            'shipping_country': shipping_country,
            'request_type': request_type,
            'date_range': date_range,
            'buying_request_status': buying_request_status,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
            "_token": csrf_token
        },
        success: function(response){

            $("#buying_request_invoices_counter").text(response.buying_requests_count);
            $('#pagination').html(response.pagination); 

            response.buying_requests.data.forEach(function(request) {

                if(request.unit){
                    request_unit = request.unit.unit_en;
                }

                if(request.buying_request){
                    buying_request = request.buying_request.product_name;
                }

                if(request.supplier){
                    supplier = request.supplier.full_name;
                    supplier_email = request.supplier.email;
                }

                if(request.confirmed == 1){
                    is_confirmed = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_confirmed = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(request.type == 1){
                    type = "Quotation";
                }else if(request.type == 2) {
                    type = "Offer";
                } else if(request.type == 3){
                    type = "Invoice";
                }

                buying_request_invoices_html = buying_request_invoices_html +

                // archive confirmation modal
                "<div class=\"modal fade\" id=\"delete_buyingRequestInvoice_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
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
                            "<button type=\"button\" onclick=\"archive_buyingRequestInvoice("+ request.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // buying message modal
                "<div class=\"modal fade\" id=\"buying_message_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                    "<div class=\"modal-dialog\" role=\"document\">\n"+
                        "<div class=\"modal-content\">\n"+
                            "<div class=\"modal-header\">\n"+
                                "<h5 class=\"modal-title\"> Buying request message </h5>\n"+
                                "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                    "<span aria-hidden=\"true\">&times;</span>\n"+
                                "</button>\n"+
                            "</div>\n"+
                            "<div class=\"modal-body m-3\">\n"+
                                "<p class=\"mb-0\">\n"+
                                request.message +
                                "</p>\n"+
                            "</div>\n"+
                            "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                                "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"buyingRequestInvoice_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buying_request +"</td>\n"+
                "<td>"+ supplier +"</td>\n"+
                "<td>"+ supplier_email +"</td>\n"+
                "<td>"+ request.quantity +"</td>\n"+
                "<td>"+ request_unit +"</td>\n"+
                "<td>"+ request.price +"</td>\n"+
                "<td>"+ request.total_price +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#buying_message_"+ request.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ is_confirmed +"</td>\n"+ 
                "<td>"+ request.datetime +"</td>\n"+
                "<td>"+ type +"</td>\n"+
                "<td>"+ request.vat +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/rfqInvoices/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/rfqInvoices/"+ request.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyingRequestInvoice_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buying_requests_table_body").html(buying_request_invoices_html);

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

    var buying_request_invoices_html = '';
    var request_unit = ''; 
    var type = '';

    // filter data
    var product_name = $('#product_name').val(); 
    var shipping_country = $('#shipping_country').val(); 
    var rows_numbers = $('#rows_numbers').val(); 
    var request_type = $("#request_type").val();
    var date_range = $('#date_range').val();
    var buying_request_status = $('#buying_request_status').val();

    $.ajax({
        url: "/rfqInvoices/filter",
        type: "post",
        data: {
            'product_name': product_name,
            'shipping_country': shipping_country,
            'request_type': request_type,
            'date_range': date_range,
            'buying_request_status': buying_request_status,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
            "_token": csrf_token
        },
        success: function(response){

            $("#buying_request_invoices_counter").text(response.buying_requests_count);
            $('#pagination').html(response.pagination); 

            response.buying_requests.data.forEach(function(request) {

                if(request.unit){
                    request_unit = request.unit.unit_en;
                }

                if(request.buying_request){
                    buying_request = request.buying_request.product_name;
                }

                if(request.supplier){
                    supplier = request.supplier.full_name;
                    supplier_email = request.supplier.email;
                }

                if(request.confirmed == 1){
                    is_confirmed = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_confirmed = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(request.type == 1){
                    type = "Quotation";
                }else if(request.type == 2) {
                    type = "Offer";
                } else if(request.type == 3){
                    type = "Invoice";
                }

                buying_request_invoices_html = buying_request_invoices_html +

                // archive confirmation modal
                "<div class=\"modal fade\" id=\"delete_buyingRequestInvoice_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
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
                            "<button type=\"button\" onclick=\"archive_buyingRequestInvoice("+ request.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // buying message modal
                "<div class=\"modal fade\" id=\"buying_message_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                    "<div class=\"modal-dialog\" role=\"document\">\n"+
                        "<div class=\"modal-content\">\n"+
                            "<div class=\"modal-header\">\n"+
                                "<h5 class=\"modal-title\"> Buying request message </h5>\n"+
                                "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                    "<span aria-hidden=\"true\">&times;</span>\n"+
                                "</button>\n"+
                            "</div>\n"+
                            "<div class=\"modal-body m-3\">\n"+
                                "<p class=\"mb-0\">\n"+
                                request.message +
                                "</p>\n"+
                            "</div>\n"+
                            "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                                "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"buyingRequestInvoice_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buying_request +"</td>\n"+
                "<td>"+ supplier +"</td>\n"+
                "<td>"+ supplier_email +"</td>\n"+
                "<td>"+ request.quantity +"</td>\n"+
                "<td>"+ request_unit +"</td>\n"+
                "<td>"+ request.price +"</td>\n"+
                "<td>"+ request.total_price +"</td>\n"+
                "<td> <a type=\"button\" data-toggle=\"modal\" data-target=\"#buying_message_"+ request.id +"\"><i class=\"align-middle\" href=\"javascript:;\"> <i class=\"fa fa-ellipsis-h\"></i> </a> </td>\n"+
                "<td>"+ is_confirmed +"</td>\n"+ 
                "<td>"+ request.datetime +"</td>\n"+
                "<td>"+ type +"</td>\n"+
                "<td>"+ request.vat +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/rfqInvoices/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/rfqInvoices/"+ request.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyingRequestInvoice_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buying_requests_table_body").html(buying_request_invoices_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// to delete (archive) buying Request Invoice
function archive_buyingRequestInvoice(request_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/rfqInvoices/" + request_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}