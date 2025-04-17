document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const errorMessage = document.getElementById('error-message');
    
    // Login form submission
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Validate inputs
            if (!username || !password) {
                displayError('Please enter both username and password');
                return;
            }
            
            // Send login request
            fetch('api/auth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: 'login',
                    username: username,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    displayError(data.error);
                } else {
                    // Redirect to chat page on successful login
                    window.location.href = 'chat.php';
                }
            })
            .catch(error => {
                displayError('An error occurred. Please try again.');
                console.error('Error:', error);
            });
        });
    }
    
    // Register form submission
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            // Validate inputs
            if (!username || !email || !password || !confirmPassword) {
                displayError('Please fill out all fields');
                return;
            }
            
            if (password !== confirmPassword) {
                displayError('Passwords do not match');
                return;
            }
            
            // Send registration request
            fetch('api/auth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: 'register',
                    username: username,
                    email: email,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    displayError(data.error);
                } else {
                    // Redirect to login page on successful registration
                    window.location.href = 'login.php?registered=true';
                }
            })
            .catch(error => {
                displayError('An error occurred. Please try again.');
                console.error('Error:', error);
            });
        });
    }
    
    // Display error message
    function displayError(message) {
        errorMessage.textContent = message;
        errorMessage.style.display = 'block';
        
        // Hide error message after 5 seconds
        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, 5000);
    }
    
    // Check for successful registration message
    if (window.location.search.includes('registered=true') && window.location.pathname.includes('login.php')) {
        const successMessage = document.createElement('div');
        successMessage.className = 'success-message';
        successMessage.textContent = 'Registration successful! Please log in.';
        
        const formContainer = document.querySelector('.form-container');
        formContainer.insertBefore(successMessage, formContainer.firstChild);
        
        // Hide success message after 5 seconds
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 5000);
    }
});