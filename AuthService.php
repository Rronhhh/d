<?php
class AuthService {
    private static $dbConnection;

    // Initialize AuthService with database connection
    public static function init($conn) {
        self::$dbConnection = $conn;
    }

    // Register a new user
    public static function registerUser($user) {
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $role = $user->getRole();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $statement = self::$dbConnection->prepare($query);
        $statement->bindParam(1, $username);
        $statement->bindParam(2, $email);
        $statement->bindParam(3, $hashedPassword);
        $statement->bindParam(4, $role);
        $result = $statement->execute();
        $statement->closeCursor();

        return $result;
    }

    // Login user
    public static function loginUser($username, $password) {
        $query = "SELECT * FROM users WHERE username = ?";
        $statement = self::$dbConnection->prepare($query);
        $statement->bindParam(1, $username);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        if (!$result) {
            return false; // User not found
        }

        if (password_verify($password, $result['password'])) {
            session_start();
            $_SESSION['id'] = $result['id'];
            return true; // Login successful
        }

        return false; // Invalid password
    }

    // Get user by username
    public static function getUserByUsername($username) {
        $query = "SELECT * FROM users WHERE username = ?";
        $statement = self::$dbConnection->prepare($query);
        $statement->bindParam(1, $username);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        return $result;
    }
}
?>
