$(function() {
    $("#photo").rules("add", {
        accept: "jpg|jpeg|png|ico|bmp"
    });
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='shipment_form']").validate({
        // Specify validation rules
        rules: {
            package_name: "required",
            shipment_package_type_id: "required",
            customerId: "required",
            service_agent: "required",
            receiver_name: "required",
            receiver_country: "required",
            receiver_state: "required",
            receiver_city: "required",
            receiver_area: "required",
            receiver_house_no: "required",
            // receiver_post_box_no: "required",
            // payment_type: "required",
            // payment_method: "required",
            'quantity[]': {
                required: true,
                step:1,
            },
            'weight[]': {
                required: true,
                step:0.01,
            },
            'length[]': {
                required: true,
                step:0.01,
            },
            'height[]': {
                required: true,
                step:0.01,
            },
            // sender_mobile: {
            //     required: true,
            //     digits:true,
            // },
            // receiver_contact_no: {
            //     required: true,
            //     digits:true,
            // },
            // sender_email: {
            //     required: true,
            //     email:true,
            // },
            // receiver_email: {
            //     required: true,
            //     email:true,
            // },
            // sender_zipcode: {
            //     required: true,
            //     digits:true,
            // },
            // receiver: {
            //     required: true,
            //     digits:true,
            // },
            'images[]': {
                // required: true,
                extension: "jpg|jpeg|png"
            },
        },
        // Specify validation error messages
        messages: {
            package_name: "This value is required",
            shipment_package_type_id: "This value is required",
            customerId: "Please Select Customer",
            service_agent: "This value is required",
            receiver_name: "This value is required",
            receiver_country: "This value is required",
            receiver_state: "This value is required",
            receiver_city: "This value is required",
            receiver_area: "This value is required",
            receiver_house_no: "This value is required",
            // receiver_post_box_no: "This value is required",
            // payment_type: "This value is required",
            // payment_method: "This value is required",
            'quantity[]': {
                required: "Value is required",
                step:"Inappropriate Value",
            },
            'weight[]': {
                required: "Value is required",
                step:"Inappropriate Value",
            },
            'length[]': {
                required: "Value is required",
                step:"Inappropriate Value",
            },
            'height[]': {
                required: "Value is required",
                step:"Inappropriate Value",
            },
            // sender_mobile: {
            //     required: "This value is required",
            //     digits:"This value should be numeric",
            // },
            // receiver_mobile: {
            //     required: "This value is required",
            //     digits:"This value should be numeric",
            // },
            // sender_email: {
            //     required: "This value is required",
            //     email:"This value doesnot match with an email",
            // },
            // receiver_email: {
            //     required: "This value is required",
            //     email:"This value doesnot match with an email",
            // },
            'images[]': {
                // required: "Please upload file.",
                extension: "Please upload file in these format only (jpg, jpeg, png)."
            }

        },

        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
            $(':button').prop('disabled', true);
        }
    });
});
