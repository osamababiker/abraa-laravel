$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var shippers_html = '';
    var is_verified = '';
    var is_organic = '';
    var shipper_country = '';
    var shipper_source = '';
    var full_name = '';
    var email = '';
    var phone = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/shippers/json",
        type: "get",
        data: {"rows_numbers": rows_numbers},
        success: function(response){

            $("#shippers_counter").text(response.shippers_count);

            response.shippers.forEach(function(shipper) {

                if(shipper.shipper_country){
                    shipper_country = shipper.shipper_country.en_name;
                }

                if(shipper.user){
                    if(shipper.user.verified == 1){
                        is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                    }else{
                        is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                    }
     
                    if(shipper.user.is_organic == 1){
                        is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                    }else{
                        is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                    }

                    shipper_source = shipper.getUserSource(shipper.user.user_source);
                    full_name = shipper.user.full_name;
                    email = shipper.user.email;
                    phone = shipper.phone;
                }

                shippers_html = shippers_html +
                
                "<div class=\"modal fade\" id=\"delete_shipper_"+ shipper.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/shippers/"+ shipper.id +"/destroy\" id=\"delete_suppplier_form_"+ shipper.id +"\" method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"submit\" form=\"delete_suppplier_form_"+ shipper.id +"\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"shipper_id[]\" value=\""+ shipper.id +"\" ></input> </td>\n" +
                "<td>"+ shipper.id +"</td>\n"+
                "<td>"+ full_name +"</td>\n"+
                "<td>"+ email +"</td>\n"+
                "<td>"+ phone +"</td>\n"+
                "<td>"+ shipper.added_date +"</td>\n"+
                "<td>"+ is_verified +"</td>"+
                "<td>"+ shipper_country +"</td>"+
                "<td>"+ shipper.company_name +"</td>"+
                "<td>"+ is_organic +"</td>"+
                "<td>"+ shipper_source +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/shippers/"+ shipper.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/shippers/"+ shipper.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_shipper_"+ shipper.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a class=\"dropdown\">\n"+
                        "<a class=\"dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"></a>\n"+
                        "<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n"+
                            "<a class=\"dropdown-item\" type=\"button\" data-toggle=\"modal\" data-target=\"#shipper_items_"+ shipper.id +"\"><i class=\"align-middle\">Items</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Users store</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Buying request shippers</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Users files</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Buy request views</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Buying request invoice</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Marketing store activities </a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Call center activities</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Rfq pending shippers</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Store marketing docs</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Rfq shipper log</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">shipper verification</a>\n"+
                        "</div>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#shippers_table_body").html(shippers_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var shippers_html = '';
    var is_verified = '';
    var is_organic = '';
    var shipper_country = '';
    var shipper_source = '';
    var full_name = '';
    var email = '';
    var phone = '';

    // filter data
    var countries = $('#filter_by_country').val(); 
    var company_name = $('#company_name').val(); 
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/shippers/filter",
        type: "post",
        data: {
            'countries': countries,
            'rows_numbers': rows_numbers,
            'company_name': company_name
        },
        success: function(response){

            $("#shippers_counter").text(response.shippers_count);

            response.shippers.forEach(function(shipper) {

                if(shipper.shipper_country){
                    shipper_country = shipper.shipper_country.en_name;
                }

                if(shipper.user){
                    if(shipper.user.verified == 1){
                        is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                    }else{
                        is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                    }
     
                    if(shipper.user.is_organic == 1){
                        is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                    }else{
                        is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                    }

                    shipper_source = shipper.getUserSource(shipper.user.user_source);
                    full_name = shipper.user.full_name;
                    email = shipper.user.email;
                    phone = shipper.phone;
                }

                shippers_html = shippers_html +
                
                "<div class=\"modal fade\" id=\"delete_shipper_"+ shipper.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/shippers/"+ shipper.id +"/destroy\" id=\"delete_suppplier_form_"+ shipper.id +"\" method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"submit\" form=\"delete_suppplier_form_"+ shipper.id +"\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"shipper_id[]\" value=\""+ shipper.id +"\" ></input> </td>\n" +
                "<td>"+ shipper.id +"</td>\n"+
                "<td>"+ full_name +"</td>\n"+
                "<td>"+ email +"</td>\n"+
                "<td>"+ phone +"</td>\n"+
                "<td>"+ shipper.added_date +"</td>\n"+
                "<td>"+ is_verified +"</td>"+
                "<td>"+ shipper_country +"</td>"+
                "<td>"+ shipper.company_name +"</td>"+
                "<td>"+ is_organic +"</td>"+
                "<td>"+ shipper_source +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/shippers/"+ shipper.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/shippers/"+ shipper.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_shipper_"+ shipper.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a class=\"dropdown\">\n"+
                        "<a class=\"dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"></a>\n"+
                        "<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n"+
                            "<a class=\"dropdown-item\" type=\"button\" data-toggle=\"modal\" data-target=\"#shipper_items_"+ shipper.id +"\"><i class=\"align-middle\">Items</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Users store</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Buying request shippers</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Users files</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Buy request views</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Buying request invoice</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Marketing store activities </a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Call center activities</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Rfq pending shippers</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Store marketing docs</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">Rfq shipper log</a>\n"+
                            "<a class=\"dropdown-item\" href=\"#\">shipper verification</a>\n"+
                        "</div>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#shippers_table_body").html(shippers_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});