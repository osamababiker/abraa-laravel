window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () { 

    $("#ajax_loader").css('display', 'block');

    var shippers_html = '';
    var is_verified = '';
    var is_organic = '';
    var shipper_country = '';
    var shipper_source = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/shippers/json",
        type: "get",
        data: {"rows_numbers": rows_numbers},
        success: function(response){

            $("#shippers_counter").text(response.shippers_count);
            $('#pagination').html(response.pagination); 

            response.shippers.data.forEach(function(shipper) {

                if(shipper.shipper_country){
                    shipper_country = shipper.shipper_country.en_name;
                }

                
                if(shipper.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
    
                if(shipper.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }


                shippers_html = shippers_html +
                
                "<div class=\"modal fade\" id=\"delete_shipper_"+ shipper.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ shipper.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ shipper.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_shipper("+ shipper.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+ 
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"shipper_id[]\" value=\""+ shipper.id +"\" ></input> </td>\n" +
                "<td>"+ shipper.id +"</td>\n"+
                "<td>"+ shipper.full_name +"</td>\n"+
                "<td>"+ shipper.email +"</td>\n"+
                "<td>"+ shipper.phone +"</td>\n"+
                "<td>"+ shipper.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>"+
                "<td>"+ shipper_country +"</td>"+
                "<td>"+ shipper.company +"</td>"+
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
                "</td>\n"+
                "</tr>\n"
            });

            $("#shippers_table_body").html(shippers_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var shippers_html = '';
    var is_verified = '';
    var is_organic = '';
    var shipper_country = '';
    var shipper_source = '';

    // filter data
    var countries = $('#filter_by_country').val(); 
    var shipper_name = $('#shipper_name').val(); 
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/shippers/filter",
        type: "post",
        data: {
            'countries': countries,
            'rows_numbers': rows_numbers,
            'shipper_name': shipper_name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#shippers_counter").text(response.shippers_count);
            $('#pagination').html(response.pagination);

            response.shippers.data.forEach(function(shipper) {

                if(shipper.shipper_country){
                    shipper_country = shipper.shipper_country.en_name;
                }

                
                if(shipper.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
    
                if(shipper.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }


                shippers_html = shippers_html +
                
                "<div class=\"modal fade\" id=\"delete_shipper_"+ shipper.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ shipper.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ shipper.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_shipper("+ shipper.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"shipper_id[]\" value=\""+ shipper.id +"\" ></input> </td>\n" +
                "<td>"+ shipper.id +"</td>\n"+
                "<td>"+ shipper.full_name +"</td>\n"+
                "<td>"+ shipper.email +"</td>\n"+
                "<td>"+ shipper.phone +"</td>\n"+
                "<td>"+ shipper.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>"+
                "<td>"+ shipper_country +"</td>"+
                "<td>"+ shipper.company +"</td>"+
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
                "</td>\n"+
                "</tr>\n"
            });

            $("#shippers_table_body").html(shippers_html);

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

    var shippers_html = '';
    var is_verified = '';
    var is_organic = '';
    var shipper_country = '';
    var shipper_source = '';

    // filter data
    var countries = $('#filter_by_country').val(); 
    var shipper_name = $('#shipper_name').val(); 
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/shippers/filter",
        type: "post",
        data: {
            'countries': countries,
            'rows_numbers': rows_numbers,
            'shipper_name': shipper_name,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#shippers_counter").text(response.shippers_count);
            $('#pagination').html(response.pagination);

            response.shippers.data.forEach(function(shipper) {

                if(shipper.shipper_country){
                    shipper_country = shipper.shipper_country.en_name;
                }

                
                if(shipper.verified == 1){
                    is_verified = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_verified = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }
    
                if(shipper.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green;\"></i>";
                }else{
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red;\"></i>";
                }


                shippers_html = shippers_html +
                
                "<div class=\"modal fade\" id=\"delete_shipper_"+ shipper.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ shipper.full_name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ shipper.full_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_shipper("+ shipper.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"shipper_id[]\" value=\""+ shipper.id +"\" ></input> </td>\n" +
                "<td>"+ shipper.id +"</td>\n"+
                "<td>"+ shipper.full_name +"</td>\n"+
                "<td>"+ shipper.email +"</td>\n"+
                "<td>"+ shipper.phone +"</td>\n"+
                "<td>"+ shipper.date_added +"</td>\n"+
                "<td>"+ is_verified +"</td>"+
                "<td>"+ shipper_country +"</td>"+
                "<td>"+ shipper.company +"</td>"+
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
                "</td>\n"+
                "</tr>\n"
            });

            $("#shippers_table_body").html(shippers_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});

// to delete (archive) supplier
function archive_shipper(shipper_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/shippers/" + shipper_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}