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
    var item_link = '';
    var unit = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();


    $.ajax({
        url: "/rfqs/json",   
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

                if(request.item_id > 0){
                    item_link = "<a target=\"_blank\" href=\""+ public_url +"item\\"+ request.item_id +"\">"+ request.product_name +"</a>";
                }else item_link =  request.product_name;

 
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

                // approve single request modal
                "<div class=\"modal fade\" id=\"approve_buying_request_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this buying request</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body\">\n"+
                            "<div class=\"form-row mt-4\">\n"+
                                "<div class=\"form-group col-md-12 autocomplete-category\">\n"+
                                    "<label for=\"category_search\">Suppliers by Category</label>\n"+
                                    "<input type=\"text\" name=\"category_search\" class=\"form-control category_search\" id=\"category_search_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"product_search\">Suppliers by Products</label>\n"+
                                    "<input type=\"text\" name=\"product_search\" class=\"form-control product_search\" id=\"product_search_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-6\">\n"+
                                    "<label for=\"buyer_name\">Buyer Name</label>\n"+
                                    "<input type=\"text\" name=\"buyer_name\" value=\""+ buyer_name +"\" class=\"form-control\" id=\"buyer_name_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-6\">\n"+
                                    "<label for=\"buyer_phone\">Buyer Phone</label>\n"+
                                    "<input type=\"text\" name=\"buyer_phone\" value=\""+ buyer_phone +"\" class=\"form-control\" id=\"buyer_phone_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"buyer_keywords\">Buyer Keywords</label>\n"+
                                    "<select name=\"buyer_keywords\" multiple=\"multiple\" id=\"buyer_keywords_"+ request.id +"\" class=\"form-control select2\">\n"+
                                        "<option value=\"\"></option>\n"+
                                    "</select>\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"rfq_name\">RFQ Name</label>\n"+
                                    "<input type=\"text\" name=\"rfq_name\" value=\""+ request.product_name +"\" class=\"form-control\" id=\"rfq_name_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"rfq_details\">RFQ Details</label>\n"+
                                    "<textarea rows=\"8\" cols=\"8\" name=\"rfq_details\" class=\"form-control\" id=\"rfq_details_"+ request.id +"\">"+  request.product_detail +"</textarea>\n"+
                                "</div>\n"+
                                "<input type=\"hidden\" id=\"request_id\" value=\""+ request.id +"\" />\n"+
                                "<input type=\"hidden\" id=\"buyer_id_"+ request.id +"\" value=\""+ buyer_id +"\" />\n"+
                            "</div>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"getSuppliersDetails()\" name=\"approve_btn\" id=\"approve_btn\" class=\"btn btn-success\">Approve</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"rfqs_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>\n"+ 
                    "<a href=\"#\" type=\"button\" class=\"btn btn-success\" style=\"color: #fff\"  data-toggle=\"modal\" data-target=\"#approve_buying_request_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-check\" ></i>\n"+
                    "</a>\n"+ 
                "</td>\n"+
                "<td>  </td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ buyer_phone +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ buyer_email +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td>"+ item_link +"</td>\n"+
                "<td>"+ request.quantity +"</td>\n"+ 
                "<td>"+ unit +"</td>\n"+
                "<td>"+ request.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/rfqs/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/rfqs/"+ request.id +"/edit\">\n"+
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
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var buying_request_html = '';
    var category = '';
    var country = '';
    var buyer_name = '';
    var buyer_email = '';
    var buyer_phone = '';
    var item_link = '';
    var unit = '';


    // filter data
    var product_name = $('#product_name').val(); 
    var shipping_country = $('#shipping_country').val(); 
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/rfqs/filter",
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

                if(request.item_id > 0){
                    item_link = "<a target=\"_blank\" href=\""+ public_url +"item\\"+ request.item_id +"\">"+ request.product_name +"</a>";
                }else item_link =  request.product_name;

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

                // approve single request modal
                "<div class=\"modal fade\" id=\"approve_buying_request_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this buying request</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body\">\n"+
                            "<div class=\"form-row mt-4\">\n"+
                                "<div class=\"form-group col-md-12 autocomplete-category\">\n"+
                                    "<label for=\"category_search\">Suppliers by Category</label>\n"+
                                    "<input type=\"text\" name=\"category_search\" class=\"form-control category_search\" id=\"category_search_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"product_search\">Suppliers by Products</label>\n"+
                                    "<input type=\"text\" name=\"product_search\" class=\"form-control product_search\" id=\"product_search_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-6\">\n"+
                                    "<label for=\"buyer_name\">Buyer Name</label>\n"+
                                    "<input type=\"text\" name=\"buyer_name\" value=\""+ buyer_name +"\" class=\"form-control\" id=\"buyer_name_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-6\">\n"+
                                    "<label for=\"buyer_phone\">Buyer Phone</label>\n"+
                                    "<input type=\"text\" name=\"buyer_phone\" value=\""+ buyer_phone +"\" class=\"form-control\" id=\"buyer_phone_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"buyer_keywords\">Buyer Keywords</label>\n"+
                                    "<select name=\"buyer_keywords\" multiple=\"multiple\" id=\"buyer_keywords_"+ request.id +"\" class=\"form-control select2\">\n"+
                                        "<option value=\"\"></option>\n"+
                                    "</select>\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"rfq_name\">RFQ Name</label>\n"+
                                    "<input type=\"text\" name=\"rfq_name\" value=\""+ request.product_name +"\" class=\"form-control\" id=\"rfq_name_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"rfq_details\">RFQ Details</label>\n"+
                                    "<textarea rows=\"8\" cols=\"8\" name=\"rfq_details\" class=\"form-control\" id=\"rfq_details_"+ request.id +"\">"+  request.product_detail +"</textarea>\n"+
                                "</div>\n"+
                                "<input type=\"hidden\" id=\"request_id\" value=\""+ request.id +"\" />\n"+
                                "<input type=\"hidden\" id=\"buyer_id_"+ request.id +"\" value=\""+ buyer_id +"\" />\n"+
                            "</div>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\"  name=\"approve_btn\" id=\"approve_btn\" class=\"btn btn-success\">Approve</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+


                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"buyingRequestInvoice_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>\n"+ 
                    "<a href=\"#\" class=\"btn btn-success\" style=\"color: #fff\" type=\"button\"  data-toggle=\"modal\" data-target=\"#approve_buying_request_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-check\" ></i>\n"+
                    "</a>\n"+ 
                "</td>\n"+
                "<td>  </td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ buyer_phone +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ buyer_email +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td>"+ item_link +"</td>\n"+
                "<td>"+ request.quantity +"</td>\n"+ 
                "<td>"+ unit +"</td>\n"+
                "<td>"+ request.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/rfqs/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/rfqs/"+ request.id +"/edit\">\n"+
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
    var category = '';
    var country = '';
    var buyer_name = '';
    var buyer_email = '';
    var buyer_phone = '';
    var item_link = '';
    var unit = '';


    // filter data
    var product_name = $('#product_name').val(); 
    var shipping_country = $('#shipping_country').val(); 
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/rfqs/filter",
        type: "post",
        data: {
            'product_name': product_name,
            'shipping_country': shipping_country,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
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

                if(request.item_id > 0){
                    item_link = "<a target=\"_blank\" href=\""+ public_url +"item\\"+ request.item_id +"\">"+ request.product_name +"</a>";
                }else item_link =  request.product_name;


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

                // approve single request modal
                "<div class=\"modal fade\" id=\"approve_buying_request_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this buying request</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body\">\n"+
                            "<div class=\"form-row mt-4\">\n"+
                                "<div class=\"form-group col-md-12 autocomplete-category\">\n"+
                                    "<label for=\"category_search\">Suppliers by Category</label>\n"+
                                    "<input type=\"text\" name=\"category_search\" class=\"form-control category_search\" id=\"category_search_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"product_search\">Suppliers by Products</label>\n"+
                                    "<input type=\"text\" name=\"product_search\" class=\"form-control product_search\" id=\"product_search_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-6\">\n"+
                                    "<label for=\"buyer_name\">Buyer Name</label>\n"+
                                    "<input type=\"text\" name=\"buyer_name\" value=\""+ buyer_name +"\" class=\"form-control\" id=\"buyer_name_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-6\">\n"+
                                    "<label for=\"buyer_phone\">Buyer Phone</label>\n"+
                                    "<input type=\"text\" name=\"buyer_phone\" value=\""+ buyer_phone +"\" class=\"form-control\" id=\"buyer_phone_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"buyer_keywords\">Buyer Keywords</label>\n"+
                                    "<select name=\"buyer_keywords\" multiple=\"multiple\" id=\"buyer_keywords_"+ request.id +"\" class=\"form-control select2\">\n"+
                                        "<option value=\"\"></option>\n"+
                                    "</select>\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"rfq_name\">RFQ Name</label>\n"+
                                    "<input type=\"text\" name=\"rfq_name\" value=\""+ request.product_name +"\" class=\"form-control\" id=\"rfq_name_"+ request.id +"\">\n"+
                                "</div>\n"+
                                "<div class=\"form-group col-md-12\">\n"+
                                    "<label for=\"rfq_details\">RFQ Details</label>\n"+
                                    "<textarea rows=\"8\" cols=\"8\" name=\"rfq_details\" class=\"form-control\" id=\"rfq_details_"+ request.id +"\">"+  request.product_detail +"</textarea>\n"+
                                "</div>\n"+
                                "<input type=\"hidden\" id=\"request_id\" value=\""+ request.id +"\" />\n"+
                                "<input type=\"hidden\" id=\"buyer_id_"+ request.id +"\" value=\""+ buyer_id +"\" />\n"+
                            "</div>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\"  name=\"approve_btn\" id=\"approve_btn\" class=\"btn btn-success\">Approve</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+


                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"buyingRequestInvoice_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>\n"+ 
                    "<a href=\"#\" class=\"btn btn-success\" style=\"color: #fff\" type=\"button\"  data-toggle=\"modal\" data-target=\"#approve_buying_request_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-check\" ></i>\n"+
                    "</a>\n"+ 
                "</td>\n"+
                "<td>  </td>\n"+
                "<td>"+ buyer_name +"</td>\n"+
                "<td>"+ buyer_phone +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ buyer_email +"</td>\n"+
                "<td>"+ category +"</td>\n"+
                "<td>"+ item_link +"</td>\n"+
                "<td>"+ request.quantity +"</td>\n"+ 
                "<td>"+ unit +"</td>\n"+
                "<td>"+ request.date_added +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/rfqs/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/rfqs/"+ request.id +"/edit\">\n"+
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



window.global_category = 0;

// to get suppliers details to approve rfq
$(function(){ 
    $("#buying_requests_table_body").on('click', '.category_search', function() {
        $(".category_search").autocomplete({
            minLength: 1,
            source: function (request, response) {
                $.ajax({
                    url: "/rfqs/approve/getSuppliersDetails",
                    dataType: "json",
                    data: {term: request.term},
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.value,
                                value: item.value,
                                id: item.id
                            };
                        }));
                    },
                });
            },
            select: function (event, ui) {
                global_category = ui.item.id;
                $('.product_search').attr('disabled', true);

            }
        });

        $(".category_search").autocomplete("option", "appendTo", ".autocomplete-category");

        $(".product_search").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var is_description = $('#is_description').is(':checked');

                $.ajax({
                    url: "<?php {{ route('rfqs.getSuppliersDetails') }} ?>",
                    dataType: "json",
                    data: {term: request.term, is_description: is_description},
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.value,
                                value: item.value,
                                id: item.id
                            };
                        }));
                    },
                });
            },
            select: function (event, ui) {
                $.ajax({
                    url: "<?php {{ route('rfqs.getSuppliersDetails') }} ?>",
                    data: {product_id: ui.item.id},
                    success: function (data) {
                        if (data != 0) {
                            global_category = data;
                            $('.category_search').attr('disabled', true);
                        } else {
                            swal("No category associated with the product.");
                        }
                    },
                    error: function (xhr, textStatus, error) {
                        swal("Something went wrong. If problem persist, contact administrator.");
                        //swal(xhr.statusText);
                    }
                });
            }
        });
        $(".product_search").autocomplete("option", "appendTo", ".autocomplete-product");
    });
});


// to approve rfq
$(function(){ 
    $("#buying_requests_table_body").on('click', '#approve_btn', function() {

        var rfq_id = $('#request_id').val();
        var buyer_id = $('#buyer_id_' + rfq_id).val();
        var buyer_name = $('#buyer_name_' + rfq_id).val();
        var buyer_phone = $('#buyer_phone_' + rfq_id).val();
        var buyer_email = $('#buyer_email_' + rfq_id).val();
        var buyer_keywords = $('#buyer_keywords_' + rfq_id).val();
        var rfq_name = $('#rfq_name_' + rfq_id).val();
        var rfq_details = $('#rfq_details_' + rfq_id).val();

        $("#ajax_loader").css('display', 'block');
        $.ajax({
            url: "/rfqs/" + rfq_id + "/approve",
            type: "get",
            data: {
                "buyer_id": buyer_id,
                "buyer_name": buyer_name,
                "buyer_phone": buyer_phone,
                "buyer_email": buyer_email,
                "buyer_keywords": buyer_keywords,
                "category_id": global_category,
                "rfq_name": rfq_name,
                "rfq_details": rfq_details,
                "rfq_id": rfq_id
            },
            success: function(response){
                location.reload();
            }
        });
    });
});


// to delete (archive) buying Request Invoice
function archive_buyingRequest(request_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/rfqs/" + request_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}