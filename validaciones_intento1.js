document.addEventListener("DOMContentLoaded", function () {
  const formulario = document.getElementById("registroForm");
  const nombreInput = document.getElementById("nombre");
  const nicknameInput = document.getElementById("nickname");
  const telefonoInput = document.getElementById("telefono");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirm-password");

  // Función para mostrar el mensaje de error
  function showError(input, message) {
    const errorSpan = input.nextElementSibling;
    if (!errorSpan || !errorSpan.classList.contains("error-message")) {
      const newErrorSpan = document.createElement("span");
      newErrorSpan.classList.add("error-message");
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

  // Validación del nombre de usuario
  nombreInput.addEventListener("blur", function () {
    if (nombreInput.value.trim() === "") {
      showError(nombreInput, "El nombre de usuario no puede estar vacío.");
    } else {
      removeError(nombreInput);
    }
  });

  // Validación del nickname (máximo 15 caracteres)
  nicknameInput.addEventListener("blur", function () {
    if (nicknameInput.value.length > 15) {
      showError(nicknameInput, "El nickname debe tener un máximo de 15 caracteres.");
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

  // Validación del correo electrónico (debe contener un @)
  emailInput.addEventListener("blur", function () {
    const regexEmail = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
    if (!regexEmail.test(emailInput.value)) {
      showError(emailInput, "El correo electrónico debe contener un '@' y tener un formato válido.");
    } else {
      removeError(emailInput);
    }
  });

  // Validación de la contraseña (debe tener al menos una mayúscula y un carácter especial)
  passwordInput.addEventListener("blur", function () {
    const regexPassword = /^(?=.*[A-Z])(?=.*\W)/;
    if (!regexPassword.test(passwordInput.value)) {
      showError(passwordInput, "La contraseña debe contener al menos una mayúscula y un carácter especial.");
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

  // Función para verificar si el correo ya está registrado (simulación de consulta a la base de datos)
  function verificarCorreoExistente(correo) {
    // Este es un ejemplo de cómo podrías verificar la existencia de un correo en la base de datos
    // Haciendo una llamada AJAX al backend para comprobar si el correo ya existe.
    // Supón que tienes una función `verificarEmail` que devuelve una promesa con el resultado.

    return new Promise((resolve, reject) => {
      // Aquí iría la llamada AJAX o fetch que consulta la base de datos.
      // Este es solo un ejemplo de un correo ya registrado.
      const correosRegistrados = ["usuario@correo.com", "prueba@correo.com"];
      
      if (correosRegistrados.includes(correo)) {
        resolve(true);  // El correo ya está registrado
      } else {
        resolve(false);  // El correo no está registrado
      }
    });
  }

  // Validación final del formulario antes de enviarlo
  formulario.addEventListener("submit", async function (e) {
    let valid = true;

    // Validaciones de los campos
    if (nombreInput.value.trim() === "") {
      showError(nombreInput, "El nombre de usuario no puede estar vacío.");
      valid = false;
    }
    if (nicknameInput.value.length > 15) {
      showError(nicknameInput, "El nickname debe tener un máximo de 15 caracteres.");
      valid = false;
    }
    if (!/^\d{10}$/.test(telefonoInput.value)) {
      showError(telefonoInput, "El teléfono debe tener exactamente 10 dígitos y solo números.");
      valid = false;
    }
    if (!/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(emailInput.value)) {
      showError(emailInput, "El correo electrónico debe contener un '@' y tener un formato válido.");
      valid = false;
    }
    if (!/^(?=.*[A-Z])(?=.*\W)/.test(passwordInput.value)) {
      showError(passwordInput, "La contraseña debe contener al menos una mayúscula y un carácter especial.");
      valid = false;
    }
    if (confirmPasswordInput.value !== passwordInput.value) {
      showError(confirmPasswordInput, "Las contraseñas no coinciden.");
      valid = false;
    }

    // Verificación del correo electrónico antes de registrar
    if (valid) {
      const correoExistente = await verificarCorreoExistente(emailInput.value);
      if (correoExistente) {
        showError(emailInput, "Este correo ya está registrado.");
        valid = false;
      }
    }

    // Si todo es válido, el formulario se envía, sino se previene el envío
    if (!valid) {
      e.preventDefault();
    }
  });
});

