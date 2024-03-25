function validateLogin() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  // Simple username validation (only letters and numbers)
  var usernameRegex = /^[a-zA-Z0-9]+$/;

  // Simple password validation (minimum 6 characters)
  var passwordRegex = /^.{6,}$/;

  if (!usernameRegex.test(username)) {
    alert("Invalid username. Please use only letters and numbers.");
    return false;
  }

  if (!passwordRegex.test(password)) {
    alert("Invalid password. Minimum 6 characters required.");
    return false;
  }

  // Perform login logic here (e.g., send data to the server)
  alert("Login successful!");
  return true;
}

function validateRegister() {
  var regUsername = document.getElementById("regUsername").value;
  var regEmail = document.getElementById("regEmail").value;
  var regPassword = document.getElementById("regPassword").value;

  // Simple username validation (only letters and numbers)
  var usernameRegex = /^[a-zA-Z0-9]+$/;

  // Simple email validation
  var emailRegex = /^\S+@\S+\.\S+$/;

  // Simple password validation (minimum 6 characters)
  var passwordRegex = /^.{6,}$/;

  if (!usernameRegex.test(regUsername)) {
    alert("Invalid username. Please use only letters and numbers.");
    return false;
  }

  if (!emailRegex.test(regEmail)) {
    alert("Invalid email address.");
    return false;
  }

  if (!passwordRegex.test(regPassword)) {
    alert("Invalid password. Minimum 6 characters required.");
    return false;
  }

  // Perform registration logic here (e.g., send data to the server)
  alert("Registration successful!");
  return true;
}
