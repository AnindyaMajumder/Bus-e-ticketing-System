<?php
    session_start();
    include("db.php");

    // Check if the USER session is set
    if (isset($_SESSION['USER'])) {

        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT Name FROM customer WHERE username = ?");
        $stmt->bind_param("s", $_SESSION['USER']);
        $stmt->execute();

        // Bind the result to a variable
        $stmt->bind_result($name);

        // Fetch the result
        if ($stmt->fetch()) {
            echo "<div class='testimonial-item'><h3 style='font-size: 20px; font-weight: bold; align-content: center; margin: 10px 0 5px 0; color: #fff; font-family: \"Poppins\", sans-serif;'>" . htmlspecialchars($name) . "</h3></div>";
        } else {
            echo "<div class='testimonial-item'><h3 style='font-size: 20px; font-weight: bold; align-content: center; margin: 10px 0 5px 0; color: #fff; font-family: \"Poppins\", sans-serif;'>" . htmlspecialchars("Login First") . "</h3></div>" . $_SESSION['USER'];
        }

        // Close the statement and connection
        $stmt->close();
    } else {
        echo "User session is not set.";
    }

    $conn->close();
?>