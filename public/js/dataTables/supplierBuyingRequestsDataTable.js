window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var buying_requests_html = '';
    var supplier_name = '';
    var buying_request = '';
    var is_organic = '';
    var is_seen = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/suppliers/"+ supplier_id +"/buyingRequests/json",
        type: "get",
        cache: false,
        data: {"rows_numbers": rows_numbers},
        success: function(response){

            $("#buying_requests_counter").text(response.buying_requests_count);
            $('#pagination').html(response.pagination);

            response.buying_requests.data.forEach(function(request) {

                if(request.supplier){
                    supplier_name = request.supplier.full_name;
                }

                if(request.buying_request){
                    buying_request = request.buying_request.product_name;
                }

                if(request.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(request.seen == 1){
                    is_seen = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_seen = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                buying_requests_html = buying_requests_html +
                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_request_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/buying_requests/"+ request.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this request</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this request to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_request("+ request.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" class=\"request_id\" name=\"request_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buying_request +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td>"+ is_organic +"</td>\n"+
                "<td>"+ request.date_sent +"</td>\n"+
                "<td>"+ is_seen +"</td>\n"+
                "<td>"+ request.seen_at +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buying_requests/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/buying_requests/"+ request.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_request_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyingRequests_table_body").html(buying_requests_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var buying_requests_html = '';
    var supplier_name = '';
    var buying_request = '';
    var is_organic = '';
    var is_seen = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/suppliers/"+ supplier_id +"/buyingRequests/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#buying_requests_counter").text(response.buying_requests_count);
            $('#pagination').html(response.pagination); 

            response.buying_requests.data.forEach(function(request) {

                if(request.supplier){
                    supplier_name = request.supplier.full_name;
                }

                if(request.buying_request){
                    buying_request = request.buying_request.product_name;
                }

                if(request.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(request.seen == 1){
                    is_seen = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_seen = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                buying_requests_html = buying_requests_html +
                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_request_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/buying_requests/"+ request.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this request</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this request to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_request("+ request.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" class=\"request_id\" name=\"request_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buying_request +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td>"+ is_organic +"</td>\n"+
                "<td>"+ request.date_sent +"</td>\n"+
                "<td>"+ is_seen +"</td>\n"+
                "<td>"+ request.seen_at +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buying_requests/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/buying_requests/"+ request.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_request_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyingRequests_table_body").html(buying_requests_html);

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

    var buying_requests_html = '';
    var supplier_name = '';
    var buying_request = '';
    var is_organic = '';
    var is_seen = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({
        url: "/suppliers/"+ supplier_id +"/buyingRequests/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#buying_requests_counter").text(response.buying_requests_count);
            $('#pagination').html(response.pagination); 

            response.buying_requests.data.forEach(function(request) {

                if(request.supplier){
                    supplier_name = request.supplier.full_name;
                }

                if(request.buying_request){
                    buying_request = request.buying_request.product_name;
                }

                if(request.is_organic == 1){
                    is_organic = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_organic = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(request.seen == 1){
                    is_seen = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_seen = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                buying_requests_html = buying_requests_html +
                
                // delete modal
                "<div class=\"modal fade\" id=\"delete_request_"+ request.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<form action=\"/buying_requests/"+ request.id +"/destroy\"  method=\"DELETE\">\n"+
                        "</form>\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this request</h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this request to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_request("+ request.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" class=\"request_id\" name=\"request_id[]\" value=\""+ request.id +"\" ></input> </td>\n" +
                "<td>"+ request.id +"</td>\n"+
                "<td>"+ buying_request +"</td>\n"+
                "<td>"+ supplier_name +"</td>\n"+
                "<td>"+ is_organic +"</td>\n"+
                "<td>"+ request.date_sent +"</td>\n"+
                "<td>"+ is_seen +"</td>\n"+
                "<td>"+ request.seen_at +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/buying_requests/"+ request.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/buying_requests/"+ request.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_request_"+ request.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#buyingRequests_table_body").html(buying_requests_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// to delete (archive) request
function archive_request(request_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/suppliers/buyingRequests/" + request_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}


