<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST["email"]);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        $conn = mysqli_connect("localhost", "root", "", "taus_data");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT firstName, lastName, email FROM tbl_student WHERE email = ?";

            $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $firstName, $lastName, $studentEmail);

    if (mysqli_stmt_fetch($stmt)) {

        echo "<div class='message message-success'>";
        echo "Student found: " . htmlspecialchars($firstName . " " . $lastName);
        echo "<br>Email: " . htmlspecialchars($studentEmail);
        echo "</div>";
    }
    
    else {

        echo "<div class='message message-error'>";
        echo "Student email was not found.";
        echo "</div>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searching a Database with PHP and MySQL</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

    <h1>Searching a Database with PHP and MySQL</h1>
    <p>Calen Barbour</p>
    <p>November 6, 2026</p>

    <p><a href="index.php">Return to Search</a></p>

</body>
</html>