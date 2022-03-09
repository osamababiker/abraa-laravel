window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(document).ready(function () {

    $("#ajax_loader").css('display', 'block');

    var states_html = '';
    var state_country = '';
    var is_capital = '';

    // filter data
    var rows_numbers = $('#rows_numbers').val();

    $.ajax({
        url: "/states/json",  
        type: "get", 
        data: {
            "rows_numbers": rows_numbers,
        },
        success: function(response){

            $("#states_counter").text(response.states_count);
            $('#pagination').html(response.pagination);

            response.states.data.forEach(function(state) {

                if(state.country){
                    state_country = state.country.en_name;
                }else state_country = '';

                if(state.capital == 1){
                    is_capital = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_capital = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                states_html = states_html +
                
                "<div class=\"modal fade\" id=\"delete_state_"+ state.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ state.en_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ state.en_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_state("+ state.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"state_id[]\" value=\""+ state.id +"\" ></input> </td>\n" +
                "<td>"+ state.id +"</td>\n"+
                "<td>"+ state_country +"</td>\n"+
                "<td>"+ state.ar_name +"</td>\n"+
                "<td>"+ state.en_name +"</td>\n"+
                "<td>"+ is_capital +"</td>\n"+
                "<td class=\"table-action\" style=\"justify-content: center;\">\n"+
                    "<a target=\"_blank\" href=\"/states/"+ state.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/states/"+ state.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_state_"+ state.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#states_table_body").html(states_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});



// ==============================================================//
// to handel filteration 
$(".filter_data_table").on('change input', function () {

    $("#ajax_loader").css('display', 'block');

    var states_html = '';
    var state_country = '';
    var is_capital = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var state_name = $('#state_name').val();
    var state_countries = $('#state_countries').val();

    $.ajax({
        url: "/states/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'state_name': state_name,
            'state_countries': state_countries,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#states_counter").text(response.states_count);
            $('#pagination').html(response.pagination);

            response.states.data.forEach(function(state) {

                if(state.country){
                    state_country = state.country.en_name;
                }else state_country = '';

                if(state.capital == 1){
                    is_capital = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_capital = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                states_html = states_html +
                
                "<div class=\"modal fade\" id=\"delete_state_"+ state.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ state.en_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ state.en_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_state("+ state.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"state_id[]\" value=\""+ state.id +"\" ></input> </td>\n" +
                "<td>"+ state.id +"</td>\n"+
                "<td>"+ state_country +"</td>\n"+
                "<td>"+ state.ar_name +"</td>\n"+
                "<td>"+ state.en_name +"</td>\n"+
                "<td>"+ is_capital +"</td>\n"+
                "<td class=\"table-action\" style=\"justify-content: center;\">\n"+
                    "<a target=\"_blank\" href=\"/states/"+ state.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/states/"+ state.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_state_"+ state.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#states_table_body").html(states_html);

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

    var states_html = '';
    var state_country = '';
    var is_capital = '';
    
    // filter data
    var rows_numbers = $('#rows_numbers').val();
    var state_name = $('#state_name').val();
    var state_countries = $('#state_countries').val();

    $.ajax({
        url: "/states/filter",
        type: "post",
        data: {
            'rows_numbers': rows_numbers,
            'state_name': state_name,
            'state_countries': state_countries,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $("#states_counter").text(response.states_count);
            $('#pagination').html(response.pagination);

            response.states.data.forEach(function(state) {

                if(state.country){
                    state_country = state.country.en_name;
                }else state_country = '';

                if(state.capital == 1){
                    is_capital = "<i class=\"fa fa-check\" style=\"color: green\"></i>";
                }else {
                    is_capital = "<i class=\"fa fa-times\" style=\"color: red\"></i>";
                }

                states_html = states_html +
                
                "<div class=\"modal fade\" id=\"delete_state_"+ state.id +"\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"+
                "<div class=\"modal-dialog\" role=\"document\">\n"+
                    "<div class=\"modal-content\">\n"+
                        "<div class=\"modal-header\">\n"+
                            "<h5 class=\"modal-title\">Archive "+ state.en_name +" </h5>\n"+
                            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"+
                                "<span aria-hidden=\"true\">&times;</span>\n"+
                            "</button>\n"+
                        "</div>\n"+
                        "<div class=\"modal-body m-3\">\n"+
                            "<p class=\"mb-0\">Are you Sure you want to move "+ state.en_name +" to archive ??</p>\n"+
                        "</div>\n"+
                        "<div class=\"modal-footer\">\n"+
                            "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>\n"+
                            "<button type=\"button\" onclick=\"archive_state("+ state.id  +")\" class=\"btn btn-danger\">Yes Sure</button>\n"+
                        "</div>\n"+
                    "</div>\n"+
                    "</div>\n"+
                "</div>\n"+

                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"state_id[]\" value=\""+ state.id +"\" ></input> </td>\n" +
                "<td>"+ state.id +"</td>\n"+
                "<td>"+ state_country +"</td>\n"+
                "<td>"+ state.ar_name +"</td>\n"+
                "<td>"+ state.en_name +"</td>\n"+
                "<td>"+ is_capital +"</td>\n"+
                "<td class=\"table-action\" style=\"justify-content: center;\">\n"+
                    "<a target=\"_blank\" href=\"/states/"+ state.id +"\">\n"+
                        "<i class=\"align-middle fa fa-eye\" data-feather=\"eye\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a target=\"_blank\" href=\"/states/"+ state.id +"/edit\">\n"+
                        "<i class=\"align-middle fa fa-edit\" data-feather=\"edit-2\"></i>\n"+
                    "</a>\n"+
                    "&nbsp;"+
                    "<a href=\"#\" type=\"button\"  data-toggle=\"modal\" data-target=\"#delete_state_"+ state.id +"\">\n"+
                        "<i  class=\"align-middle fa fa-trash\" data-feather=\"trash\"></i>\n"+
                    "</a>\n"+
                "</td>\n"+
                "</tr>\n"
            });

            $("#states_table_body").html(states_html);

            $("#ajax_loader").css('display', 'none');
        }
    });
});




// to delete (archive) state
function archive_state(state_id){
    $("#ajax_loader").css('display', 'block');
    $.ajax({
        url: "/states/" + state_id + "/destroy",
        type: "get",
        success: function(response){
            location.reload();
        }
    });
}