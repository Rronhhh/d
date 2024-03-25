<?php
class dbConnect {
    private $conn = null;
    private $host = 'localhost';
    private $dbname = 'web';
    private $username = 'root';
    private $password = '';

    // Konstruktori
    public function __construct() {
        try {
            // Krijoni lidhjen në momentin e krijuarit të objektit
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            // Vendosni parametrat e PDO për menaxhim të gabimeve dhe për kthimin e rezultateve në një format të përshtatshëm
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $pdoe) {
            // Ndalo aplikacionin nëse nuk mund të lidhet me bazën e të dhënave
            die("Nuk mund të lidhej me bazën e të dhënave {$this->dbname} :" . $pdoe->getMessage());
        }
    }

    // Metoda për të lidhur me bazën e të dhënave
    public function connectDB() {
        return $this->conn;
    }
}
?>