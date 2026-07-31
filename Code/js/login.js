function switchForm(formType) {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const btnLoginTab = document.getElementById('btnLoginTab');
    const btnRegisterTab = document.getElementById('btnRegisterTab');

    if (formType === 'login') {
        // Show login form, hide register form
        loginForm.classList.remove('hidden-form');
        loginForm.classList.add('active-form');
        registerForm.classList.remove('active-form');
        registerForm.classList.add('hidden-form');

        // Update button states
        btnLoginTab.classList.add('active-tab');
        btnLoginTab.classList.remove('inactive-tab');
        btnRegisterTab.classList.remove('active-tab');
        btnRegisterTab.classList.add('inactive-tab');
    } else {
        // Show register form, hide login form
        registerForm.classList.remove('hidden-form');
        registerForm.classList.add('active-form');
        loginForm.classList.remove('active-form');
        loginForm.classList.add('hidden-form');

        // Update button states
        btnRegisterTab.classList.add('active-tab');
        btnRegisterTab.classList.remove('inactive-tab');
        btnLoginTab.classList.remove('active-tab');
        btnLoginTab.classList.add('inactive-tab');
    }
}

// Prevent browser reload and redirect to home page
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent page reload
    window.location.href = 'home.html'; // Redirect to home page
});

document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    window.location.href = 'home.html'; // Redirect to home page after register
});