$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var stores_html = '';
    var user_email = '';
    var store_verified = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var stores_status = $('#stores_status').val();

    $.ajax({
        url: "/stores/json",
        type: "get",
        data: {
            "rows_numbers": rows_numbers,
            "stores_status": stores_status
        },
        success: function(response){

            $("#stores_counter").text(response.stores_count);

            response.stores.forEach(function(store) {

                if(store.user){
                    user_email = store.user.email;
                }

                if(store.store_verified == 1){
                    store_verified = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    store_verified = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                stores_html = stores_html +
                
                "<div class=\"modal fade\" id=\"delete_store_"+ store.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/stores/"+ store.id +"/destroy\" id=\"delete_store_form_"+ store.id +"\" method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ store.name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ store.name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"submit\" form=\"delete_store_form_"+ store.id +"\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"store_id[]\" value=\""+ store.id +"\" ></input> </td>\n" +
                "<td>"+ store.id +"</td>\n"+
                "<td>"+ user_email +"</td>\n"+
                "<td>"+ store.name +"</td>\n"+
                "<td> <a href=\"https://www.abraa.com/store/"+ store.id +"\"> https://www.abraa.com/store/"+ store.id +"</a> </td>\n"+
                "<td>"+ store.noofvisits +"</td>\n"+
                "<td>"+ store_verified +"</td>\n"+
                "<td>"+ store.contact_count +"</td>\n"+
                "<td>"+ store.date_added +"</td>\n"+
                "<td>  ggg</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/stores/"+ store.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/stores/"+ store.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_store_"+ store.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#stores_table_body").html(stores_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var stores_html = '';
    var store_verified = '';

    // filter data
    var store_name = $('#store_name').val(); 
    var store_country = $('#store_country').val(); 
    var meta_keyword = $('#meta_keyword').val(); 
    var rows_numbers = $('#rows_numbers').val(); 
    var stores_status = $('#stores_status').val();

    $.ajax({
        url: "/stores/filter",
        type: "post",
        data: {
            'store_name': store_name,
            'store_country': store_country,
            'rows_numbers': rows_numbers,
            'meta_keyword': meta_keyword,
            "stores_status": stores_status
        },
        success: function(response){

            $("#stores_counter").text(response.stores_count);

            response.stores.forEach(function(store) {

                if(store.user){
                    user_email = store.user.email;
                }

                if(store.store_verified == 1){
                    store_verified = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    store_verified = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                stores_html = stores_html +
                
                "<div class=\"modal fade\" id=\"delete_store_"+ store.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/stores/"+ store.id +"/destroy\" id=\"delete_store_form_"+ store.id +"\" method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive - "+ store.name +"</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move , "+ store.name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"submit\" form=\"delete_store_form_"+ store.id +"\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"store_id[]\" value=\""+ store.id +"\" ></input> </td>\n" +
                "<td>"+ store.id +"</td>\n"+
                "<td>"+ user_email +"</td>\n"+
                "<td>"+ store.name +"</td>\n"+
                "<td> <a href=\"https://www.abraa.com/store/"+ store.id +"\"> https://www.abraa.com/store/"+ store.id +"</a> </td>\n"+
                "<td>"+ store.noofvisits +"</td>\n"+
                "<td>"+ store_verified +"</td>\n"+
                "<td>"+ store.contact_count +"</td>\n"+
                "<td>"+ store.date_added +"</td>\n"+
                "<td>  </td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/stores/"+ store.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/stores/"+ store.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_store_"+ store.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#stores_table_body").html(stores_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});