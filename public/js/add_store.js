// to upload logo 
$(document).on('change', '#logo-input', function () {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("#logo_preview");
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

// to upload banner 1
$(document).on('change', '#banner1-input', function () {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("#banner1_preview");
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

// to upload banner 2
$(document).on('change', '#banner2-input', function () {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("#banner2_preview");
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

// to upload banner 3
$(document).on('change', '#banner3-input', function () {
    if (typeof (FileReader) != "undefined") {
        var dvPreview = $("#banner3_preview");
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


$('#membership_date').hide();
$('input:radio[name="membership"]').change(
function () {
    if ($(this).is(':checked')) {
        if ($(this).val() == 'silver' || $(this).val() == 'gold' || $(this).val() == 'platinum') {
            $('#membership_date').show();
        } else {
            $('#membership_date').hide();
        }
    }
});





