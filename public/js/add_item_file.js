
window.global_item = 0; 

$("#search_item").autocomplete({
    minLength: 1,
    source: function (request, response) {
        $.ajax({
            url: "/itemsFiles/getItemsData",
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
        global_item = ui.item.id;
        $('#item_id').val(global_item);
    }
});

$("#search_item").autocomplete("option", "appendTo", ".autocomplete-item");



// for image preview 
$(document).on('change', '#file-input', function () {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("#itme_file_preview");
        dvPreview.html("");
        $($(this)[0].files).each(function () {
            var file = $(this);
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img />");
                img.attr("style", "width: 250px; height:100px; padding: 10px");
                img.attr("src", e.target.result);
                dvPreview.append(img);
            }
            reader.readAsDataURL(file[0]);
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});