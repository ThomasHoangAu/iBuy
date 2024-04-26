document
    .getElementById('sign-form')
    .addEventListener('submit', function (event) {
        // Clear previous error messages
        document.getElementById('passwordError').textContent = '';
        document.getElementById('confirmPasswordError').textContent = '';
        document.getElementById('emailError').textContent = '';

        // Fetch input values
        let passwordInput = document.getElementById('password');
        let passwordInputValue = passwordInput.value.trim();
        let confirmPasswordInput = document.getElementById('confirm-password');
        let confirmPasswordInputValue = confirmPasswordInput.value.trim();
        let emailInput = document.getElementById('email');
        let emailInputValue = emailInput.value.trim();
        let firstnameInput = document.getElementById('first-name');
        let firstnameInputValue = firstnameInput.value.trim();
        let lastnameInput = document.getElementById('last-name');
        let lastnameInputValue = lastnameInput.value.trim();

        // Validate email
        if (emailInputValue === '') {
            document.getElementById('emailError').textContent =
                'Please enter your email address.';
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

        // Validate confirm password
        if (confirmPasswordInputValue === '') {
            document.getElementById('confirmPasswordError').textContent =
                'Please enter your confirm password.';
            event.preventDefault(); // Prevent form submission
            confirmPasswordInput.focus();
            return false;
        }

        if (confirmPasswordInputValue != passwordInputValue) {
            document.getElementById('confirmPasswordError').textContent =
                'Confirm password is not correct.';
            event.preventDefault(); // Prevent form submission
            confirmPasswordInput.focus();
            return false;
        }

        // Validate first name
        if (firstnameInputValue === '') {
            document.getElementById('firstNameError').textContent =
                'Please enter your first name.';
            event.preventDefault(); // Prevent form submission
            firstnameInput.focus();
            return false;
        }

        // Validate last name
        if (lastnameInputValue === '') {
            document.getElementById('lastNameError').textContent =
                'Please enter your last name.';
            event.preventDefault(); // Prevent form submission
            lastnameInput.focus();
            return false;
        }
    });

// Function to validate email format
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
