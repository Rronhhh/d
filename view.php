<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Historiku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        li:last-child {
            margin-bottom: 0;
        }
        .no-results {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Kontrolloni sesionin dhe fillon një sesion nëse nuk është startuar ende
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kontrolloni nëse ekziston një sesion dhe nëse përdoruesi është administrator
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 1) {
            // Ridrejto në faqen e kyçjes nëse përdoruesi nuk është administrator
            header("Location: login.php");
            exit; // Mbyll skriptin për të parandaluar ekzekutimin e kodit më poshtë
        }

        // Informacionet për lidhjen me bazën e të dhënave
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "webdesignproject";

        // Krijimi i lidhjes me bazën e të dhënave
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kontrolloni lidhjen
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query për të zgjedhur veprimet nga tabela e historikut
        $query = "SELECT * FROM historiku";
        $result = $conn->query($query);

        // Shfaq veprimet e historikut në faqe nëse ka rezultate
        if ($result->num_rows > 0) {
            echo "<h2>Historiku i Veprimeve</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "Përdoruesi ID: " . $row['perdorues_id'] . " - Veprimi: " . $row['veprimi'] . " - Data: " . $row['data'];
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p class='no-results'>Nuk ka veprime të regjistruara në historik.</p>";
        }

        // Mbyll lidhjen me bazën e të dhënave
        $conn->close();
        ?>
    </div>
</body>
</html>
