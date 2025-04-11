document.querySelector("form").addEventListener("submit", function (e) {
  const telefono = document.getElementById("telefono").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm-password").value;

  const telefonoRegex = /^\d{10}$/;
  const emailRegex = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
  const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=]).{8,}$/;

  let errores = [];

  if (!telefonoRegex.test(telefono)) {
    errores.push("El teléfono debe tener exactamente 10 dígitos y solo números.");
  }

  if (!emailRegex.test(email)) {
    errores.push("El correo debe ser válido y contener @.");
  }

  if (!passwordRegex.test(password)) {
    errores.push("La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.");
  }

  if (password !== confirmPassword) {
    errores.push("Las contraseñas no coinciden.");
  }

  if (errores.length > 0) {
    e.preventDefault();
    alert(errores.join("\n"));
  }
});
