
console.log("JavaScript file loaded successfully");

// Login Form Validation
function validateLoginForm(event) {
    var username = document.getElementById('user-email').value.trim();
    var password = document.getElementById('password').value.trim();
    var errorMessage = document.getElementById('error-message');
    
    var errors = [];

    // Check if username/email is empty
    if (username === '') {
        errors.push('Username or email is required.');
    }

    // Check if password is empty
    if (password === '') {
        errors.push('Password is required.');
    }

    if (errors.length > 0) {
        errorMessage.textContent = errors.join(' ');
        event.preventDefault(); 
    } else {
        errorMessage.textContent = ''; 
    }
}

// Signup Form Validation
function validateSignupForm(event) {
    var username = document.getElementById('username').value.trim();
    var email = document.getElementById('email').value.trim();
    var password = document.getElementById('password').value.trim();
    var errorMessage = document.getElementById('error-message');
    
    var errors = [];

    // Check if username is empty
    if (username === '') {
        errors.push('Username is required.');
    } else if (username.length < 3) {
        errors.push('Username must be at least 3 characters long.');
    }

    // Check if email is empty and valid
    if (email === '') {
        errors.push('Email is required.');
    } else if (!validateEmail(email)) {
        errors.push('Email format is invalid.');
    }

    // Check if password is empty and meets criteria
    if (password === '') {
        errors.push('Password is required.');
    } else if (password.length < 8) {
        errors.push('Password must be at least 8 characters long.');
    } else if (!/[A-Z]/.test(password)) {
        errors.push('Password must contain at least one uppercase letter.');
    } else if (!/[a-z]/.test(password)) {
        errors.push('Password must contain at least one lowercase letter.');
    } else if (!/[0-9]/.test(password)) {
        errors.push('Password must contain at least one number.');
    } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        errors.push('Password must contain at least one special character.');
    }

    if (errors.length > 0) {
        errorMessage.innerHTML = errors.join('<br>'); 
        event.preventDefault(); 
    } else {
        errorMessage.innerHTML = ''; 
    }
}

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
   
}




// Attach event listeners d f l
document.addEventListener('DOMContentLoaded', function() {
    var loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', validateLoginForm);
    }

    var signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', validateSignupForm);
    }
});



