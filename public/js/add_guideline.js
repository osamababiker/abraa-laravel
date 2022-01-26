
document.addEventListener("DOMContentLoaded", function() {
    if (!window.Quill) {
        return $("#ar-editor,#ar-toolbar,#en-editor,#en-toolbar,#cn-editor,#cn-toolbar,#ru-editor,#ru-toolbar,#tr-editor,#tr-toolbar,#pr-editor,#pr-toolbar").remove();
    }
    var ar_editor = new Quill("#ar-editor", { 
        modules: {
            toolbar: "#ar-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });

    var en_editor = new Quill("#en-editor", { 
        modules: {
            toolbar: "#en-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });

    var cn_editor = new Quill("#cn-editor", { 
        modules: {
            toolbar: "#cn-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });

    var ru_editor = new Quill("#ru-editor", { 
        modules: {
            toolbar: "#ru-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });

    var tr_editor = new Quill("#tr-editor", { 
        modules: {
            toolbar: "#tr-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });

    var pr_editor = new Quill("#pr-editor", { 
        modules: {
            toolbar: "#pr-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });
});



$("#add_guideline_btn").on('click', function() {
    var ar_title = $("#ar_title").val();
    var en_title = $("#en_title").val();
    var cn_title = $("#cn_title").val();
    var ru_title = $("#ru_title").val();
    var tr_title = $("#tr_title").val();
    var pr_title = $("#pr_title").val();
    var guideline_type = $("#guideline_type").val();
    var active = $("#active").val();
    var ar_content = $("#ar-editor").html();
    var en_content = $("#en-editor").html();
    var cn_content = $("#cn-editor").html();
    var ru_content = $("#ru-editor").html();
    var tr_content = $("#tr-editor").html();
    var pr_content = $("#pr-editor").html();
    
    var url = $("#add_guideline_form").attr('action');

    $.ajax({
        url: url,
        data: {
            "guideline_type": guideline_type,
            "active": active,
            "ar_title": ar_title,
            "en_title": en_title,
            "cn_title": cn_title,
            "ru_title": ru_title,
            "tr_title": tr_title,
            "pr_title": pr_title,
            "ar_content": ar_content,
            "en_content": en_content,
            "cn_content": cn_content,
            "ru_content": ru_content,
            "tr_content": tr_content,
            "pr_content": pr_content,
            "_token": csrf_token
        },
        method: "post",
        success: function(response) {
            location.reload();
        }
    });
});
