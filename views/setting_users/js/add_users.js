$().ready(function() {
    $("#signupFormUsers").validate({
        rules: {
            //mb_FirstName: "required",
            //mb_MiddleName: "required",
            //mb_LastName: "required",
            /*mb_FirstName: {
                required: true,
                minlength: 5
            },*/
            mb_Password: {
                required: true,
                minlength: 6
            },
            mb_PasswordConfirmation: {
                required: true,
                minlength: 6,
                equalTo: "#mb_Password"
            },
            /*email: {
                required: true,
                email: true
            },
            topic: {
                required: "#newsletter:checked",
                minlength: 2
            },
            agree: "required"*/
        },
        messages: {
            
            /*mb_FirstName: {
                required: "Please enter a first name"
            },
            mb_MiddleName: {
                required: "Please enter a middle name"
            },
            mb_LastName: {
                required: "Please enter a last name"
            },*/
            mb_Password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            mb_PasswordConfirmation: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long",
                equalTo: "Please enter the same password as above"
            }
        }
    });
});