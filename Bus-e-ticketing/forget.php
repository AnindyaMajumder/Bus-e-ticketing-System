<?php
    session_start();
    include("db.php");

    // Get UserID and Password from the form
    $UserID = $_POST['UserID'];
    $newPassword = $_POST['Password'];

    // Prepare a select statement to check if UserID exists
    $stmt = $conn->prepare("SELECT * FROM customer WHERE Username = ?");
    $stmt->bind_param("s", $UserID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if UserID exists
    if ($result->num_rows > 0) {
        // UserID exists, prepare an update statement
        $updateStmt = $conn->prepare("UPDATE customer SET Password = ? WHERE Username = ?");
        $updateStmt->bind_param("ss", $newPassword, $UserID);
        $updateStmt->execute();

        echo "Password updated successfully.";
        header("Location: login.html");
    } else {
        // UserID does not exist
        header("Location: forget.html?error=1");
        exit();
    }

    $stmt->close();
    $updateStmt->close();



    $conn->close();
?>