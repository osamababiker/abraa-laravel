window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () { 

    $("#ajax_loader").css('display', 'block');

    var shipping_html = '';
    var shipper_name = '';
    var shipping_method = '';
    var shipping_to = '';
    var shipping_from = '';
    var status = '';
    var clearance = '';
    var door_to_door = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/shipping/json",
        type: "get",
        data: {"rows_numbers": rows_numbers},
        success: function(response){

            $("#shippings_counter").text(response.shippings_count);
            $('#pagination').html(response.pagination); 

            response.shippings.data.forEach(function(shipping) {

                if(shipping.shipper){
                    shipper_name = shipping.shipper.full_name;
                }else shipper_name = '';

                if(shipping.shipping_methods == 1){
                    shipping_method = "Sea";
                }else if(shipping.shipping_methods == 2){
                    shipping_method = "Air";
                }else if(shipping.shipping_methods == 3){
                    shipping_method = "Land";
                }else if(shipping.shipping_methods == 4){
                    shipping_method = "Sea & Air";
                }else if(shipping.shipping_methods == 5){
                    shipping_method = "Sea & Land";
                }else if(shipping.shipping_methods == 6){
                    shipping_method = "Air & Land";
                }else if(shipping.shipping_methods == 7){
                    shipping_method = "All";
                }

                if(shipping.shipping_to_country && shipping.shipping_to != 'all'){
                    shipping_to = shipping.shipping_to_country.en_name;
                }else shipping_to = shipping.shipping_to;

                if(shipping.shipping_from_country && shipping.shipping_from != 'all'){
                    shipping_from = shipping.shipping_from_country.en_name;
                }else shipping_from = shipping.shipping_from;

                if(shipping.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
    
                if(shipping.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }

                if(shipping.status == 1){
                    status = "<i class=\"fa fa-check\" style=\"color: green\"></i>" + "Active";
                }else if(shipping.status == 2){
                    status = "<i class=\"fa fa-times\" style=\"color: red\"></i>" + "Not Active";
                }

                if(shipping.clearance == 1){
                    clearance = 'clearance';
                }else clearance = '';

                if(shipping.doortodoor == 1){
                    door_to_door = 'Door to Door';
                }else door_to_door = '';


                shipping_html = shipping_html +
                
                "<div class=\"modal fade\" id=\"delete_shipping_"+ shipping.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ shipping.company_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ shipping.company_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_shipping("+ shipping.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"shipping_id[]\" value=\""+ shipping.id +"\" ></input> </td>\n" +
                "<td>"+ shipping.id +"</td>\n"+
                "<td>"+ shipper_name +"</td>\n"+
                "<td>"+ shipping.company_name +"</td>\n"+
                "<td>"+ shipping.phone_number +"</td>\n"+
                "<td>"+ shipping.email +"</td>\n"+
                "<td>"+ shipping_method +"</td>\n"+
                "<td>"+ shipping_from +"</td>"+
                "<td>"+ shipping_to +"</td>"+
                "<td>"+ clearance +"</td>"+
                "<td>"+ door_to_door +"</td>"+
                "<td>"+ status +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/shipping/"+ shipping.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/shipping/"+ shipping.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_shipping_"+ shipping.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#shipping_table_body").html(shipping_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var shipping_html = '';
    var shipper_name = '';
    var shipping_method = '';
    var shipping_to = '';
    var shipping_from = '';
    var status = '';
    var clearance = '';
    var door_to_door = '';

    // filter data
    var company_name = $('#company_name').val(); 
    var shipper_name = $('#shipper_name').val(); 
    var shipper_status = $('#shipper_status').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/shipping/filter",
        type: "post",
        data: {
            'company_name': company_name,
            'rows_numbers': rows_numbers,
            'shipper_name': shipper_name,
            'shipper_status': shipper_status,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#shippings_counter").text(response.shippings_count);
            $('#pagination').html(response.pagination); 

            response.shippings.data.forEach(function(shipping) {

                if(shipping.shipper){
                    shipper_name = shipping.shipper.full_name;
                }else shipper_name = '';

                if(shipping.shipping_method == 1){
                    shipping_method = "Sea";
                }else if(shipping.shipping_method == 2){
                    shipping_method = "Air";
                }else if(shipping.shipping_method == 3){
                    shipping_method = "Land";
                }else if(shipping.shipping_method == 4){
                    shipping_method = "Sea & Air";
                }else if(shipping.shipping_method == 5){
                    shipping_method = "Sea & Land";
                }else if(shipping.shipping_method == 6){
                    shipping_method = "Air & Land";
                }else if(shipping.shipping_method == 7){
                    shipping_method = "All";
                }

                if(shipping.shipping_to && shipping.shipping_to != 'all'){
                    shipping_to = shipping.shipping_to.en_name;
                }else shipping_to = shipping.shipping_to;

                if(shipping.shipping_from && shipping.shipping_from != 'all'){
                    shipping_from = shipping.shipping_from.en_name;
                }else shipping_from = shipping.shipping_from;

                if(shipping.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
    
                if(shipping.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }

                if(shipping.status == 1){
                    status = "<i class=\"fa fa-check\" style=\"color: green\"></i>" + "Active";
                }else if(shipping.status == 2){
                    status = "<i class=\"fa fa-times\" style=\"color: red\"></i>" + "Not Active";
                }

                if(shipping.clearance == 1){
                    clearance = 'clearance';
                }else clearance = '';

                if(shipping.doortodoor == 1){
                    door_to_door = 'Door to Door';
                }else door_to_door = '';


                shipping_html = shipping_html +
                
                "<div class=\"modal fade\" id=\"delete_shipping_"+ shipping.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ shipping.company_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ shipping.company_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_shipping("+ shipping.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"shipping_id[]\" value=\""+ shipping.id +"\" ></input> </td>\n" +
                "<td>"+ shipping.id +"</td>\n"+
                "<td>"+ shipper_name +"</td>\n"+
                "<td>"+ shipping.company_name +"</td>\n"+
                "<td>"+ shipping.phone_number +"</td>\n"+
                "<td>"+ shipping.email +"</td>\n"+
                "<td>"+ shipping_method +"</td>\n"+
                "<td>"+ shipping_from +"</td>"+
                "<td>"+ shipping_to +"</td>"+
                "<td>"+ clearance +"</td>"+
                "<td>"+ door_to_door +"</td>"+
                "<td>"+ status +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/shipping/"+ shipping.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/shipping/"+ shipping.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_shipping_"+ shipping.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#shipping_table_body").html(shipping_html);

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

    var shipping_html = '';
    var shipper_name = '';
    var shipping_method = '';
    var shipping_to = '';
    var shipping_from = '';
    var status = '';
    var clearance = '';
    var door_to_door = '';

    // filter data
    var company_name = $('#company_name').val(); 
    var shipper_name = $('#shipper_name').val(); 
    var shipper_status = $('#shipper_status').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/shipping/filter",
        type: "post",
        data: {
            'company_name': company_name,
            'rows_numbers': rows_numbers,
            'shipper_name': shipper_name,
            'shipper_status': shipper_status,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#shippings_counter").text(response.shippings_count);
            $('#pagination').html(response.pagination); 

            response.shippings.data.forEach(function(shipping) {

                if(shipping.shipper){
                    shipper_name = shipping.shipper.full_name;
                }else shipper_name = '';

                if(shipping.shipping_method == 1){
                    shipping_method = "Sea";
                }else if(shipping.shipping_method == 2){
                    shipping_method = "Air";
                }else if(shipping.shipping_method == 3){
                    shipping_method = "Land";
                }else if(shipping.shipping_method == 4){
                    shipping_method = "Sea & Air";
                }else if(shipping.shipping_method == 5){
                    shipping_method = "Sea & Land";
                }else if(shipping.shipping_method == 6){
                    shipping_method = "Air & Land";
                }else if(shipping.shipping_method == 7){
                    shipping_method = "All";
                }

                if(shipping.shipping_to && shipping.shipping_to != 'all'){
                    shipping_to = shipping.shipping_to.en_name;
                }else shipping_to = shipping.shipping_to;

                if(shipping.shipping_from && shipping.shipping_from != 'all'){
                    shipping_from = shipping.shipping_from.en_name;
                }else shipping_from = shipping.shipping_from;

                if(shipping.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
    
                if(shipping.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }

                if(shipping.status == 1){
                    status = "<i class=\"fa fa-check\" style=\"color: green\"></i>" + "Active";
                }else if(shipping.status == 2){
                    status = "<i class=\"fa fa-times\" style=\"color: red\"></i>" + "Not Active";
                }

                if(shipping.clearance == 1){
                    clearance = 'clearance';
                }else clearance = '';

                if(shipping.doortodoor == 1){
                    door_to_door = 'Door to Door';
                }else door_to_door = '';


                shipping_html = shipping_html +
                
                "<div class=\"modal fade\" id=\"delete_shipping_"+ shipping.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ shipping.company_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ shipping.company_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_shipping("+ shipping.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"shipping_id[]\" value=\""+ shipping.id +"\" ></input> </td>\n" +
                "<td>"+ shipping.id +"</td>\n"+
                "<td>"+ shipper_name +"</td>\n"+
                "<td>"+ shipping.company_name +"</td>\n"+
                "<td>"+ shipping.phone_number +"</td>\n"+
                "<td>"+ shipping.email +"</td>\n"+
                "<td>"+ shipping_method +"</td>\n"+
                "<td>"+ shipping_from +"</td>"+
                "<td>"+ shipping_to +"</td>"+
                "<td>"+ clearance +"</td>"+
                "<td>"+ door_to_door +"</td>"+
                "<td>"+ status +"</td>"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/shipping/"+ shipping.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/shipping/"+ shipping.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_shipping_"+ shipping.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#shipping_table_body").html(shipping_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});

// to delete (archive) supplier
function archive_shipping(shipping_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/shipping/" + shipping_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}