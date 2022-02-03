var ar_editor , en_editor, cn_editor, ru_editor, tr_editor, pr_editor; 

document.addEventListener("DOMContentLoaded", function() {
    if (!window.Quill) {
        return $("#ar-editor,#ar-toolbar,#en-editor,#en-toolbar,#cn-editor,#cn-toolbar,#ru-editor,#ru-toolbar,#tr-editor,#tr-toolbar,#pr-editor,#pr-toolbar").remove();
    }
    ar_editor = new Quill("#ar-editor", { 
        modules: {
            toolbar: "#ar-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });

    en_editor = new Quill("#en-editor", { 
        modules: {
            toolbar: "#en-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });

    cn_editor = new Quill("#cn-editor", { 
        modules: {
            toolbar: "#cn-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });

    ru_editor = new Quill("#ru-editor", { 
        modules: {
            toolbar: "#ru-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });

    tr_editor = new Quill("#tr-editor", { 
        modules: {
            toolbar: "#tr-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });

    pr_editor = new Quill("#pr-editor", { 
        modules: {
            toolbar: "#pr-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });
});



$("#add_page_btn").on('click', function() {
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
    var ar_content = ar_editor.root.innerHTML;
    var en_content = en_editor.root.innerHTML;
    var cn_content = cn_editor.root.innerHTML;
    var ru_content = ru_editor.root.innerHTML;
    var tr_content = tr_editor.root.innerHTML;
    var pr_content = pr_editor.root.innerHTML;
    
    var url = $("#add_page_form").attr('action');

    $.ajax({
        url: url,
        data: {
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
