window.current_page = 1; 
// ==============================================================//
// when the page is load 
$(".filter_data_table").on('change', function () {

    $("#ajax_loader").css('display', 'block');

    var users_html = '';
    var user_store = '';
    var country = '';

    // filter data
    var supplier_name = $('#supplier_name').val(); 
    var buyer_name = $('#buyer_name').val(); 
    var keywords = $('#keywords').val();
    var rows_numbers = $('#rows_numbers').val(); 

    $.ajax({ 
        url: "/abraaMessages/users/filter",
        type: "post",
        data: {
            'supplier_name': supplier_name,
            'buyer_name': buyer_name,
            'keywords': keywords,
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $('#pagination').html(response.pagination);
            response.users.data.forEach(function(user) {

                if(user.store){
                    user_store = user.store.name;
                }

                if(user.member_country){
                    country = user.member_country.en_name;
                }

                users_html = users_html +
                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"user_email[]\" value=\""+ user.email +"\" ></input> </td>\n" +
                "<td>\n"+ user_store +"</td>\n"+
                "<td>\n"+ user.full_name +"</td>\n"+
                "<td>"+ user.email +"</td>\n"+
                "<td>"+ user.phone +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td></td>\n"+
                "<td></td>\n"
            });

            $("#send_abraa_messages_table_body").html(users_html);
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

    var users_html = '';
    var user_store = '';
    var country = '';

    // filter data
    var supplier_name = $('#supplier_name').val(); 
    var buyer_name = $('#buyer_name').val(); 
    var keywords = $('#keywords').val();
    var rows_numbers = $('#rows_numbers').val();  

    $.ajax({ 
        url: "/abraaMessages/users/filter",
        type: "post",
        data: {
            'supplier_name': supplier_name,
            'buyer_name': buyer_name,
            'keywords': keywords,
            'rows_numbers': rows_numbers,
            'current_page': window.current_page,
            '_token': csrf_token
        },
        success: function(response){

            $('#pagination').html(response.pagination);
            response.users.data.forEach(function(user) {

                if(user.store){
                    user_store = user.store.name;
                }

                if(user.member_country){
                    country = user.member_country.en_name;
                }

                users_html = users_html +
                "<tr>\n"+
                "<td> <input type=\"checkbox\" class=\"selected_items\" name=\"user_email[]\" value=\""+ user.email +"\" ></input> </td>\n" +
                "<td>\n"+ user_store +"</td>\n"+
                "<td>\n"+ user.full_name +"</td>\n"+
                "<td>"+ user.email +"</td>\n"+
                "<td>"+ user.phone +"</td>\n"+
                "<td>"+ country +"</td>\n"+
                "<td></td>\n"+
                "<td></td>\n"
            });

            $("#send_abraa_messages_table_body").html(users_html);
            $("#ajax_loader").css('display', 'none');
        }
    });
});


 
