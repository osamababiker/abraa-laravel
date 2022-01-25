
window.global_supplier = 0; 

// to get suppliers details to approve rfq
$(function(){ 
    $("#search_supplier").autocomplete({
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: "/suppliersVerification/getsupplierDetails",
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
            global_supplier = ui.item.id;
            $('#user_id').val(global_supplier);
        }
    });

    $("#search_supplier").autocomplete("option", "appendTo", ".autocomplete-supplier");
});