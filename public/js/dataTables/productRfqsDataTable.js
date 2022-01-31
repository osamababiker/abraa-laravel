window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var buying_request_html = '';
    var category = '';
    var country = '';
    var buyer_name = '';
    var buyer_email = '';
    var buyer_phone = '';
    var unit = '';
    var approved_by  = '';
    

    // filter data
    var rows_numbers = $('#rows_numbers').val();


    $.ajax({
        url: "/productRfqs/json",   
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
                    buyer_email = request.buyer.email;
                    buyer_phone = request.buyer.phone;
                }

                if(request.country){
                    country = request.country.en_name;
                }
                
                if(request.approved_by != 0 && request.approved_by_admin){
                    approved_by  = request.approved_by_admin.name;
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


                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"rfqs_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ buyer_phone +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ buyer_email +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td> <a href=\""+ response.site_url +"item/"+ request.item_id +"\" target=\"_blank\"> "+ request.product_name +" </a> </td>\n"+
                "<td>"+ request.quantity +"</td>\n"+ 
                "<td>"+ unit +"</td>\n"+
                "<td>"+ approved_by +"</td>\n"+
                "<td>"+ request.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/productRfqs/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/productRfqs/"+ request.id +"/edit\">\n"+
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

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var buying_request_html = '';
    var category = '';
    var country = '';
    var buyer_name = '';
    var buyer_email = '';
    var buyer_phone = '';
    var unit = '';
    var approved_by  = '';


    // filter data
    var product_name = $('#product_name').val(); 
    var shipping_country = $('#shipping_country').val(); 
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/productRfqs/filter",
        type: "post",
        data: {
            'product_name': product_name,
            'shipping_country': shipping_country,
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            "_token": csrf_token
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
                    buyer_email = request.buyer.email;
                    buyer_phone = request.buyer.phone;
                }

                if(request.country){
                    country = request.country.en_name;
                }
                
                if(request.approved_by != 0 && request.approved_by_admin){
                    approved_by  = request.approved_by_admin.name;
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


                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"rfqs_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ buyer_phone +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ buyer_email +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td> <a href=\""+ response.site_url +"item/"+ request.item_id +"\" target=\"_blank\"> "+ request.product_name +" </a> </td>\n"+
                "<td>"+ request.quantity +"</td>\n"+ 
                "<td>"+ unit +"</td>\n"+
                "<td>"+ approved_by +"</td>\n"+
                "<td>"+ request.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/productRfqs/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/productRfqs/"+ request.id +"/edit\">\n"+
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
    var category = '';
    var country = '';
    var buyer_name = '';
    var buyer_email = '';
    var buyer_phone = '';
    var unit = '';
    var approved_by  = '';


    // filter data
    var product_name = $('#product_name').val(); 
    var shipping_country = $('#shipping_country').val(); 
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/productRfqs/filter",
        type: "post",
        data: {
            'product_name': product_name,
            'shipping_country': shipping_country,
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            "_token": csrf_token
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
                    buyer_email = request.buyer.email;
                    buyer_phone = request.buyer.phone;
                }

                if(request.country){
                    country = request.country.en_name;
                }
                
                if(request.approved_by != 0 && request.approved_by_admin){
                    approved_by  = request.approved_by_admin.name;
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


                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"rfqs_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ buyer_phone +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ buyer_email +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td> <a href=\""+ response.site_url +"item/"+ request.item_id +"\" target=\"_blank\"> "+ request.product_name +" </a> </td>\n"+
                "<td>"+ request.quantity +"</td>\n"+ 
                "<td>"+ unit +"</td>\n"+
                "<td>"+ approved_by +"</td>\n"+
                "<td>"+ request.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/productRfqs/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/productRfqs/"+ request.id +"/edit\">\n"+
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

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// to delete (archive) buying Request Invoice
function archive_buyingRequest(request_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/productRfqs/" + request_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}