document.addEventListener("DOMContentLoaded", function () {
  const telefonoInput = document.getElementById("telefono");
  const emailInput = document.getElementById("email");
  const nicknameInput = document.getElementById("nickname");
  const submitButton = document.querySelector("button[type='submit']");

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
    if (!value) {
      messageElement.textContent = `${field.charAt(0).toUpperCase() + field.slice(1)} no puede estar vacío.`;
      messageElement.classList.add("input-error");
      return;
    }

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
      } else {
        messageElement.textContent = "";
        messageElement.classList.remove("input-error");
      }
    })
    .catch(error => {
      console.error("Error en la petición AJAX:", error);
    });
  }

  telefonoInput.addEventListener("input", function () {
    checkIfExists('telefono', telefonoInput.value, mensajeTelefono, 'check_field.php');
  });

  emailInput.addEventListener("input", function () {
    checkIfExists('email', emailInput.value, mensajeEmail, 'check_field.php');
  });

  nicknameInput.addEventListener("input", function () {
    checkIfExists('nickname', nicknameInput.value, mensajeNickname, 'check_field.php');
  });

  // Realizar validación del formato localmente
  telefonoInput.addEventListener("input", function () {
    if (!/^\d{10}$/.test(telefonoInput.value)) {
      mensajeTelefono.textContent = "El teléfono debe tener 10 dígitos.";
      mensajeTelefono.classList.add("input-error");
    } else {
      mensajeTelefono.textContent = "";
      mensajeTelefono.classList.remove("input-error");
    }
  });

  emailInput.addEventListener("input", function () {
    if (!/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(emailInput.value) || emailInput.value.includes(" ")) {
      mensajeEmail.textContent = "Por favor ingresa un email válido.";
      mensajeEmail.classList.add("input-error");
    } else {
      mensajeEmail.textContent = "";
      mensajeEmail.classList.remove("input-error");
    }
  });

  nicknameInput.addEventListener("input", function () {
    if (!/^[a-zA-Z0-9_]{1,15}$/.test(nicknameInput.value)) {
      mensajeNickname.textContent = "El nickname solo puede tener letras, números y guiones bajos.";
      mensajeNickname.classList.add("input-error");
    } else {
      mensajeNickname.textContent = "";
      mensajeNickname.classList.remove("input-error");
    }
  });
});

