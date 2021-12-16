
    document.addEventListener("DOMContentLoaded", function() {
        $("#smartwizard-default-primary").smartWizard({
            theme: "default",
            showStepURLhash: false
        });
        $("#smartwizard-default-success").smartWizard({
            theme: "default",
            showStepURLhash: false
        });
        $("#smartwizard-default-danger").smartWizard({
            theme: "default",
            showStepURLhash: false
        });
        $("#smartwizard-default-warning").smartWizard({
            theme: "default",
            showStepURLhash: false
        });
        $("#smartwizard-arrows-primary").smartWizard({
            theme: "arrows",
            showStepURLhash: false
        });
        $("#smartwizard-arrows-success").smartWizard({
            theme: "arrows",
            showStepURLhash: false
        });
        $("#smartwizard-arrows-danger").smartWizard({
            theme: "arrows",
            showStepURLhash: false
        });
        $("#smartwizard-arrows-warning").smartWizard({
            theme: "arrows",
            showStepURLhash: false
        });
        // Validation
        var $validationForm = $("#smartwizard-validation");
        $validationForm.validate({
            errorPlacement: function errorPlacement(error, element) {
                $(element).parents(".form-group").append(
                    error.addClass("invalid-feedback small d-block")
                )
            },
            highlight: function(element) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function(element) {
                $(element).removeClass("is-invalid");
            },
            rules: {
                "wizard-confirm": {
                    equalTo: "input[name=\"wizard-password\"]"
                }
            }
        });
        $validationForm
            .smartWizard({
                autoAdjustHeight: false,
                backButtonSupport: false,
                useURLhash: false, 
                showStepURLhash: false,
                toolbarSettings: {
                    toolbarExtraButtons: [$("<button class=\"btn btn-submit btn-primary\" type=\"button\">Finish</button>")]
                }
            })
            .on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                if (stepDirection === "forward") {
                    return $validationForm.valid();
                }
                return true;
            });
        $validationForm.find(".btn-submit").on("click", function() {
            if (!$validationForm.valid()) {
                return;
            }
            alert("Great! The form is valid and ready to submit.");
            return false;
        });
    });
