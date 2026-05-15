document.getElementById("loginForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const nombre = document.getElementById("nombre").value.trim();
  const password = document.getElementById("password").value.trim();
  let valido = true;

  document.getElementById("errorNombre").textContent = "";
  document.getElementById("errorPassword").textContent = "";

  if (nombre === "") {
    document.getElementById("errorNombre").textContent = "El nombre de usuario es obligatorio.";
    valido = false;
  }

  if (password === "") {
    document.getElementById("errorPassword").textContent = "La contraseña es obligatoria.";
    valido = false;
  } else if (password.length < 6) {
    document.getElementById("errorPassword").textContent = "La contraseña debe tener al menos 6 caracteres.";
    valido = false;
  }

  if (valido) {
    alert("¡Inicio de sesión exitoso!");
  }
});ñ