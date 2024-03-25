<?php

class User {
    private $username;
    private $password;
    private $email;
    private $role;

    public function __construct($username, $password, $email, $role) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }
}
?>
