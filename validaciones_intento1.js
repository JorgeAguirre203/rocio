document.addEventListener("DOMContentLoaded", function () {
  const formulario = document.getElementById("registroForm");
  const nombreInput = document.getElementById("nombre");
  const nicknameInput = document.getElementById("nickname");
  const telefonoInput = document.getElementById("telefono");
  const emailInput = document.getElementById("email");
  const emailConfirmInput = document.getElementById("email_confirm");
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirm-password");
  const fotoPerfilInput = document.getElementById("foto_perfil");
  const ineFrenteInput = document.getElementById("ine_frente");
  const ineReversoInput = document.getElementById("ine_reverso");
  const especialidadInput = document.getElementById("especialidad");

  // Función para mostrar el mensaje de error
  function showError(input, message) {
    const errorSpan = input.nextElementSibling;
    if (!errorSpan || !errorSpan.classList.contains("error-message")) {
      const newErrorSpan = document.createElement("span");
      newErrorSpan.classList.add("error-message");
      newErrorSpan.style.color = "red";
      newErrorSpan.style.display = "block";
      newErrorSpan.style.marginTop = "5px";
      newErrorSpan.textContent = message;
      input.insertAdjacentElement("afterend", newErrorSpan);
    } else {
      errorSpan.textContent = message;
    }
  }

  // Función para eliminar el mensaje de error
  function removeError(input) {
    const errorSpan = input.nextElementSibling;
    if (errorSpan && errorSpan.classList.contains("error-message")) {
      errorSpan.remove();
    }
  }

  // Validación del nombre
  nombreInput.addEventListener("blur", function () {
    if (nombreInput.value.trim() === "") {
      showError(nombreInput, "El nombre no puede estar vacío.");
    } else if (nombreInput.value.length < 2) {
      showError(nombreInput, "El nombre debe tener al menos 2 caracteres.");
    } else {
      removeError(nombreInput);
    }
  });

  // Validación del nickname (máximo 15 caracteres)
  nicknameInput.addEventListener("blur", function () {
    if (nicknameInput.value.length > 15) {
      showError(nicknameInput, "El nickname debe tener un máximo de 15 caracteres.");
    } else if (nicknameInput.value.length < 3) {
      showError(nicknameInput, "El nickname debe tener al menos 3 caracteres.");
    } else {
      removeError(nicknameInput);
    }
  });

  // Validación del teléfono (solo números, máximo 10 dígitos)
  telefonoInput.addEventListener("blur", function () {
    const regexTelefono = /^\d{10}$/;
    if (!regexTelefono.test(telefonoInput.value)) {
      showError(telefonoInput, "El teléfono debe tener exactamente 10 dígitos y solo números.");
    } else {
      removeError(telefonoInput);
    }
  });

  // Validación del correo electrónico
  emailInput.addEventListener("blur", function () {
    const regexEmail = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
    if (!regexEmail.test(emailInput.value)) {
      showError(emailInput, "El correo electrónico debe contener un '@' y tener un formato válido.");
    } else {
      removeError(emailInput);
    }
  });

  // Validación de confirmación de correo
  emailConfirmInput.addEventListener("blur", function () {
    if (emailConfirmInput.value !== emailInput.value) {
      showError(emailConfirmInput, "Los correos electrónicos no coinciden.");
    } else {
      removeError(emailConfirmInput);
    }
  });

  // Validación de la contraseña
  passwordInput.addEventListener("blur", function () {
    const regexPassword = /^(?=.*[A-Z])(?=.*\W)(?=.*\d).{8,}$/;
    if (!regexPassword.test(passwordInput.value)) {
      showError(passwordInput, "La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.");
    } else {
      removeError(passwordInput);
    }
  });

  // Validación de la confirmación de la contraseña
  confirmPasswordInput.addEventListener("blur", function () {
    if (confirmPasswordInput.value !== passwordInput.value) {
      showError(confirmPasswordInput, "Las contraseñas no coinciden.");
    } else {
      removeError(confirmPasswordInput);
    }
  });

  // Validación de la especialidad
  especialidadInput.addEventListener("change", function () {
    if (especialidadInput.value === "") {
      showError(especialidadInput, "Debe seleccionar una especialidad.");
    } else {
      removeError(especialidadInput);
    }
  });

  // Validación de archivos
  function validarArchivo(input, tiposPermitidos, maxSizeMB) {
    if (input.files.length === 0) {
      showError(input, "Este archivo es requerido.");
      return false;
    }
    
    const file = input.files[0];
    const extension = file.name.split('.').pop().toLowerCase();
    const sizeMB = file.size / (1024 * 1024);
    
    if (!tiposPermitidos.includes(extension)) {
      showError(input, `Solo se permiten archivos: ${tiposPermitidos.join(', ')}`);
      return false;
    }
    
    if (sizeMB > maxSizeMB) {
      showError(input, `El archivo no debe exceder ${maxSizeMB} MB.`);
      return false;
    }
    
    removeError(input);
    return true;
  }

  fotoPerfilInput.addEventListener("change", function() {
    validarArchivo(this, ['jpg', 'jpeg', 'png'], 2);
  });

  ineFrenteInput.addEventListener("change", function() {
    validarArchivo(this, ['jpg', 'jpeg', 'png', 'pdf'], 3);
  });

  ineReversoInput.addEventListener("change", function() {
    validarArchivo(this, ['jpg', 'jpeg', 'png', 'pdf'], 3);
  });

  // Función para verificar si el correo ya está registrado
  function verificarCorreoExistente(correo) {
    return new Promise((resolve, reject) => {
      fetch('verificar_email.php?email=' + encodeURIComponent(correo))
        .then(response => response.json())
        .then(data => resolve(data.existe))
        .catch(error => reject(error));
    });
  }

  // Validación final del formulario antes de enviarlo
  formulario.addEventListener("submit", async function (e) {
    let valid = true;

    // Validaciones de los campos
    if (nombreInput.value.trim() === "") {
      showError(nombreInput, "El nombre no puede estar vacío.");
      valid = false;
    }
    
    if (nicknameInput.value.length > 15 || nicknameInput.value.length < 3) {
      showError(nicknameInput, "El nickname debe tener entre 3 y 15 caracteres.");
      valid = false;
    }
    
    if (!/^\d{10}$/.test(telefonoInput.value)) {
      showError(telefonoInput, "El teléfono debe tener exactamente 10 dígitos.");
      valid = false;
    }
    
    if (!/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(emailInput.value)) {
      showError(emailInput, "El correo electrónico no es válido.");
      valid = false;
    }
    
    if (emailConfirmInput.value !== emailInput.value) {
      showError(emailConfirmInput, "Los correos no coinciden.");
      valid = false;
    }
    
    if (!/^(?=.*[A-Z])(?=.*\W)(?=.*\d).{8,}$/.test(passwordInput.value)) {
      showError(passwordInput, "La contraseña no cumple los requisitos.");
      valid = false;
    }
    
    if (confirmPasswordInput.value !== passwordInput.value) {
      showError(confirmPasswordInput, "Las contraseñas no coinciden.");
      valid = false;
    }
    
    if (especialidadInput.value === "") {
      showError(especialidadInput, "Seleccione una especialidad.");
      valid = false;
    }
    
    // Validar archivos
    if (!validarArchivo(fotoPerfilInput, ['jpg', 'jpeg', 'png'], 2)) {
      valid = false;
    }
    
    if (!validarArchivo(ineFrenteInput, ['jpg', 'jpeg', 'png', 'pdf'], 3)) {
      valid = false;
    }
    
    if (!validarArchivo(ineReversoInput, ['jpg', 'jpeg', 'png', 'pdf'], 3)) {
      valid = false;
    }

    // Verificación del correo electrónico antes de registrar
    if (valid) {
      try {
        const correoExistente = await verificarCorreoExistente(emailInput.value);
        if (correoExistente) {
          showError(emailInput, "Este correo ya está registrado.");
          valid = false;
        }
      } catch (error) {
        showError(emailInput, "Error al verificar el correo. Intente nuevamente.");
        valid = false;
      }
    }

    // Si todo es válido, el formulario se envía, sino se previene el envío
    if (!valid) {
      e.preventDefault();
    }
  });
});
