
window.global_category = 0; 
window.global_supplier = 0; 

// to get suppliers details to approve rfq
$(function(){ 
    $(".autocomplete").on('click', function() {
        $("#category_search").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var is_category = 1;
                $.ajax({
                    url: "/items/import/excel/getData",
                    dataType: "json",
                    data: {term: request.term, is_category: is_category},
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
                global_category = ui.item.id;
                $('#category_id').val(global_category);
            }
        });

        $("#category_search").autocomplete("option", "appendTo", ".autocomplete-category");

        $("#supplier_search").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var is_supplier = 1;

                $.ajax({
                    url: "/items/import/excel/getData",
                    dataType: "json",
                    data: {term: request.term, is_supplier: is_supplier},
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
                $('#supplier_id').val(global_supplier);
            }
        });
        $("#supplier_search").autocomplete("option", "appendTo", ".autocomplete-supplier");
    });
});