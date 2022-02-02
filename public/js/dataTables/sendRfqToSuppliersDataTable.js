window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var supplier_html = '';
    var supplier_country = '';
    var supplier_store = '';

    // filter data
    var supplier_name = $('#supplier_name').val(); 
    var product_search = $('#product_search').val(); 
    var countries = $('#countries').val(); 
    var keywords = $('#keywords').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({ 
        url: "/globalRfqs/suppliers/filter",
        type: "post",
        data: {
            'product_search': product_search, 
            'countries': countries,
            'supplier_name': supplier_name,
            'keywords': keywords,
            'rows_numbers': rows_numbers ,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $('#pagination').html(response.pagination);
            response.suppliers.data.forEach(function(supplier) {

                if(supplier.supplier_country){
                    supplier_country = supplier.supplier_country.en_name;
                }

                if(supplier.store){
                    supplier_store = supplier.store.name;
                }

                supplier_html = supplier_html +
                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"supplier_email[]\" value=\""+ supplier.email +"\" ></input> </td>\n" +
                "<td>\n"+ supplier_store +"</td>\n"+
                "<td>\n"+ supplier.full_name +"</td>\n"+
                "<td>"+ supplier.email +"</td>\n"+
                "<td>"+ supplier.phone +"</td>\n"+
                "<td>"+ supplier_country +"<input type=\"hidden\" name=\"supplier_country[]\" value=\""+ supplier_country +"\" />\n"+
                "</td>\n"+
                "<td>"+  +"</td>\n"+
                "<td>"+  +"</td>\n"+ 
                "<td>"+  +"</td>\n"
            });

            $("#send_to_suppliers_table_body").html(supplier_html);
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

    var supplier_html = '';
    var supplier_country = '';
    var supplier_store = '';

    // filter data
    var supplier_name = $('#supplier_name').val(); 
    var product_search = $('#product_search').val(); 
    var countries = $('#countries').val(); 
    var keywords = $('#keywords').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({ 
        url: "/globalRfqs/suppliers/filter",
        type: "post",
        data: {
            'product_search': product_search, 
            'countries': countries,
            'supplier_name': supplier_name,
            'keywords': keywords,
            'rows_numbers': rows_numbers ,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $('#pagination').html(response.pagination);
            response.suppliers.data.forEach(function(supplier) {

                if(supplier.supplier_country){
                    supplier_country = supplier.supplier_country.en_name;
                }

                if(supplier.store){
                    supplier_store = supplier.store.name;
                }

                supplier_html = supplier_html +
                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"supplier_email[]\" value=\""+ supplier.email +"\" ></input> </td>\n" +
                "<td>\n"+ supplier_store +"</td>\n"+
                "<td>\n"+ supplier.full_name +"</td>\n"+
                "<td>"+ supplier.email +"</td>\n"+
                "<td>"+ supplier.phone +"</td>\n"+
                "<td>"+ supplier_country +"<input type=\"hidden\" name=\"supplier_country[]\" value=\""+ supplier_country +"\" />\n"+
                "</td>\n"+
                "<td>"+  +"</td>\n"+
                "<td>"+  +"</td>\n"+ 
                "<td>"+  +"</td>\n"
            });

            $("#send_to_suppliers_table_body").html(supplier_html);
            $("#ajax_loader").css('display', 'none');
        }
    });
});


 

window.global_category = 0; 

// to get suppliers details to approve rfq
$(function(){ 
    $(".autocomplete").on('click', function() {
        $("#category_search").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var is_category = 1;
                $.ajax({
                    url: "/rfqs/send/getSuppliersDetails",
                    dataType: "json",
                    data: {term: request.term, is_category: is_category},
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
            }
        });

        $("#category_search").autocomplete("option", "appendTo", ".autocomplete-category");

        $("#product_search").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var is_product = 1;

                $.ajax({
                    url: "/rfqs/send/getSuppliersDetails",
                    dataType: "json",
                    data: {term: request.term, is_product: is_product},
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
                    url: "/rfqs/send/getSuppliersDetails",
                    data: {product_id: ui.item.id},
                    success: function (data) {
                        if (data != 0) {
                            global_category = data;
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
        $("#product_search").autocomplete("option", "appendTo", ".autocomplete-product");
    });
});
