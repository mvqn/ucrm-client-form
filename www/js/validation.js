


$(function()
{
    $("#signUpForm").validate(
    {
        // Custom validation handler...
        invalidHandler: function(form, validator)
        {
            // If there are no invalid values, simply return!
            if (!validator.numberOfInvalids())
                return;

            // Move back up to (and a little past) the first validation error field.
            $('html, body').animate(
            {
                scrollTop: $(validator.errorList[0].element).offset().top - 100
            }, 500);

            // Set focus on the field.
            $(validator.errorList[0].element).focus();
        },

        // Specify validation rules...
        rules:
        {
            companyName:
            {
                required: function()
                {
                    // Only required when the clientType is "Commercial"!
                    let selected = $("input[name='clientType']:checked").val();
                    return selected === "2";
                }
            },
            firstName: "required",
            lastName: "required",
            email:
            {
                required: true,
                // Specify that email should be validated by the built-in "email" rule.
                email: true
            },
            street1: "required",
            city: "required",
            state: "required",
            zipCode: "required",
            country: "required",
            latitude: "required",
            longitude: "required",
            agreement: "required"
        },
        // Specify validation error messages
        messages:
        {
            companyName: "When Client Type = Commercial, Company Name is required.",
            firstName: "First Name is required.",
            lastName: "Last Name is required.",
            email: "A valid Email address is required.",
            street1: "Street Address is required.",
            city: "City is required.",
            state: "State is required.",
            zipCode: "Zip Code is required.",
            country: "Country is required.",

            latitude: "A valid latitude must be calculated.",
            longitude: "A valid longitude must be calculated.",
            agreement: "You must except the terms of service prior to submission."
        }
    });
});