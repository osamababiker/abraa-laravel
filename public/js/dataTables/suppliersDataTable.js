window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block'); 

    var suppliers_html = ''; 
    var is_verified = '';
    var is_organic = '';
    var supplier_country = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/suppliers/json",
        type: "get",
        cache: false,
        data: {"rows_numbers": rows_numbers},
        success: function(response){

            $("#suppliers_counter").text(response.suppliers_count);
            $('#pagination').html(response.pagination); 

            response.suppliers.data.forEach(function(supplier) {
                if(supplier.supplier_country){
                    supplier_country = supplier.supplier_country.en_name;
                }else supplier_country = '';

                if(supplier.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
                if(supplier.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }


                suppliers_html = suppliers_html +
                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_supplier_"+ supplier.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/suppliers/"+ supplier.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ supplier.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ supplier.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_supplier("+ supplier.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"supplier_id[]\" value=\""+ supplier.id +"\" ></input> </td>\n" +
                "<td>"+ supplier.id +"</td>\n"+
                "<td>"+ supplier.full_name +"</td>\n"+
                "<td>"+ supplier.email +"</td>\n"+
                "<td>"+ supplier.phone +"</td>\n"+
                "<td>"+ supplier.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>"+
                "<td>"+ supplier_country +"</td>"+
                "<td>"+ supplier.company +"</td>"+
                "<td>"+ is_organic +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/suppliers/"+ supplier.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/suppliers/"+ supplier.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_supplier_"+ supplier.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a class=\"dropdown\">\n"+
                        "<a class=\"dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"></a>\n"+
                        "<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/items\">Items</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/stores\">Users store</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/buyersMessages\">Buyers Messages</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/buyingRequests\">Buying request</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/files\">User files</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Buy request views</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/invoices\">Buying request invoice</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Marketing store activities </a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Call center activities</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Rfq pending suppliers</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Store marketing docs</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Rfq supplier log</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/verifications\">Supplier verification</a>\n"+
                        "</div>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#suppliers_table_body").html(suppliers_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var suppliers_html = '';
    var is_verified = '';
    var is_organic = '';
    var supplier_country = '';

    // filter data
    var countries = $('#filter_by_country').val(); 
    var keywords = $('#filter_by_keywords').val(); 
    var supplier_type = $('#supplier_type').val(); 
    var product_title = $('#filter_by_products_title').val(); 
    var supplier_name = $('#supplier_name').val(); 
    var date_range = $('#date_range').val();
    var rows_numbers = $('#rows_numbers').val(); 


    $.ajax({
        url: "/suppliers/filter",
        type: "post",
        data: {
            'countries': countries,
            'keywords': keywords,
            'rows_numbers': rows_numbers,
            'date_range': date_range,
            'supplier_type': supplier_type,
            'product_title': product_title,
            'supplier_name': supplier_name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#suppliers_counter").text(response.suppliers_count);
            $('#pagination').html(response.pagination);
            
            response.suppliers.data.forEach(function(supplier) {
                if(supplier.supplier_country){
                    supplier_country = supplier.supplier_country.en_name;
                }else supplier_country = '';

                if(supplier.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
                if(supplier.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
                suppliers_html = suppliers_html + 

                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_supplier_"+ supplier.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/suppliers/"+ supplier.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ supplier.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ supplier.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_supplier("+ supplier.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+
                
                
                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\"  name=\"supplier_id[]\" value=\""+ supplier.id +"\" ></input> </td>\n" +
                "<td>"+ supplier.id +"</td>\n"+
                "<td>"+ supplier.full_name +"</td>\n"+
                "<td>"+ supplier.email +"</td>\n"+
                "<td>"+ supplier.phone +"</td>\n"+
                "<td>"+ supplier.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>"+
                "<td>"+ supplier_country +"</td>"+
                "<td>"+ supplier.company +"</td>"+
                "<td>"+ is_organic +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/suppliers/"+ supplier.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/suppliers/"+ supplier.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_supplier_"+ supplier.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a class=\"dropdown\">\n"+
                        "<a class=\"dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"></a>\n"+
                        "<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/items\">Items</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/stores\">Users store</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/buyersMessages\">Buyers Messages</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/buyingRequests\">Buying request</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/files\">User files</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Buy request views</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/invoices\">Buying request invoice</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Marketing store activities </a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Call center activities</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Rfq pending suppliers</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Store marketing docs</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Rfq supplier log</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/verifications\">Supplier verification</a>\n"+
                        "</div>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"+
                "<div class=\"modal fade\" id=\"delete_supplier_"+ supplier.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/suppliers/"+ supplier.id +"/destroy\" id=\"delete_suppplier_form_"+ supplier.id +"\" method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ supplier.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ supplier.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"submit\" form=\"delete_suppplier_form_"+ supplier.id +"\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n"+
            "</div>\n"
            });


            $("#suppliers_table_body").html(suppliers_html);

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

    var suppliers_html = '';
    var is_verified = '';
    var is_organic = '';
    var supplier_country = '';

    // filter data
    var countries = $('#filter_by_country').val(); 
    var keywords = $('#filter_by_keywords').val(); 
    var supplier_type = $('#supplier_type').val(); 
    var product_title = $('#filter_by_products_title').val(); 
    var supplier_name = $('#supplier_name').val(); 
    var date_range = $('#date_range').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/suppliers/filter",
        type: "post",
        data: {
            'countries': countries,
            'keywords': keywords,
            'rows_numbers': rows_numbers,
            'supplier_type': supplier_type,
            'product_title': product_title,
            'date_range': date_range,
            'supplier_name': supplier_name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#suppliers_counter").text(response.suppliers_count);
            $('#pagination').html(response.pagination);
            
            response.suppliers.data.forEach(function(supplier) {
                if(supplier.supplier_country){
                    supplier_country = supplier.supplier_country.en_name;
                }else supplier_country = '';

                if(supplier.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
                if(supplier.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
                suppliers_html = suppliers_html + 

                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_supplier_"+ supplier.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/suppliers/"+ supplier.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ supplier.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ supplier.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_supplier("+ supplier.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+
                
                
                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\"  name=\"supplier_id[]\" value=\""+ supplier.id +"\" ></input> </td>\n" +
                "<td>"+ supplier.id +"</td>\n"+
                "<td>"+ supplier.full_name +"</td>\n"+
                "<td>"+ supplier.email +"</td>\n"+
                "<td>"+ supplier.phone +"</td>\n"+
                "<td>"+ supplier.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>"+
                "<td>"+ supplier_country +"</td>"+
                "<td>"+ supplier.company +"</td>"+
                "<td>"+ is_organic +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/suppliers/"+ supplier.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/suppliers/"+ supplier.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_supplier_"+ supplier.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a class=\"dropdown\">\n"+
                        "<a class=\"dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"></a>\n"+
                        "<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/items\">Items</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/stores\">Users store</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/buyersMessages\">Buyers Messages</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/buyingRequests\">Buying request</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/files\">User files</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Buy request views</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/invoices\">Buying request invoice</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Marketing store activities </a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Call center activities</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Rfq pending suppliers</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Store marketing docs</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Rfq supplier log</a>\n"+
                            "<a class=\"dropdown-item\" target=\"_blank\" href=\"suppliers/"+ supplier.id +"/verifications\">Supplier verification</a>\n"+
                        "</div>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"+
                "<div class=\"modal fade\" id=\"delete_supplier_"+ supplier.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/suppliers/"+ supplier.id +"/destroy\" id=\"delete_suppplier_form_"+ supplier.id +"\" method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ supplier.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ supplier.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"submit\" form=\"delete_suppplier_form_"+ supplier.id +"\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n"+
            "</div>\n"
            });


            $("#suppliers_table_body").html(suppliers_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// to delete (archive) supplier
function archive_supplier(supplier_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/suppliers/" + supplier_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}



// to send custome message to suppliers
$(function(){ 
    $("#send_message_btn").on('click', function() {
        var supplier_id = [];
        var subject = $("#subject").val();
        var message = $("#quill-editor p").text();
        var send_message_btn = $("#send_message_btn").val();

        $(':checkbox:checked').each(function(i){
            supplier_id[i] = $(this).val();
        });

        $.ajax({
            url: "/suppliers/actions",
            type: "post",
            data: {
                "supplier_id": supplier_id,
                "subject": subject,
                "message": message,
                "send_message_btn": send_message_btn
            },
            success: function(response){
                location.reload();
            }
        });
    });
});