<?php
    // Start the session
    session_start();

    // Check if the form data is submitted
    if(isset($_POST['submit'])) {
        // Store form data in session variables
        $_SESSION['Coach'] = $_POST["name"];
        $_SESSION['email'] = $_POST["email"];
        $_SESSION['Phone'] = $_POST["phone"];
        $_SESSION['date'] = $_POST["date"];
        $_SESSION['time'] = $_POST["time"];
        $_SESSION['no_of_person'] = $_POST["people"];

        // Redirect to Seat-Selection.html
        header('Location: Seat-Selection.html');
        exit();
    }
?>