
window.global_user_id = 0; 

$("#search_user").autocomplete({
    minLength: 1,
    source: function (request, response) {
        $.ajax({
            url: "/membershipsTransactions/searchUsers",
            dataType: "json",
            data: {term: request.term},
            success: function (data) {
                response($.map(data, function (item) {
                    return {
                        label: item.value,
                        value: item.value,
                        id: item.id
                    };
                }));
            },
        });
    },
    select: function (event, ui) {
        global_user_id = ui.item.id;
        $('#user_id').val(global_user_id);
    }
});

$("#search_user").autocomplete("option", "appendTo", ".autocomplete-user");

