// to upload logo logo
$(document).on('change', '#logo-input', function () {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("#logo_preview");
        dvPreview.html("");
        $($(this)[0].files).each(function () {
            var file = $(this);
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img />");
                img.attr("style", "width: 150px; height:150px; padding: 10px");
                img.attr("src", e.target.result);
                dvPreview.append(img);
            }
            reader.readAsDataURL(file[0]);
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});

// to upload main banner
$(document).on('change', '#main-banner-input', function () {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("#main-banner-preview");
        dvPreview.html("");
        $($(this)[0].files).each(function () {
            var file = $(this);
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img />");
                img.attr("style", "width: 90%; height:90%; padding: 10px");
                img.attr("src", e.target.result);
                dvPreview.append(img);
            }
            reader.readAsDataURL(file[0]);
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});


// to upload right banner 1
$(document).on('change', '#right-banner-1-input', function () {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("#right-banner-1-preview");
        dvPreview.html("");
        $($(this)[0].files).each(function () {
            var file = $(this);
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img />");
                img.attr("style", "width: 90%; height:90%; padding: 10px");
                img.attr("src", e.target.result);
                dvPreview.append(img);
            }
            reader.readAsDataURL(file[0]);
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});


// to upload right banner 2
$(document).on('change', '#right-banner-2-input', function () {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("#right-banner-2-preview");
        dvPreview.html("");
        $($(this)[0].files).each(function () {
            var file = $(this);
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img />");
                img.attr("style", "width: 90%; height:90%; padding:10px");
                img.attr("src", e.target.result);
                dvPreview.append(img);
            }
            reader.readAsDataURL(file[0]);
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});



// to upload left banner 
$(document).on('change', '#left-banner-input', function () {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("#left-banner-preview");
        dvPreview.html("");
        $($(this)[0].files).each(function () {
            var file = $(this);
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img />");
                img.attr("style", "width: 90%; height:90%; padding: 10px");
                img.attr("src", e.target.result);
                dvPreview.append(img);
            }
            reader.readAsDataURL(file[0]);
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});
