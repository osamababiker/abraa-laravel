window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () { 

    $("#ajax_loader").css('display', 'block');

    var stores_html = '';
    var user_email = '';
    var store_url = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var stores_status = $('#stores_status').val();

    $.ajax({
        url: "/rejectedStores/json",
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
            "stores_status": stores_status
        },
        success: function(response){

            $("#stores_counter").text(response.stores_count);
            $('#pagination').html(response.pagination); 
            
            response.stores.data.forEach(function(store) {

                if(store.user){
                    user_email = store.user.email;
                    store_url = "<a target=\"_blank\" href=\""+ public_url +"store/"+ store.user.id +"\"> "+ public_url +"store/"+ store.user.id +"</a>";
                }else{
                    user_email = '';
                    store_url = '';
                }


                stores_html = stores_html +
                
                "<div class=\"modal fade\" id=\"delete_store_"+ store.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
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
                            "<button type=\"button\" onclick=\"archive_store("+ store.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"store_id[]\" value=\""+ store.id +"\" ></input> </td>\n" +
                "<td>"+ store.id +"</td>\n"+
                "<td> <button onclick=\"approve_store("+ store.id  +")\" name=\"approve_single_store_btn\" class=\"btn btn-success\" type=\"button\"> <i class=\"fa fa-check\" style=\"color: #fff\"></i> </button> </td>\n"+
                "<td>"+ user_email +"</td>\n"+
                "<td>"+ store.name +"</td>\n"+
                "<td>"+ store_url +"</td>\n"+
                "<td> <img style=\"width: 100px; height: 100px;\" src=\""+ store.logo_url +"\" alt=\""+ store.name +"\"/> </td>\n"+
                "<td>"+ store.noofvisits +"</td>\n"+
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


// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var stores_html = '';
    var user_email = '';
    var store_url = '';

    // filter data
    var store_name = $('#store_name').val(); 
    var store_country = $('#store_country').val(); 
    var meta_keyword = $('#meta_keyword').val(); 
    var rows_numbers = $('#rows_numbers').val(); 
    var date_range = $('#date_range').val();
    var stores_status = $('#stores_status').val();

    $.ajax({
        url: "/rejectedStores/filter",
        type: "post",
        data: {
            'store_name': store_name,
            'store_country': store_country,
            'rows_numbers': rows_numbers,
            'meta_keyword': meta_keyword,
            'date_range': date_range,
            "stores_status": stores_status,
            "current_page": window.current_page,
            "_token": csrf_token
        },
        success: function(response){

            $("#stores_counter").text(response.stores_count);
            $('#pagination').html(response.pagination); 

            response.stores.data.forEach(function(store) {

                if(store.user){
                    user_email = store.user.email;
                    store_url = "<a target=\"_blank\" href=\""+ public_url +"store/"+ store.user.id +"\"> "+ public_url +"store/"+ store.user.id +"</a>";
                }else{
                    user_email = '';
                    store_url = '';
                }


                stores_html = stores_html +
                
                "<div class=\"modal fade\" id=\"delete_store_"+ store.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
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
                            "<button type=\"button\" onclick=\"archive_store("+ store.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"store_id[]\" value=\""+ store.id +"\" ></input> </td>\n" +
                "<td>"+ store.id +"</td>\n"+
                "<td> <button onclick=\"approve_store("+ store.id  +")\" name=\"approve_single_store_btn\" class=\"btn btn-success\" type=\"button\"> <i class=\"fa fa-check\" style=\"color: #fff\"></i> </button> </td>\n"+
                "<td>"+ user_email +"</td>\n"+
                "<td>"+ store.name +"</td>\n"+
                "<td>"+ store_url +"</td>\n"+
                "<td> <img style=\"width: 100px; height: 100px;\" src=\""+ store.logo_url +"\" alt=\""+ store.name +"\"/> </td>\n"+
                "<td>"+ store.noofvisits +"</td>\n"+
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


// ==============================================================//
// to handel pagination 
$("#pagination").on('click', 'a', function(e) {
    e.preventDefault();
    window.current_page = this.href.split('=')[1];
    $("#ajax_loader").css('display', 'block');

    var stores_html = '';
    var user_email = '';
    var store_url = '';

    // filter data
    var store_name = $('#store_name').val(); 
    var store_country = $('#store_country').val(); 
    var meta_keyword = $('#meta_keyword').val(); 
    var rows_numbers = $('#rows_numbers').val(); 
    var date_range = $('#date_range').val();
    var stores_status = $('#stores_status').val();

    $.ajax({
        url: "/rejectedStores/filter",
        type: "post",
        data: {
            'store_name': store_name,
            'store_country': store_country,
            'rows_numbers': rows_numbers,
            'meta_keyword': meta_keyword,
            "stores_status": stores_status,
            'date_range': date_range,
            "current_page": window.current_page,
            "_token": csrf_token
        },
        success: function(response){

            $("#stores_counter").text(response.stores_count);
            $('#pagination').html(response.pagination); 

            response.stores.data.forEach(function(store) {

                if(store.user){
                    user_email = store.user.email;
                    store_url = "<a target=\"_blank\" href=\""+ public_url +"store/"+ store.user.id +"\"> "+ public_url +"store/"+ store.user.id +"</a>";
                }else{
                    user_email = '';
                    store_url = '';
                }


                stores_html = stores_html +
                
                "<div class=\"modal fade\" id=\"delete_store_"+ store.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
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
                            "<button type=\"button\" onclick=\"archive_store("+ store.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"store_id[]\" value=\""+ store.id +"\" ></input> </td>\n" +
                "<td>"+ store.id +"</td>\n"+
                "<td> <button onclick=\"approve_store("+ store.id  +")\" name=\"approve_single_store_btn\" class=\"btn btn\" type=\"button\"> <i class=\"fa fa-check\" style=\"color: #fff\"></i> </button> </td>\n"+
                "<td>"+ user_email +"</td>\n"+
                "<td>"+ store.name +"</td>\n"+
                "<td>"+ store_url +"</td>\n"+
                "<td> <img style=\"width: 100px; height: 100px;\" src=\""+ store.logo_url +"\" alt=\""+ store.name +"\"/> </td>\n"+
                "<td>"+ store.noofvisits +"</td>\n"+
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


// to delete (archive) store
function archive_store(store_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/stores/" + store_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}

function approve_store(store_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/stores/actions",
        type: "post",
        data: {
            "_token": csrf_token,
            'store_id': store_id, 
            'approve_single_store_btn': ''
        },
        success: function(response){
            location.reload();
        }
    });
}