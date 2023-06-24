$(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='pricing_form']").validate({
        // Specify validation rules
        rules: {
            agent_id: "required",
            serviceAgentId: "required",
            package_type_id: "required",
            zoneOrCountry: "required",
            "region[]": "required",
            "weight[]": {
                required: true,
                number: true
            },

            "price[]": {
                required: true,
                number: true
            }
        },
        // Specify validation error messages
        messages: {
            agent_id: "Please select local agent",
            serviceAgentId: "Please select service agent",
            package_type_id: "Please select package type",
            zoneOrCountry: "Select the location schema",
            "region[]": "Please select location",
            "weight[]": {
                required: "Please enter weight",
                number: "Weight should be a number"
            },
            "price[]": {
                required: "Please enter price",
                number: "Price should be a number"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
