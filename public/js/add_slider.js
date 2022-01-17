// to upload slider 
$(document).on('change', '#slider-input', function () {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("#slider_preview");
        dvPreview.html("");
        $($(this)[0].files).each(function () {
            var file = $(this);
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img />");
                img.attr("style", "width: 150px; height:100px; padding: 10px");
                img.attr("src", e.target.result);
                dvPreview.append(img);
            }
            reader.readAsDataURL(file[0]);
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});
