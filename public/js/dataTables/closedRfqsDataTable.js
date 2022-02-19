window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var buying_request_html = '';
    var item_link = '';
    var category = '';
    var buyer_name = '';
    var buyer_phone = '';
    var buyer_email = '';
    var buyer_country = '';
    var unit = ''; 
    var status = '';
    var approved_by = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();
    $.ajax({
        url: "/closedRfqs/json",   
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#buying_request_counter").text(response.buying_requests_count);
            $('#pagination').html(response.pagination); 

            response.buying_requests.data.forEach(function(request) {

                if(request.unit){
                    unit = request.unit.unit_en;
                }

                if(request.category){
                    category = request.category.en_title;
                }

                if(request.buyer){
                    buyer_id = request.buyer.id;
                    buyer_name = request.buyer.full_name;
                    buyer_phone = request.buyer.phone;
                    buyer_email = request.buyer.email; 
                }

                if(request.country){
                    buyer_country = request.country.en_name;
                }

                if(request.approved_by_admin){
                    approved_by = request.approved_by_admin.name;
                }

                if(request.status == 1){
                    status = "<p>Pending</p>";
                }else if(request.status == 2){
                    status = "<p>Approved</p>";
                }else if(request.status == 3){
                    status = "<p>Completed</p>";
                }else if(request.status == 4){
                    status = "<p>Lost</p>";
                }else if(request.status == 5){
                    status = "<p>Canceled</p>";
                } 

                if(request.item_id > 0){
                    item_link = "<a target=\"_blank\" href=\""+ public_url +"item\\"+ request.item_id +"\">"+ request.product_name +"</a>";
                }

                buying_request_html = buying_request_html +

                // archive confirmation modal
                "<div class=\"modal fade\" id=\"delete_buyingRequest_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
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
                            "<button type=\"button\" onclick=\"archive_buyingRequest("+ request.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // buying request product details modal
                "<div class=\"modal fade\" id=\"rfq_product_details"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">buying request Product Details</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">"+ request.product_detail +"</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+


                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"rfqs_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ buyer_phone +"</td>\n"+
                "<td>"+ buyer_email +"</td>\n"+
                "<td>"+ buyer_country +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td>"+ item_link +"</td>\n"+
                "<td>\n"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#rfq_product_details"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-ellipsis-h\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "<td>"+ request.quantity +"</td>\n"+ 
                "<td>"+ unit +"</td>\n"+
                "<td>"+ request.source_url +"</td>\n"+
                "<td>"+ status +"</td>\n"+
                "<td>"+ approved_by +"</td>\n"+
                "<td>"+ request.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/closedRfqs/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/closedRfqs/"+ request.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyingRequest_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            
            $("#buying_requests_table_body").html(buying_request_html);
            $(".select2").select2({
                tags: true,
            });

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var buying_request_html = '';
    var item_link = '';
    var category = '';
    var buyer_name = '';
    var buyer_phone = '';
    var buyer_email = '';
    var buyer_country = '';
    var unit = '';
    var status = '';
    var approved_by = '';


    // filter data
    var product_name = $('#product_name').val(); 
    var buyer_name = $('#buyer_name').val();
    var countries = $('#countries').val(); 
    var date_range = $('#date_range').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/closedRfqs/filter",
        type: "post",
        data: {
            'product_name': product_name,
            'buyer_name': buyer_name,
            'countries': countries,
            'rows_numbers': rows_numbers,
            'date_range': date_range,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#buying_request_counter").text(response.buying_requests_count);
            $('#pagination').html(response.pagination); 

            response.buying_requests.data.forEach(function(request) {

                if(request.unit){
                    unit = request.unit.unit_en;
                }

                if(request.category){
                    category = request.category.en_title;
                }

                if(request.buyer){
                    buyer_id = request.buyer.id;
                    buyer_name = request.buyer.full_name;
                    buyer_phone = request.buyer.phone;
                    buyer_email = request.buyer.email;
                }

                if(request.country){
                    buyer_country = request.country.en_name;
                }

                if(request.approved_by_admin){
                    approved_by = request.approved_by_admin.name;
                }

                if(request.status == 1){
                    status = "<p>Pending</p>";
                }else if(request.status == 2){
                    status = "<p>Approved</p>";
                }else if(request.status == 3){
                    status = "<p>Completed</p>";
                }else if(request.status == 4){
                    status = "<p>Lost</p>";
                }else if(request.status == 5){
                    status = "<p>Canceled</p>";
                } 

                if(request.item_id > 0){
                    item_link = "<a target=\"_blank\" href=\""+ public_url +"item\\"+ request.item_id +"\">"+ request.product_name +"</a>";
                }

                buying_request_html = buying_request_html +

                // archive confirmation modal
                "<div class=\"modal fade\" id=\"delete_buyingRequest_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
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
                            "<button type=\"button\" onclick=\"archive_buyingRequest("+ request.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // buying request product details modal
                "<div class=\"modal fade\" id=\"rfq_product_details"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">buying request Product Details</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">"+ request.product_detail +"</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+


                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"rfqs_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ buyer_phone +"</td>\n"+
                "<td>"+ buyer_email +"</td>\n"+
                "<td>"+ buyer_country +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td>"+ item_link +"</td>\n"+
                "<td>\n"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#rfq_product_details"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-ellipsis-h\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "<td>"+ request.quantity +"</td>\n"+ 
                "<td>"+ unit +"</td>\n"+
                "<td>"+ request.source_url +"</td>\n"+
                "<td>"+ status +"</td>\n"+
                "<td>"+ approved_by +"</td>\n"+
                "<td>"+ request.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/closedRfqs/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/closedRfqs/"+ request.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyingRequest_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            
            $("#buying_requests_table_body").html(buying_request_html);
            $(".select2").select2({
                tags: true,
            });

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

    var buying_request_html = '';
    var item_link = '';
    var category = '';
    var buyer_name = '';
    var buyer_phone = '';
    var buyer_email = '';
    var buyer_country = '';
    var unit = '';
    var status = '';
    var approved_by = '';


    // filter data
    var product_name = $('#product_name').val(); 
    var countries = $('#countries').val(); 
    var buyer_name = $('#buyer_name').val();
    var date_range = $('#date_range').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/closedRfqs/filter",
        type: "post",
        data: {
            'product_name': product_name,
            'buyer_name': buyer_name,
            'countries': countries,
            'date_range': date_range,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
            '_token': csrf_token
        },
        success: function(response){

            $("#buying_request_counter").text(response.buying_requests_count);
            $('#pagination').html(response.pagination); 

            response.buying_requests.data.forEach(function(request) {

                if(request.unit){
                    unit = request.unit.unit_en;
                }

                if(request.category){
                    category = request.category.en_title;
                }

                if(request.buyer){
                    buyer_id = request.buyer.id;
                    buyer_name = request.buyer.full_name;
                    buyer_phone = request.buyer.phone;
                    buyer_email = request.buyer.email;
                }

                if(request.country){
                    buyer_country = request.country.en_name;
                }

                if(request.approved_by_admin){
                    approved_by = request.approved_by_admin.name;
                }

                if(request.status == 1){
                    status = "<p>Pending</p>";
                }else if(request.status == 2){
                    status = "<p>Approved</p>";
                }else if(request.status == 3){
                    status = "<p>Completed</p>";
                }else if(request.status == 4){
                    status = "<p>Lost</p>";
                }else if(request.status == 5){
                    status = "<p>Canceled</p>";
                } 

                if(request.item_id > 0){
                    item_link = "<a target=\"_blank\" href=\""+ public_url +"item\\"+ request.item_id +"\">"+ request.product_name +"</a>";
                }

                buying_request_html = buying_request_html +

                // archive confirmation modal
                "<div class=\"modal fade\" id=\"delete_buyingRequest_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
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
                            "<button type=\"button\" onclick=\"archive_buyingRequest("+ request.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                // buying request product details modal
                "<div class=\"modal fade\" id=\"rfq_product_details"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">buying request Product Details</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">"+ request.product_detail +"</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+


                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"rfqs_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ buyer_phone +"</td>\n"+
                "<td>"+ buyer_email +"</td>\n"+
                "<td>"+ buyer_country +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td>"+ item_link +"</td>\n"+
                "<td>\n"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#rfq_product_details"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-ellipsis-h\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "<td>"+ request.quantity +"</td>\n"+ 
                "<td>"+ unit +"</td>\n"+
                "<td>"+ request.source_url +"</td>\n"+
                "<td>"+ status +"</td>\n"+
                "<td>"+ approved_by +"</td>\n"+
                "<td>"+ request.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/closedRfqs/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/closedRfqs/"+ request.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyingRequest_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            
            $("#buying_requests_table_body").html(buying_request_html);
            $(".select2").select2({
                tags: true,
            });

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// to delete (archive) buying Request Invoice
function archive_buyingRequest(request_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/abandonedRfqs/" + request_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}