<?php
include('config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class ProductManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteProduct($field, $value) {
        // SQL query to delete the product from the products table
        $sql = "DELETE FROM products WHERE $field = ?";
        
        // Prepare the SQL statement
        $statement = $this->conn->prepare($sql);

        // Bind parameters
        $statement->bind_param("s", $value);

        // Execute the statement
        if ($statement->execute()) {
            return "Product deleted successfully.";
        } else {
            return "Error deleting product: " . $this->conn->error;
        }

        // Close the prepared statement
        $statement->close();
    }
}

// Check if a POST request is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if both field and value for deletion are provided
    if (isset($_POST['field']) && isset($_POST['value'])) {
        // Get the field and value for deletion
        $field = $_POST['field'];
        $value = $_POST['value'];

        // Create a new instance of ProductManager class
        $productManager = new ProductManager($conn);

        // Delete the product
        $message = $productManager->deleteProduct($field, $value);
    } else {
        // If not all necessary fields are provided, show an error message
        $error = "Error: Field and value for deletion are not provided correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 100;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .message {
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .message.error {
            background-color: #dc3545;
            color: #fff;
        }

        .message.success {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>
<body>
<?php
include('header.php');?>
    <form method="post" action="">
        <label for="field">Choose Field:</label>
        <select name="field" id="field" required>
            <option value="id">ID</option>
            <option value="name">Product Name</option>
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
