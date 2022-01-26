
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
        url: "/pages/edit/getEditorData",
        method: "get",
        data: {"page_id": page_id},
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



$("#edit_page_btn").on('click', function() {
    var page_id = $("#page_id").val();
    var ar_title = $("#ar_title").val();
    var en_title = $("#en_title").val();
    var cn_title = $("#cn_title").val();
    var ru_title = $("#ru_title").val();
    var tr_title = $("#tr_title").val();
    var pr_title = $("#pr_title").val();
    var ar_visits = $("#ar_visits").val();
    var en_visits = $("#en_visits").val();
    var cn_visits = $("#cn_visits").val();
    var ru_visits = $("#ru_visits").val();
    var tr_visits = $("#tr_visits").val();
    var pr_visits = $("#pr_visits").val();
    var slug = $("#slug").val();
    var meta_title = $("#meta_title").val();
    var sub_of = $("#sub_of").val();
    var sort_id = $("#sort_id").val();
    var meta_description = $("#meta_description").val();
    var meta_keyword = $("#meta_keyword").val();
    var ar_content = $("#ar-editor").html();
    var en_content = $("#en-editor").html();
    var cn_content = $("#cn-editor").html();
    var ru_content = $("#ru-editor").html();
    var tr_content = $("#tr-editor").html();
    var pr_content = $("#pr-editor").html();
    
    var url = $("#edit_page_form").attr('action');

    $.ajax({
        url: url,
        data: {
            "page_id": page_id,
            "slug": slug,
            "meta_title": meta_title,
            "sub_of": sub_of,
            "sort_id": sort_id,
            "meta_description": meta_description,
            "meta_keyword": meta_keyword,
            "ar_title": ar_title,
            "en_title": en_title,
            "cn_title": cn_title,
            "ru_title": ru_title,
            "tr_title": tr_title,
            "pr_title": pr_title,
            "ar_visits": ar_visits,
            "en_visits": en_visits,
            "cn_visits": cn_visits,
            "ru_visits": ru_visits,
            "tr_visits": tr_visits,
            "pr_visits": pr_visits,
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
