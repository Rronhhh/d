<?php
function sanitizeInput($input) {
    $input = trim($input); // Largo hapësirat e panevojshme nga fillimi dhe fundi i stringut
    $input = stripslashes($input); // Largo karakteret backslashes (\)
    $input = htmlspecialchars($input); // Konverto karakteret e rrezikshme në entity HTML

    return $input;
}
?>
