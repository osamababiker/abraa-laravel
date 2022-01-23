$('#country').on('change', function() {
    var country_id = $(this).val();
    $.ajax({
        url: "/buyers/create/getCities/" + country_id,  
        type: "get", 
        success: function(response){
            $('#city').html(response.state_html);
        }
    });
});