window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var buyers_html = '';
    var buyer_status = '';
    var added_by = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/homePageBuyers/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){
            
            $("#home_buyers_counter").text(response.buyers_count);
            $('#pagination').html(response.pagination);

            response.buyers.data.forEach(function(buyer) {

                if(buyer.status == 1)
                    buyer_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    buyer_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(buyer.added_by_admin){
                    added_by = buyer.added_by_admin.name;
                }


                buyers_html = buyers_html +
                
                "<div class=\"modal fade\" id=\"delete_buyer_"+ buyer.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this buyer </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move buyer to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_buyer("+ buyer.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+ 
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"buyer_id[]\" value=\""+ buyer.id +"\" ></input> </td>\n" +
                "<td>"+ buyer.id +"</td>\n"+
                "<td>"+ buyer.buyername +"</td>\n"+
                "<td> <img src=\" " + buyer.buyer_logo + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td> <a href=\""+ buyer.buyer_link +"\" target=\"_blank\"> "+ buyer.buyer_link +" </a> </td>\n"+
                "<td>"+ added_by +"</td>\n"+
                "<td>"+ buyer.added_date +"</td>\n"+
                "<td>"+ buyer_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/homePageBuyers/"+ buyer.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/homePageBuyers/"+ buyer.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyer_"+ buyer.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#home_buyers_table_body").html(buyers_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});


// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var buyers_html = '';
    var buyer_status = '';
    var added_by = '';

    // filter data
    var buyer_name = $('#buyer_name').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/homePageBuyers/filter",
        type: "post",
        data: {
            'buyer_name': buyer_name,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
            '_token': csrf_token
        },
        success: function(response){
            
            $("#home_buyers_counter").text(response.buyers_count);
            $('#pagination').html(response.pagination);

            response.buyers.data.forEach(function(buyer) {

                if(buyer.status == 1)
                    buyer_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    buyer_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(buyer.added_by_admin){
                    added_by = buyer.added_by_admin.name;
                }


                buyers_html = buyers_html +
                
                "<div class=\"modal fade\" id=\"delete_buyer_"+ buyer.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this buyer </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move buyer to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_buyer("+ buyer.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+ 
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"buyer_id[]\" value=\""+ buyer.id +"\" ></input> </td>\n" +
                "<td>"+ buyer.id +"</td>\n"+
                "<td>"+ buyer.buyername +"</td>\n"+
                "<td> <img src=\" " + buyer.buyer_logo + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td> <a href=\""+ buyer.buyer_link +"\" target=\"_blank\"> "+ buyer.buyer_link +" </a> </td>\n"+
                "<td>"+ added_by +"</td>\n"+
                "<td>"+ buyer.added_date +"</td>\n"+
                "<td>"+ buyer_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/homePageBuyers/"+ buyer.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/homePageBuyers/"+ buyer.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyer_"+ buyer.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#home_buyers_table_body").html(buyers_html);

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

    var buyers_html = '';
    var buyer_status = '';
    var added_by = '';

    // filter data
    var buyer_name = $('#buyer_name').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/homePageBuyers/filter",
        type: "post",
        data: {
            'buyer_name': buyer_name,
            'current_page': window.current_page,
            'rows_numbers': rows_numbers,
            '_token': csrf_token
        },
        success: function(response){
            
            $("#home_buyers_counter").text(response.buyers_count);
            $('#pagination').html(response.pagination);

            response.buyers.data.forEach(function(buyer) {

                if(buyer.status == 1)
                    buyer_status = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                else{ 
                    buyer_status = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                if(buyer.added_by_admin){
                    added_by = buyer.added_by_admin.name;
                }


                buyers_html = buyers_html +
                
                "<div class=\"modal fade\" id=\"delete_buyer_"+ buyer.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this buyer </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move buyer to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\" style=\"justify-content: center;\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_buyer("+ buyer.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+ 
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"buyer_id[]\" value=\""+ buyer.id +"\" ></input> </td>\n" +
                "<td>"+ buyer.id +"</td>\n"+
                "<td>"+ buyer.buyername +"</td>\n"+
                "<td> <img src=\" " + buyer.buyer_logo + " \" style=\"width: 100px; height: 100px\" /> </td>\n"+
                "<td> <a href=\""+ buyer.buyer_link +"\" target=\"_blank\"> "+ buyer.buyer_link +" </a> </td>\n"+
                "<td>"+ added_by +"</td>\n"+
                "<td>"+ buyer.added_date +"</td>\n"+
                "<td>"+ buyer_status +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/homePageBuyers/"+ buyer.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/homePageBuyers/"+ buyer.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_buyer_"+ buyer.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#home_buyers_table_body").html(buyers_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) buyer
function archive_buyer(buyer_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/homePageBuyers/" + buyer_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}