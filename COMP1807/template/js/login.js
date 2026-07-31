// template/login.js
document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("loginForm");
    
    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            
            // Client-side validation to prevent submitting empty spaces
            if (email.trim() === "" || password.trim() === "") {
                alert("Please enter both your email and password.");
                event.preventDefault(); // Stop form submission
            }
        });
    }
});