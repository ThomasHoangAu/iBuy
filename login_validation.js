document
    .getElementById('sign-form')
    .addEventListener('submit', function (event) {
        // Clear previous error messages
        document.getElementById('passwordError').textContent = '';
        document.getElementById('emailError').textContent = '';

        // Fetch input values
        let passwordInput = document.getElementById('password');
        let passwordInputValue = passwordInput.value.trim();
        let emailInput = document.getElementById('email');
        let emailInputValue = emailInput.value.trim();

        // Validate email
        if (emailInputValue === '') {
            document.getElementById('emailError').textContent =
                'Please enter your email.';
            event.preventDefault(); // Prevent form submission
            emailInput.focus();
            return false;
        } else if (!isValidEmail(emailInputValue)) {
            document.getElementById('emailError').textContent =
                'Invalid email format.';
            event.preventDefault(); // Prevent form submission
            emailInput.focus();
            return false;
        }

        // Validate password
        if (passwordInputValue === '') {
            document.getElementById('passwordError').textContent =
                'Please enter your password.';
            event.preventDefault(); // Prevent form submission
            passwordInput.focus();
            return false;
        }
    });

// Function to validate email format
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
