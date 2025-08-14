document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.querySelector('.wrapper');
    const loginLink = document.querySelector('.login-link');
    const registerLink = document.querySelector('.register-link');
    const btnPopups = document.querySelectorAll('.btnLogin-popup'); // Select all login buttons
    const iconClose = document.querySelector('.iconclose');

    // Register link functionality
    registerLink.addEventListener('click', () => {
        wrapper.classList.add('active');
        console.log('Register link clicked: active class added');
    });

    // Login link functionality
    loginLink.addEventListener('click', () => {
        wrapper.classList.remove('active');
        console.log('Login link clicked: active class removed');
    });

    // Add event listeners to all login buttons
    btnPopups.forEach((btn) => {
        btn.addEventListener('click', () => {
            wrapper.classList.add('active-popup'); // Show the login popup
            console.log('Login button clicked: active-popup class added');
        });
    });

    // Close icon functionality
    iconClose.addEventListener('click', () => {
        wrapper.classList.remove('active-popup');
        console.log('Close icon clicked: active-popup class removed');
    });
});



//////////////////////////////3dlogo
document.addEventListener('DOMContentLoaded', function() {
    // Get the model-viewer element
    var modelViewer = document.getElementById('myModelViewer');
    
    // Set autoplay attribute to trigger rotation
    modelViewer.setAttribute('autoplay', '');
});

// Function to enable/disable the sign-up button based on checkbox state
function toggleSignupButton() {
    var checkbox = document.getElementById("terms-checkbox");
    var signupButton = document.getElementById("signup-btn");
    signupButton.disabled = !checkbox.checked; // Disable if not checked
    signupButton.style.opacity = checkbox.checked ? 1 : 0.5; // Change opacity for visual cue
}

// Function to show the password hint when typing
var hideHintTimeout; // Declare it in the global scope

function showPasswordHint() {
    var passwordInput = document.getElementsByName("regpass")[0];
    var inputBox = passwordInput.closest(".input-box");

    // Add class to show the hint
    inputBox.classList.add("show-hint");

    // Clear existing timeout and set a new one for hiding after 3 seconds of inactivity
    clearTimeout(hideHintTimeout);
    hideHintTimeout = setTimeout(hidePasswordHint, 2000); // 3-second delay
}

// Function to hide the password hint
function hidePasswordHint() {
    var passwordInput = document.getElementsByName("regpass")[0];
    var inputBox = passwordInput.closest(".input-box");

    // Remove class to hide the hint
    inputBox.classList.remove("show-hint");
}

// Add event listeners to manage hint visibility
window.onload = function() {
    var passwordInput = document.getElementsByName("regpass")[0];

    // Show hint when the password field is focused
    passwordInput.addEventListener("focus", function() {
        showPasswordHint();
    });

    // Hide the hint when the password field loses focus
    passwordInput.addEventListener("blur", function() {
        hidePasswordHint();
    });
};
