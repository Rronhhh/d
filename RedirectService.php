<?php

class RedirectService {
    public static function redirectToDashboard($role) {
        if ($role == 'admin') {
            header("Location: adminDashboard.php");
        } else {
            header("Location: userDashboard.php");
        }
        exit();
    }
}
?>
