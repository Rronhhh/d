<?php
include('config.php'); // Përfshini skedarin e lidhjes me bazën e të dhënave

class SessionAuthService {
    private static $dbConnection;

    // Inicializoni AuthService me lidhjen e bazës së të dhënave
    public static function init($conn) {
        self::$dbConnection = $conn;
    }

    // Regjistro një përdorues të ri
    public static function registerUser($user) {
        $username = htmlspecialchars($user->getUsername()); // Sanitize input
        $email = htmlspecialchars($user->getEmail()); // Sanitize input
        $password = $user->getPassword(); // Nuk ka nevojë për shfrytëzim, trajtohet sigurt
        $role = $user->getRole();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $statement = self::$dbConnection->prepare($query);
        $statement->bindValue(1, $username, PDO::PARAM_STR);
        $statement->bindValue(2, $email, PDO::PARAM_STR);
        $statement->bindValue(3, $hashedPassword, PDO::PARAM_STR);
        $statement->bindValue(4, $role, PDO::PARAM_STR);
        $result = $statement->execute();
        $statement->closeCursor();

        return $result;
    }

    // Hyrja e përdoruesit
    public static function loginUser($username, $password) {
        // Nisni sesionin vetëm nëse nuk është nisur më parë
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $query = "SELECT id, password FROM users WHERE username = ?";
        $statement = self::$dbConnection->prepare($query);
        $statement->bindValue(1, $username, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        if (!$result) {
            return false; // Përdoruesi nuk u gjet
        }

        if (password_verify($password, $result['password'])) {
            $_SESSION['id'] = $result['id'];
            return true; // Hyrja është e suksesshme
        }

        return false; // Fjalëkalimi i pavlefshëm
    }

    // Merr përdoruesin sipas emrit të përdoruesit
    public static function getUserByUsername($username) {
        $query = "SELECT id, username, email, role FROM users WHERE username = ?";
        $statement = self::$dbConnection->prepare($query);
        $statement->bindValue(1, $username, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        return $result;
    }
}
?>
