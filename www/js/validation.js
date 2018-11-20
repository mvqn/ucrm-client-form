


function translate(text)
{
    if(text in translations)
        return translations[text];

    return text;
}






/**
 * Runs when the document.ready event is triggered.
 */
$(function() {


    // Configure the form validation options...
    $("#signUpForm").validate({
        // Disable checking after every key press!
        onkeyup: false,

        // Custom validation handler...
        invalidHandler: function(form, validator) {
            // If there are no invalid values, simply return!
            if (!validator.numberOfInvalids())
                return;

            // Move back up to (and a little past) the first validation error field.
            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top - 100
            }, 500);

            // Set focus on the field.
            $(validator.errorList[0].element).focus();
        },

        // Specify validation rules...
        rules: {
            companyName: {
                required: function() {
                    // Only required when the clientType is "Commercial"!
                    let selected = $("input[name='clientType']:checked").val();
                    return selected === "2";
                }
            },
            firstName: "required",
            lastName: "required",
            email: {
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
        messages: {
            companyName: translate("When Client Type is Commercial, Company Name is required."),
            firstName: translate("First Name is required."),
            lastName: translate("Last Name is required."),
            email: translate("A valid Email address is required."),
            street1: translate("Street Address is required."),
            city: translate("City is required."),
            state: translate("State is required."),
            zipCode: translate("Zip Code is required."),
            country: translate("Country is required."),

            latitude: translate("A valid latitude must be calculated."),
            longitude: translate("A valid longitude must be calculated."),
            agreement: translate("You must except the terms of service prior to submission.")
        }
    });
});