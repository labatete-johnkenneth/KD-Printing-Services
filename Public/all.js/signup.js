var formatBlock = function () {
    return {
        message: 'Please wait...',
        css: {
            border: '1px solid #4c0519',
            borderRadius: "5px"
        }
    };
};

var loadFirst = function() {
    setTimeout(function() {
        $('#loader').addClass('hidden');
    }, 400);
};

// Function to handle the form submission
var onSignup = function () {
    $("#frmSignup").submit(function(e) {
        e.preventDefault(); // Prevent the default form submission
        console.log("Form submission triggered"); // Log the form submission

        // Block UI with a loading message
        $('#frmSignup').block(formatBlock());

        // Serialize form data
        var signupObj = $('#frmSignup').serializeArray();
        console.log("Serialized data: ", signupObj); // Log serialized data

        $.post('signup.php', signupObj, function(data) {
            console.log("Response from server: ", data); // Log server response
            var msg = data.msg;
            var alert = "<div class='alert alert-success fade in'>" +
                        "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" +
                        "Message!<br/>" + msg + 
                        "</div>";

            if (data.isSuccess) {
                $("#signup-msg").html(alert);
                setTimeout(function() {
                    window.location.href = "login.html"; // Redirect after successful signup
                }, 2000); // 2 seconds delay for message to show
            } else {
                $("#signup-msg").html(alert);
            }

            // Unblock the form after the response
            $('#frmSignup').unblock();
        }, 'json').fail(function(xhr, status, error) {
            console.error("AJAX error: " + error); // Log AJAX error
            $('#frmSignup').unblock();
            alert("An error occurred. Please try again.");
        });
    });
};

// Initialize the signup function
var Signup = function() {
    return {
        init: function() {
            onSignup();
        }
    };
};

$(document).ready(function() {
    Signup().init();
});
