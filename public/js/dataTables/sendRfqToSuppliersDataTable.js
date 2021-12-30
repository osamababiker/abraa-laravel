
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var supplier_html = '';
    var supplier_country = '';

    // filter data
    var supplier_name = $('#supplier_name').val(); 
    var products = $('#products').val(); 
    var categories = $('#categories').val(); 
    var countries = $('#countries').val(); 
    var keywords = $('#keywords').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/globalRfqs/suppliers/filter",
        type: "post",
        data: {
            'products': products,
            'categories': categories,
            'countries': countries,
            'supplier_name': supplier_name,
            'keywords': keywords,
            "rows_numbers": rows_numbers
        },
        success: function(response){

            response.suppliers.forEach(function(supplier) {

                if(supplier.supplier_country){
                    supplier_country = supplier.supplier_country.en_name;
                }

                supplier_html = supplier_html +
                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"supplier_email[]\" value=\""+ supplier.email +"\" ></input> </td>\n" +
                "<td>\n"+supplier.name +"</td>\n"+
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

