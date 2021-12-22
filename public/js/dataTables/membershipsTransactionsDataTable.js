$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var membershipsTransactions_html = '';
    var user = '';
    var plan = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/membershipsTransactions/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){
            
            $("#memberships_transactions_counter").text(response.membershipsTransactions_count);

            response.membershipsTransactions.forEach(function(transaction) {

                if(transaction.user){
                    user = transaction.user.full_name;
                }

                if(transaction.plan){
                    plan = transaction.plan.name;
                }

                membershipsTransactions_html = membershipsTransactions_html +
                
                "<div class=\"modal fade\" id=\"delete_transaction_"+ transaction.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this transaction </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this transaction to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_transaction("+ transaction.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"transaction_id[]\" value=\""+ transaction.id +"\" ></input> </td>\n" +
                "<td>"+ transaction.id +"</td>\n"+
                "<td>"+ user +"</td>\n"+
                "<td>"+ plan +"</td>\n"+
                "<td>"+ transaction.total_amount +"</td>\n"+
                "<td>"+ transaction.payment_status +"</td>\n"+
                "<td>"+ transaction.subscription_status +"</td>\n"+
                "<td>"+ transaction.start_date +"</td>\n"+
                "<td>"+ transaction.end_date +"</td>\n"+
                "<td>"+ transaction.payment_date +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/membershipsTransactions/"+ transaction.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/membershipsTransactions/"+ transaction.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_transaction_"+ transaction.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#memberships_transactions_table_body").html(membershipsTransactions_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var membershipsTransactions_html = '';
    var user = '';
    var plan = '';

    // filter data
    var payment_status = $('#payment_status').val(); 
    var subscription_status = $('#subscription_status').val(); 
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/membershipsTransactions/filter",
        type: "post",
        data: {
            'subscription_status': subscription_status,
            'payment_status': payment_status,
            "rows_numbers": rows_numbers
        },
        success: function(response){
            
            $("#memberships_transactions_counter").text(response.membershipsTransactions_count);

            response.membershipsTransactions.forEach(function(transaction) {

                if(transaction.user){
                    user = transaction.user.full_name;
                }

                if(transaction.plan){
                    plan = transaction.plan.name;
                }

                membershipsTransactions_html = membershipsTransactions_html +
                
                "<div class=\"modal fade\" id=\"delete_transaction_"+ transaction.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive this transaction </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move this transaction to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_transaction("+ transaction.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" name=\"transaction_id[]\" value=\""+ transaction.id +"\" ></input> </td>\n" +
                "<td>"+ transaction.id +"</td>\n"+
                "<td>"+ user +"</td>\n"+
                "<td>"+ plan +"</td>\n"+
                "<td>"+ transaction.total_amount +"</td>\n"+
                "<td>"+ transaction.payment_status +"</td>\n"+
                "<td>"+ transaction.subscription_status +"</td>\n"+
                "<td>"+ transaction.start_date +"</td>\n"+
                "<td>"+ transaction.end_date +"</td>\n"+
                "<td>"+ transaction.payment_date +"</td>\n"+
                "<td class=\"table-action\">\n"+
                    "<a target=\"_blank\" href=\"/membershipsTransactions/"+ transaction.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/membershipsTransactions/"+ transaction.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_transaction_"+ transaction.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#memberships_transactions_table_body").html(membershipsTransactions_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) transaction
function archive_transaction(category_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/membershipsTransactions/" + category_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}