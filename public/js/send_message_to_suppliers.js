var email_editor ; 

document.addEventListener("DOMContentLoaded", function() {
    if (!window.Quill) {
        return $("#email-editor,#email-toolbar").remove();
    }
    email_editor = new Quill("#email-editor", { 
        modules: {
            toolbar: "#email-toolbar"
        },
        placeholder: "Type something",
        theme: "snow"
    });
}); 

$("#send_email_btn").on('click', function() {
    $("#ajax_loader").css('display', 'block');
    var subject = $("#subject").val();
    var suppliers_id = $(".selected_items").map(function() {
        return $(this).val();
    }).get();
    var email_content = email_editor.root.innerHTML;
    var url = $("#suppliers_actions_form").attr('action');
    
    $.ajax({
        url: url,
        data: {
            "suppliers_id": suppliers_id,
            "subject": subject,
            "email_content": email_content,
            "send_message_to_suppliers": true,
            "_token": csrf_token
        },
        method: "post",
        success: function(response) {
            location.reload();
        }
    });
});
