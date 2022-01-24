
window.global_buyer = 0; 
window.global_product = 0; 

// to get suppliers details to approve rfq
$(function(){ 
    $(".autocomplete").on('click', function() {
        $("#buyer_search").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var is_buyer = 1;
                $.ajax({
                    url: "/rfqs/create/getBuyerProductDetails",
                    dataType: "json",
                    data: {term: request.term, is_buyer: is_buyer},
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
                global_buyer = ui.item.id;
                $('#buyer_id').val(global_buyer);
            }
        });

        $("#buyer_search").autocomplete("option", "appendTo", ".autocomplete-buyer");

        $("#product_search").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var is_product = 1;

                $.ajax({
                    url: "/rfqs/create/getBuyerProductDetails",
                    dataType: "json",
                    data: {term: request.term, is_product: is_product},
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
                global_product = ui.item.id;
                $('#item_id').val(global_product);
            }
        });
        $("#product_search").autocomplete("option", "appendTo", ".autocomplete-product");
    });
});