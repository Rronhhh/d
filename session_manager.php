<?php
// Start the session
session_start();

// Set session cookie parameters to make them last for 3 minutes
$cookieParams = session_get_cookie_params();
session_set_cookie_params(180, $cookieParams["path"], $cookieParams["domain"], $cookieParams["secure"], $cookieParams["httponly"]);

// Redirect user to login/register page if not logged in
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: loginRegister.php");
    exit();
}

// Other PHP code and HTML content of your page goes here...
?>
