<?php
// server_config.php

// Vendosni variablat e konfigurimit për serverin këtu
$_SERVER["REQUEST_METHOD"] = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : ($_POST ? "POST" : ($_GET ? "GET" : "UNKNOWN"));
?>
