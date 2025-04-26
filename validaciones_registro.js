document.addEventListener("DOMContentLoaded", function () {
  const telefonoInput = document.getElementById("telefono");
  const emailInput = document.getElementById("email");
  const nicknameInput = document.getElementById("nickname");
  const submitButton = document.querySelector("button[type='submit']");

  // Crear un span para mostrar el mensaje de error
  let mensajeTelefono = document.createElement("span");
  let mensajeEmail = document.createElement("span");
  let mensajeNickname = document.createElement("span");

  mensajeTelefono.id = "mensajeTelefono";
  mensajeEmail.id = "mensajeEmail";
  mensajeNickname.id = "mensajeNickname";
  mensajeTelefono.classList.add("error-message");
  mensajeEmail.classList.add("error-message");
  mensajeNickname.classList.add("error-message");

  telefonoInput.insertAdjacentElement("afterend", mensajeTelefono);
  emailInput.insertAdjacentElement("afterend", mensajeEmail);
  nicknameInput.insertAdjacentElement("afterend", mensajeNickname);

  // Verificación AJAX
  function checkIfExists(field, value, messageElement, url) {
    fetch(url, {
      method: "POST",
      body: JSON.stringify({ field, value }),
      headers: {
        "Content-Type": "application/json"
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.exists) {
        messageElement.textContent = `${field.charAt(0).toUpperCase() + field.slice(1)} ya está registrado.`;
        messageElement.classList.add("input-error");
        submitButton.disabled = true; // Deshabilitar el botón
      } else {
        messageElement.textContent = "";
        messageElement.classList.remove("input-error");
        toggleSubmitButton(); // Revalidar el estado del botón
      }
    });
  }

  // Validar teléfono
  telefonoInput.addEventListener("input", function () {
    checkIfExists('telefono', telefonoInput.value, mensajeTelefono, 'check_field.php');
  });

  // Validar email
  emailInput.addEventListener("input", function () {
    checkIfExists('email', emailInput.value, mensajeEmail, 'check_field.php');
  });

  // Validar nickname
  nicknameInput.addEventListener("input", function () {
    checkIfExists('nickname', nicknameInput.value, mensajeNickname, 'check_field.php');
  });

  // Habilitar el botón de submit si todo es válido
  function toggleSubmitButton() {
    const telefonoValido = /^\d{10}$/.test(telefonoInput.value);
    const emailValido = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(emailInput.value) && !emailInput.value.includes(" ");
    const nicknameValido = /^[a-zA-Z0-9_]{1,15}$/.test(nicknameInput.value);

    if (telefonoValido && emailValido && nicknameValido) {
      submitButton.disabled = false; // Habilitar el botón si todo es válido
    } else {
      submitButton.disabled = true; // Deshabilitar el botón si hay algún error
    }
  }

  toggleSubmitButton(); // Inicializar el estado del botón al cargar la página
});

