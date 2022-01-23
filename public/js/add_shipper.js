$('#country').on('change', function() {
    var country_code  = $(this).val();
    $.ajax({
        url: "/shippers/create/getCities/" + country_code,  
        type: "get", 
        success: function(response){
            $('#city').html(response.state_html);
            $('#phone').val(response.phone_code);
        }
    });
});