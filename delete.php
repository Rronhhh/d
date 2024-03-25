<?php
include('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kontrolloni nëse është dorëzuar një kërkesë POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kontrolloni nëse është dërguar një fushë dhe një vlerë për fshirje
    if(isset($_POST['field']) && isset($_POST['value'])) {
        // Lidhja me bazën e të dhënave
        include('config.php');

        $field = $_POST['field'];
        $value = $_POST['value'];

        // SQL query për të fshirë produktin nga tabela e produkteve
        $sql = "DELETE FROM products WHERE $field = '$value'";

        if (mysqli_query($conn, $sql)) {
            $message = "Produkti u fshi me sukses.";
        } else {
            $error = "Gabim gjatë fshirjes së produktit: " . mysqli_error($conn);
        }

        // Mbyll lidhjen me bazën e të dhënave
        mysqli_close($conn);
    } else {
        // Nëse nuk janë dërguar të gjitha fushat e nevojshme, shfaqni një mesazh gabimi
        $error = "Gabim: Fusha dhe vlera për fshirje nuk janë dërguar saktësisht.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <!-- CSS stili dhe JavaScript mund të shtohen këtu -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        select, input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .error {
            background-color: #ffcccc;
            border: 1px solid #ff9999;
            color: #cc0000;
        }
        .success {
            background-color: #ccffcc;
            border: 1px solid #99ff99;
            color: #009900;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <label for="field">Choose Field:</label>
        <select name="field" id="field" required>
            <option value="id">ID</option>
            <option value="product_name">Product Name</option>
            <option value="price">Price</option>
            <option value="description">Description</option>
            <option value="image_url">Image URL</option>
        </select>
        <label for="value">Enter Value:</label>
        <input type="text" id="value" name="value" required>
        <button type="submit">Delete Product</button>
    </form>
    <?php if(isset($error)): ?>
        <div class="message error"><?php echo $error; ?></div>
    <?php elseif(isset($message)): ?>
        <div class="message success"><?php echo $message; ?></div>
    <?php endif; ?>
</body>
</html>
