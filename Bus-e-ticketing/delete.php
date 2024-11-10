<?php
    session_start();
    include("db.php");
    
    if (isset($_POST['delete'])) {
        // SQL to delete a record
        $sql = "DELETE FROM customer WHERE username = ?";
        $UserName = $_SESSION['USER'];
        // Prepare statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $UserName);
    
        // Execute the query
        if ($stmt->execute()) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
    
        // Close statement and connection
        $stmt->close();
    }
    
    $conn->close();
?>