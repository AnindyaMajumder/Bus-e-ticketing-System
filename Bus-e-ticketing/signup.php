<?php
    session_start();
    include("db.php");

    $UserID = $_POST["UserID"];
    $NID = $_POST["NID"];
    $Phone = $_POST["Phone"];
    $Name = $_POST["Name"];
    $Password = $_POST["Password"];

    $check = "SELECT * FROM customer WHERE NID = '$NID' OR Username = '$UserID'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        header("Location: login.html?error=1");
        exit();

    } else {
        // Insert data into 'customer' table
        $sql = "INSERT INTO customer (NID, Phone, Username, Name, Password, AdminID)
        VALUES ('$NID', '$Phone', '$UserID', '$Name', '$Password', '1')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.html");;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>
