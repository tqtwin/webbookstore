
function validateForm() {
    var username = document.getElementById('txt_username').value.trim();
    var password = document.getElementById('txt_password').value.trim();

    // Validate username
    if (username === '') {
        document.getElementById('error_username').innerHTML = 'Username cannot be empty';
        return false;
    } else {
        document.getElementById('error_username').innerHTML = '';
        // No need to set entered_username in this case
    }

    // Validate password
    if (password === '') {
        document.getElementById('error_password').innerHTML = 'Password cannot be empty';
        return false;
    } else {
        document.getElementById('error_password').innerHTML = '';
    }

    return true;
}

function validateUsername() {
    var username = document.getElementById('txt_username').value.trim();
    var errorElement = document.getElementById('error_username');

    if (username === '') {
        errorElement.innerHTML = 'Username cannot be empty';
    } else {
        errorElement.innerHTML = '';
    }
}

function validatePassword() {
    var password = document.getElementById('txt_password').value.trim();
    var errorElement = document.getElementById('error_password');

    if (password === '') {
        errorElement.innerHTML = 'Password cannot be empty';
    } else {
        errorElement.innerHTML = '';
    }
}
// Add event listener for Enter key press
document.querySelector(".login-form").addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
        validateForm(); // Call your form validation function
    }
});

function updateHiddenUsername() {
    var username = document.getElementById('txt_username').value.trim();
    document.getElementById('hidden_username').value = username;
}
document.getElementById('forgotPasswordLink').addEventListener('click', function (event) {
event.preventDefault(); // Prevent the default action of the link

var enteredUsername = document.getElementById('txt_username').value;
if (enteredUsername !== '') {
    window.location.href = "?Page=forgot-password&username=" + enteredUsername;
} else {
    alert('Vui lòng nhập tên đăng nhập trước khi quên mật khẩu.');
}
});
function onSignIn(googleUser) {
    // Retrieve user information
    var profile = googleUser.getBasicProfile();
    var userId = profile.getId();
    var userName = profile.getName();
    var userEmail = profile.getEmail();

    // Send user information to the server
    sendUserDataToServer(userId, userName, userEmail);
}

