
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


   
    // to append data to editor
    $.ajax({
        url: "/guidelines/edit/getEditorData",
        method: "get",
        data: {"guideline_id": guideline_id},
        success: function(response){
            // ar content
            var ar_content_value = response.ar_content;
            var delta = ar_editor.clipboard.convert(ar_content_value)
            ar_editor.setContents(delta, 'silent')
            // en content
            var en_content_value = response.en_content;
            var delta = en_editor.clipboard.convert(en_content_value)
            en_editor.setContents(delta, 'silent')
            // cn content
            var cn_content_value = response.cn_content;
            var delta = cn_editor.clipboard.convert(cn_content_value)
            cn_editor.setContents(delta, 'silent')
            // ru content
            var ru_content_value = response.ru_content;
            var delta = ru_editor.clipboard.convert(ru_content_value)
            ru_editor.setContents(delta, 'silent')
            // tr content
            var tr_content_value = response.tr_content;
            var delta = tr_editor.clipboard.convert(tr_content_value)
            tr_editor.setContents(delta, 'silent')
            // pr content
            var pr_content_value = response.pr_content;
            var delta =pr_editor.clipboard.convert(pr_content_value)
            pr_editor.setContents(delta, 'silent')
        }
    });

});



$("#edit_guideline_btn").on('click', function() {
    var guideline_id = $("#guideline_id").val();
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
    
    var url = $("#edit_guideline_form").attr('action');

    $.ajax({
        url: url,
        data: {
            "guideline_id": guideline_id,
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
