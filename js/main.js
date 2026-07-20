/**
 * MGMBPTC Website Skeleton JavaScript Helpers
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ----------------------------------------------------
    // 1. Mobile Menu Toggling
    // ----------------------------------------------------
    const navToggle = document.getElementById('navToggle');
    const navbar = document.getElementById('navbar');
    
    if (navToggle && navbar) {
        navToggle.addEventListener('click', function() {
            navbar.classList.toggle('show');
            // Toggle hamburger cross state if needed, here we just show the menu
            navToggle.classList.toggle('active');
        });
    }

    // Close menu when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (navbar && navbar.classList.contains('show') && navToggle) {
            if (!navbar.contains(event.target) && !navToggle.contains(event.target)) {
                navbar.classList.remove('show');
                navToggle.classList.remove('active');
            }
        }
    });

    // ----------------------------------------------------
    // 2. Client-side Form Validation
    // ----------------------------------------------------
    
    // Contact Form Validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            const nameField = document.getElementById('contactName');
            const emailField = document.getElementById('contactEmail');
            const messageField = document.getElementById('contactMessage');
            let hasError = false;
            
            // Basic reset
            resetErrors(contactForm);
            
            if (!nameField.value.trim()) {
                showFieldError(nameField, "Name is required.");
                hasError = true;
            }
            
            if (!emailField.value.trim() || !validateEmail(emailField.value)) {
                showFieldError(emailField, "A valid email is required.");
                hasError = true;
            }
            
            if (!messageField.value.trim()) {
                showFieldError(messageField, "Message content is required.");
                hasError = true;
            }
            
            if (hasError) {
                event.preventDefault();
            }
        });
    }

    // Admission Form Validation
    const admissionForm = document.getElementById('admissionForm');
    if (admissionForm) {
        admissionForm.addEventListener('submit', function(event) {
            const fullName = document.getElementById('studentName');
            const email = document.getElementById('studentEmail');
            const phone = document.getElementById('studentPhone');
            const department = document.getElementById('studentDept');
            let hasError = false;
            
            resetErrors(admissionForm);
            
            if (!fullName.value.trim()) {
                showFieldError(fullName, "Full name is required.");
                hasError = true;
            }
            
            if (!email.value.trim() || !validateEmail(email.value)) {
                showFieldError(email, "A valid email address is required.");
                hasError = true;
            }
            
            if (!phone.value.trim()) {
                showFieldError(phone, "Contact number is required.");
                hasError = true;
            }
            
            if (department.value === "") {
                showFieldError(department, "Please select an academic program.");
                hasError = true;
            }
            
            if (hasError) {
                event.preventDefault();
            }
        });
    }

    // Helper functions
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }

    function showFieldError(element, errorMessage) {
        element.style.borderColor = "#e53e3e"; // Red border
        const errorDiv = document.createElement('div');
        errorDiv.className = "field-error-msg";
        errorDiv.style.color = "#e53e3e";
        errorDiv.style.fontSize = "0.8rem";
        errorDiv.style.marginTop = "0.25rem";
        errorDiv.innerText = errorMessage;
        element.parentNode.appendChild(errorDiv);
    }

    function resetErrors(form) {
        const errors = form.querySelectorAll('.field-error-msg');
        errors.forEach(e => e.remove());
        
        const inputs = form.querySelectorAll('.form-control');
        inputs.forEach(i => i.style.borderColor = "");
    }
});
