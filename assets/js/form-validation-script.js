var Script = function () {

    // $.validator.setDefaults({
    //     submitHandler: function() { alert("submitted!"); }
    // });

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#feedback_form").validate();

        // validate signup form on keyup and submit
        $("#client_register").validate({
            rules: {
                name:
                {
                    required :true,
                    maxlength: 200,
                    alphaspace: true,
                },
                username:
                {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                password:
                {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                confirm_password:
                {
                    required: true,
                    minlength: 6,
                    maxlength: 20,
                    equalTo: "#password"
                },
                email:
                {
                    required: true,
                    email: true,
                    maxlength: 50
                },    
                education:
                {
                    required:true, 
                },
                price:
                {
                    integer: true,
                    required: true,
                },
                description:
                {
                    alphaspace:true
                }            
            },
            messages: {
                password: {
                    required: "Please provide a password.",
                    minlength: "Your password must be at least 6 characters long."
                },
                confirm_password: {
                    required: "Please provide a password.",
                    minlength: "Your password must be at least 6 characters long.",
                    equalTo: "Please enter the same password as the first one."
                },
                email: "Please enter a valid email address.",
                agree: "Please accept our terms & condition."
            }
        });


        // validate the login form
        $("#login_form").validate({
            rules: {
                username:
                {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                password:
                {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },       
            },
            messages: {
                password: {
                    required: "Please provide a password.",
                    minlength: "Your password must be at least 6 characters long."
                },
            }
        });


        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();
