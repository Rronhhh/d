<?php
// Krijimi i lidhjes me bazën e të dhënave
include('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kontrolloni nëse është dorëzuar forma
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Merrni vlerat e dhëna nga forma
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Shto produktin në bazën e të dhënave
    $sql = "INSERT INTO products (product_name, price,description) 
            VALUES ('$product_name', '$price', '$description')";

    if (mysqli_query($conn, $sql)) {
        echo "Produkti u shtua me sukses.";
    } else {
        echo "Gabim gjatë shtimit të produktit: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>