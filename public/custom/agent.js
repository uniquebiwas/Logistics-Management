$(function() {
    $("form[name='agent_form']").validate({
        rules: {
            name: "required",
            mobile: {
                required: true,
                digits: true,
                minlength: 5,
                maxlength: 20,
            },
            email: {
                required: true,
                email: true,
            },
            roles: "required",
            status: "required",

        },
        // Specify validation error messages
        messages: {
            name: "Please enter name",
            mobile: {
                required: "Phone number is required",
                digits: "Phone number should be digits only",
                minlength: "Phone number should be of 5 digits",
                maxlength: "Phone number should be of 15 digits only",
            },
            email: {
                required: "Please enter email address",
                email: "Value entered should be email",
            },
            roles: "Please add role",
            status: "Please add status",

        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
