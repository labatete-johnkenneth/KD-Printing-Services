// Block display settings for the loader
var formatBlock = function () {
    return {
        message: '<Please wait...',
        css: {
            border: '1px solid #4c0519',
            borderRadius: "5px"
        }
    };
};

// Function to hide loader after a short delay
var loadFirst = function(){
    setTimeout(function(){
        $('#loader').addClass('hidden');
    }, 400);
};

// Check if there's an active session
var checkSession = function() {
    $.get('checkSession.php', function(data) {
        var sessiondata = $.parseJSON(data);
        if(sessiondata.isSuccess) {
            console.log("active session");

            // Redirect user based on their role (Admin/User)
            if(sessiondata.role === 'admin') {
                $(location).attr('href', 'dashboard.html');
            } else {
                $(location).attr('href', 'user.html');
            }
        } else {
            console.log("inactive session");
            loadFirst();
        }
    });
};


// Handle form events for the login form
var handleFormEvents = function () {
    $.validate({
        form: '#frmLogin',
        modules: 'security'
    });
};

// Handle the login process
var onLogin = function () {
    $("#frmLogin").submit(function(e) {
        e.preventDefault();
        $('#login').block(formatBlock());  // Show loading block
        
        var loginObj = $('#frmLogin').serializeArray();  // Serialize form data
        
        // Send login data to the server (login.php)
        $.post('login.php', loginObj, function(data) {
            if (!data.isSuccess) {
                // If login failed, show the error message
                var msg = data.msg;
                var alert = "<div class='alert alert-danger fade in'>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" +
                "Message!<br/>" + msg +
                "</div>";

                $("#admin-msg").html(alert);  // Show error message
            } else {
                // If login is successful, check session and redirect accordingly
                checkSession();  // This will trigger the redirection based on user role
            }
            $('#login').unblock();  // Unblock the loading block after login attempt
        }, 'json');
    });
};

// Initialize login page
var Login = function() {
    return {
        init: function() {
            checkSession();  // Check session on page load
            handleFormEvents();  // Handle form events
            onLogin();  // Attach login functionality
        }
    }
};

// Function to handle logout action
var onLogout = function () {
    $("#btnLogout").click(function(e) {
        e.preventDefault();
        
        // Send request to logout.php to destroy the session
        $.get('logout.php', function(data) {
            // Redirect to login page after logging out
            $(location).attr('href', 'login.html');  // Redirect to login form
        });
    });
};

// Initialize login on login page (login.html)
if(window.location.pathname.includes('login.html')) {
    Login().init();
}

// Initialize logout on dashboard page (admin_dashboard.html or user_dashboard.html)
if(window.location.pathname.includes('login.html')) {
    onLogout();  // Attach logout functionality
}
