<?php
    session_start();
    include("db.php");

    $UserID = $_POST["UserID"];
    $Password = $_POST["Password"];

    // Check if the user is admin
    if ($UserID == 'admin' && $Password == 'adminadmin') {
        header("Location: http://localhost/phpmyadmin/index.php?route=/database/structure&db=bus_e-ticketing");
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM customer WHERE Username = ? AND Password = ?");
    $stmt->bind_param("ss", $UserID, $Password);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['USER'] = $UserID;
        header("Location: index.html");
    } else {
        header("Location: login.html?error=1");
        exit();
    }

    $stmt->close();
    $conn->close();
?>