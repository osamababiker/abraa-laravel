window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var orders_html = '';
    var country = '';
    var full_name = '';
    var email = '';
    var phone = '';
    var payment_geteway = '';
    var status = '';
    var currency = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/orders/json",
        type: "get",
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#orders_counter").text(response.orders_count);
            $('#pagination').html(response.pagination); 

            response.orders.data.forEach(function(order) {
                
                if(order.user){
                    if(order.user.buyer_country)
                        country = order.user.buyer_country.en_name;
                    full_name = order.user.full_name;
                    email = order.user.email;
                    phone = order.user.phone;
                }

                if(order.status){
                    status = order.status.title;
                }

                if(order.currency){
                    currency = order.currency.name_en;
                }

                if(order.payment_geteway == 3){
                    payment_geteway = 'Outside UAE'; 
                }else if(order.payment_geteway == 1){
                    payment_geteway = 'Credit/Debit Card';
                }else if(order.payment_geteway == 2){
                    payment_geteway = 'PayPal';
                }else if(order.payment_geteway == 4){
                    payment_geteway = 'Bank Transfer';
                }else if(order.payment_geteway == 5){
                    payment_geteway = 'Cash On Delivery';
                }

                orders_html = orders_html +
                
                "<div class=\"modal fade\" id=\"delete_order_"+ order.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this order </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this order to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_order("+ order.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"order_id[]\" value=\""+ order.id +"\" ></input> </td>\n" +
                "<td>"+ order.id +"</td>\n"+ 
                "<td>\n"+
                    "<button type=\"button\" onclick=\"approve_order("+ order.id +")\" class=\"btn btn-success\" name=\"approve_single_order_btn\"> <i style=\"color: #fff\"><i class=\"fa fa-check\"></i> </button>\n"+
                    "<button type=\"button\" onclick=\"reject_order("+ order.id +")\" class=\"btn btn-danger\" name=\"reject_single_order_btn\"> <i style=\"color: #fff\"><i class=\"fa fa-times\"></i> </button>\n"+
                "</td>\n"+
                "<td>"+ full_name +"</td>\n"+
                "<td>"+ email +"</td>\n"+ 
                "<td>"+ phone +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ order.price_aed +"</td>\n"+
                "<td>"+ order.total_price +"</td>\n"+
                "<td>"+ order.shipping_price +"</td>\n"+
                "<td>"+ currency +"</td>\n"+
                "<td>"+ payment_geteway +"</td>\n"+
                "<td>"+ order.payment_status +"</td>\n"+
                "<td>"+ status +"</td>\n"+
                "<td>"+ order.date_created +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/orders/"+ order.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/orders/"+ order.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_order_"+ order.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#orders_table_body").html(orders_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var orders_html = '';
    var country = '';
    var full_name = '';
    var email = '';
    var phone = '';
    var payment_geteway = '';
    var status = '';
    var currency = '';

    // filter data
    var user_name = $('#user_name').val(); 
    var order_type = $('#order_type').val(); 
    var order_status = $('#order_status').val(); 
    var rows_numbers = $('#rows_numbers').val(); 
    var order_status = $('#order_status').val();
    var date_range = $('#date_range').val();
    var countries = $("#countries").val();

    $.ajax({
        url: "/orders/filter",
        type: "post",
        data: {
            'user_name': user_name,
            'order_type': order_type,
            'rows_numbers': rows_numbers,
            'order_status': order_status,
            'order_status': order_status,
            'countries': countries,
            'date_range': date_range,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#orders_counter").text(response.orders_count);
            $('#pagination').html(response.pagination); 

            response.orders.data.forEach(function(order) {
                
                if(order.user){
                    if(order.user.buyer_country)
                        country = order.user.buyer_country.en_name;
                    full_name = order.user.full_name;
                    email = order.user.email;
                    phone = order.user.phone;
                }

                if(order.status){
                    status = order.status.title;
                }

                if(order.currency){
                    currency = order.currency.name_en;
                }

                if(order.payment_geteway == 3){
                    payment_geteway = 'Outside UAE';
                }else if(order.payment_geteway == 1){
                    payment_geteway = 'Credit/Debit Card';
                }else if(order.payment_geteway == 2){
                    payment_geteway = 'PayPal';
                }else if(order.payment_geteway == 4){
                    payment_geteway = 'Bank Transfer';
                }else if(order.payment_geteway == 5){
                    payment_geteway = 'Cash On Delivery';
                }

                orders_html = orders_html +
                
                "<div class=\"modal fade\" id=\"delete_order_"+ order.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this order </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this order to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_order("+ order.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"order_id[]\" value=\""+ order.id +"\" ></input> </td>\n" +
                "<td>"+ order.id +"</td>\n"+ 
                "<td>\n"+
                    "<button type=\"button\" onclick=\"approve_order("+ order.id +")\" class=\"btn btn-success\" name=\"approve_single_order_btn\"> <i style=\"color: #fff\"><i class=\"fa fa-check\"></i> </button>\n"+
                    "<button type=\"button\" onclick=\"reject_order("+ order.id +")\" class=\"btn btn-danger\" name=\"reject_single_order_btn\"> <i style=\"color: #fff\"><i class=\"fa fa-times\"></i> </button>\n"+
                "</td>\n"+
                "<td>"+ full_name +"</td>\n"+
                "<td>"+ email +"</td>\n"+ 
                "<td>"+ phone +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ order.price_aed +"</td>\n"+
                "<td>"+ order.total_price +"</td>\n"+
                "<td>"+ order.shipping_price +"</td>\n"+
                "<td>"+ currency +"</td>\n"+
                "<td>"+ payment_geteway +"</td>\n"+
                "<td>"+ order.payment_status +"</td>\n"+
                "<td>"+ status +"</td>\n"+
                "<td>"+ order.date_created +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/orders/"+ order.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/orders/"+ order.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_order_"+ order.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#orders_table_body").html(orders_html);

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

    var orders_html = '';
    var country = '';
    var full_name = '';
    var email = '';
    var phone = '';
    var payment_geteway = '';
    var status = '';
    var currency = '';

    // filter data
    var user_name = $('#user_name').val(); 
    var order_type = $('#order_type').val(); 
    var order_status = $('#order_status').val(); 
    var rows_numbers = $('#rows_numbers').val(); 
    var orders_status = $('#orders_status').val();
    var countries = $("#countries").val();
    var date_range = $('#date_range').val();

    $.ajax({
        url: "/orders/filter",
        type: "post",
        data: {
            'user_name': user_name,
            'order_type': order_type,
            'rows_numbers': rows_numbers,
            'order_status': order_status,
            'orders_status': orders_status,
            'countries': countries,
            'date_range': date_range,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#orders_counter").text(response.orders_count);
            $('#pagination').html(response.pagination); 

            response.orders.data.forEach(function(order) {
                
                if(order.user){
                    if(order.user.buyer_country)
                        country = order.user.buyer_country.en_name;
                    full_name = order.user.full_name;
                    email = order.user.email;
                    phone = order.user.phone;
                }

                if(order.status){
                    status = order.status.title;
                }

                if(order.currency){
                    currency = order.currency.name_en;
                }

                if(order.payment_geteway == 3){
                    payment_geteway = 'Outside UAE';
                }else if(order.payment_geteway == 1){
                    payment_geteway = 'Credit/Debit Card';
                }else if(order.payment_geteway == 2){
                    payment_geteway = 'PayPal';
                }else if(order.payment_geteway == 4){
                    payment_geteway = 'Bank Transfer';
                }else if(order.payment_geteway == 5){
                    payment_geteway = 'Cash On Delivery';
                }

                orders_html = orders_html +
                
                "<div class=\"modal fade\" id=\"delete_order_"+ order.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this order </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this order to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_order("+ order.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"order_id[]\" value=\""+ order.id +"\" ></input> </td>\n" +
                "<td>"+ order.id +"</td>\n"+ 
                "<td>\n"+
                    "<button type=\"button\" onclick=\"approve_order("+ order.id +")\" class=\"btn btn-success\" name=\"approve_single_order_btn\"> <i style=\"color: #fff\"><i class=\"fa fa-check\"></i> </button>\n"+
                    "<button type=\"button\" onclick=\"reject_order("+ order.id +")\" class=\"btn btn-danger\" name=\"reject_single_order_btn\"> <i style=\"color: #fff\"><i class=\"fa fa-times\"></i> </button>\n"+
                "</td>\n"+
                "<td>"+ full_name +"</td>\n"+
                "<td>"+ email +"</td>\n"+ 
                "<td>"+ phone +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td>"+ order.price_aed +"</td>\n"+
                "<td>"+ order.total_price +"</td>\n"+
                "<td>"+ order.shipping_price +"</td>\n"+
                "<td>"+ currency +"</td>\n"+
                "<td>"+ payment_geteway +"</td>\n"+
                "<td>"+ order.payment_status +"</td>\n"+
                "<td>"+ status +"</td>\n"+
                "<td>"+ order.date_created +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/orders/"+ order.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+ 
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/orders/"+ order.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_order_"+ order.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#orders_table_body").html(orders_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// to delete (archive) order
function archive_order(order_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/orders/" + order_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}

// to approve single order
function approve_order(order_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/orders/actions",
        type: "post",
        data: {
            "_token": csrf_token,
            'order_id': order_id, 
            'approve_single_order_btn': ''
        },
        success: function(response){
            location.reload();
        }
    });
}


// to reject single order
function reject_order(order_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/orders/actions",
        type: "post",
        data: {
            "_token": csrf_token,
            'order_id': order_id, 
            'reject_single_order_btn': ''
        },
        success: function(response){
            location.reload();
        }
    });
}

