document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("register-form");
    
    // Validación en tiempo real
    document.getElementById("name").addEventListener("input", validateName);
    document.getElementById("email").addEventListener("input", validateEmail);
    document.getElementById("phone").addEventListener("input", validatePhone);
    document.getElementById("password").addEventListener("input", validatePassword);
    document.getElementById("confirm-password").addEventListener("input", validateConfirmPassword);
    
    form.addEventListener("submit", async function(e) {
        e.preventDefault();
        
        // Resetear mensajes de error
        resetErrorMessages();
        
        // Validar campos
        const isFormValid = validateForm();
        
        if (isFormValid) {
            await submitForm();
        }
    });
    
    function resetErrorMessages() {
        document.querySelectorAll('.error').forEach(el => el.textContent = '');
    }
    
    function validateForm() {
        const validations = [
            validateName(),
            validateEmail(),
            validatePhone(),
            validatePassword(),
            validateConfirmPassword()
        ];
        
        return validations.every(validation => validation === true);
    }
    
    function validateName() {
        const name = document.getElementById("name").value.trim();
        const errorElement = document.getElementById("name-error");
        let isValid = true;
        
        if (!name) {
            errorElement.textContent = "El nombre es requerido";
            isValid = false;
        } else if (name.length > 100) {
            errorElement.textContent = "El nombre no puede exceder 100 caracteres";
            isValid = false;
        } else if (/^\d+$/.test(name)) {
            errorElement.textContent = "El nombre no puede contener solo números";
            isValid = false;
        }
        
        return isValid;
    }
    
    function validateEmail() {
        const email = document.getElementById("email").value.trim();
        const errorElement = document.getElementById("email-error");
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let isValid = true;
        
        if (!email) {
            errorElement.textContent = "El correo electrónico es requerido";
            isValid = false;
        } else if (!emailRegex.test(email)) {
            errorElement.textContent = "Por favor ingresa un correo electrónico válido";
            isValid = false;
        }
        
        return isValid;
    }
    
    function validatePhone() {
        const phone = document.getElementById("phone").value.trim();
        const errorElement = document.getElementById("phone-error");
        let isValid = true;
        
        if (!phone) {
            errorElement.textContent = "El teléfono es requerido";
            isValid = false;
        } else if (!/^\+?\d{10,15}$/.test(phone)) {
            errorElement.textContent = "Por favor ingresa un número válido (ej. +521234567890)";
            isValid = false;
        }
        
        return isValid;
    }
    
    function validatePassword() {
        const password = document.getElementById("password").value;
        const errorElement = document.getElementById("password-error");
        let isValid = true;
        
        if (!password) {
            errorElement.textContent = "La contraseña es requerida";
            isValid = false;
        } else if (password.length < 8) {
            errorElement.textContent = "Debe tener al menos 8 caracteres";
            isValid = false;
        } else if (!/[A-Z]/.test(password)) {
            errorElement.textContent = "Debe contener al menos una mayúscula";
            isValid = false;
        } else if (!/[a-z]/.test(password)) {
            errorElement.textContent = "Debe contener al menos una minúscula";
            isValid = false;
        } else if (!/\d/.test(password)) {
            errorElement.textContent = "Debe contener al menos un número";
            isValid = false;
        } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            errorElement.textContent = "Debe contener al menos un carácter especial";
            isValid = false;
        }
        
        return isValid;
    }
    
    function validateConfirmPassword() {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm-password").value;
        const errorElement = document.getElementById("confirm-error");
        let isValid = true;
        
        if (!confirmPassword) {
            errorElement.textContent = "Por favor confirma tu contraseña";
            isValid = false;
        } else if (password !== confirmPassword) {
            errorElement.textContent = "Las contraseñas no coinciden";
            isValid = false;
        }
        
        return isValid;
    }
    
    async function submitForm() {
        const formData = {
            nombre: document.getElementById("name").value.trim(),
            email: document.getElementById("email").value.trim(),
            telefono: document.getElementById("phone").value.trim(),
            password: document.getElementById("password").value
        };
        
        try {
            const response = await fetch('registrar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(formData)
            });
            
            const result = await response.json();
            
            if (result.success) {
                showSuccessMessage(result.message);
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 1500);
            } else {
                showFormError(result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            showFormError('Ocurrió un error al registrar. Por favor intenta nuevamente.');
        }
    }
    
    function showSuccessMessage(message) {
        // Puedes reemplazar esto con un modal o mensaje más elegante
        alert(message);
        
        // O mostrar un mensaje en el DOM:
        // const successElement = document.createElement('div');
        // successElement.className = 'success-message';
        // successElement.textContent = message;
        // form.prepend(successElement);
    }
    
    function showFormError(message) {
        // Mostrar error general o específico según corresponda
        const errorElement = document.getElementById("email-error");
        errorElement.textContent = message;
    }
});