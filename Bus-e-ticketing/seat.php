<?php
    session_start();

    include("db.php");
   
    $_SESSION['TrnxID'] = uniqid();
    $coach_no = $_SESSION['Coach'];
    $no_of_persons = intval($_SESSION['no_of_person']);

    if ($coach_no == 1 || $coach_no == 3) {
        $_SESSION['Cost'] = 3000 * $no_of_persons;
    } elseif ($coach_no == 2 || $coach_no == 4) {
        $_SESSION['Cost'] = 500 * $no_of_persons;
    }

    // Retrieve nid from the customer table
    $nid = null;
    $nidSql = "SELECT nid FROM customer WHERE username = ?";
    if ($nidStmt = $conn->prepare($nidSql)) {
        $nidStmt->bind_param("s", $_SESSION['USER']);
        $nidStmt->execute();
        $nidStmt->bind_result($nid);
        $nidStmt->fetch();
        $nidStmt->close();
    } else {
        echo "Error preparing NID select statement: " . $conn->error;
    }

    // Check if the session date matches the date in the bus table
    $dateCheckSql = "SELECT Date FROM bus WHERE Coach_no = ?";
    if ($dateStmt = $conn->prepare($dateCheckSql)) {
        $dateStmt->bind_param("i", $coach_no);
        $dateStmt->execute();
        $dateStmt->bind_result($busDate);
        $dateStmt->fetch();
        $dateStmt->close();

        // Compare the session date with the bus table date
        if ($_SESSION['date'] == $busDate) {
            // Dates match, proceed with seat check
            $seatCheckSql = "SELECT Seat FROM bus WHERE Coach_no = ?";
            if ($seatStmt = $conn->prepare($seatCheckSql)) {
                $seatStmt->bind_param("i", $coach_no);
                $seatStmt->execute();
                $seatStmt->bind_result($currentSeats);
                $seatStmt->fetch();
                $seatStmt->close();

                // Check if adding the new persons will exceed the seat limit
                if ($currentSeats + $no_of_persons <= 40) {
                    // Proceed with updating the seat count
                    $updateSql = "UPDATE bus SET Seat = Seat + ? WHERE Coach_no = ?";
                    if ($updateStmt = $conn->prepare($updateSql)) {
                        $updateStmt->bind_param("ii", $no_of_persons, $coach_no);

                        if ($updateStmt->execute()) {
                            // Insert booking details into the book table, including the nid and rearranged order
                            $insertSql = "INSERT INTO book (NID, Coach_No, Email, Trx_ID, Phone, No_of_Person, Date, Time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                            if ($insertStmt = $conn->prepare($insertSql)) {
                                $insertStmt->bind_param("sisssiis", $nid, $_SESSION['Coach'], $_SESSION['email'], $_SESSION['TrnxID'], $_SESSION['Phone'], $_SESSION['no_of_person'], $_SESSION['date'], $_SESSION['time']);
                                
                                if ($insertStmt->execute()) {
                                    header("Location: ticket.php");
                                } else {
                                    echo "Error inserting record: " . $conn->error;
                                }
                                $insertStmt->close();
                            } else {
                                echo "Error preparing insert statement: " . $conn->error;
                            }
                        } else {
                            header("Location: Seat-Selection.html");
                        }
                        $updateStmt->close();
                    } else {
                        echo "Error preparing update statement: " . $conn->error;
                    }
                } else {
                    // Seat limit exceeded, alert the user and redirect
                    echo "<script>alert('Seat is full. Redirecting to the home page.'); window.location.href = 'index.html';</script>";
                }
            } else {
                echo "Error preparing seat check statement: " . $conn->error;
            }
        } else {
            // Dates do not match, alert the user and redirect
            echo "<script>alert('Date is not available. Redirecting to the home page.'); window.location.href = 'index.html';</script>";
        }
    } else {
        echo "Error preparing date check statement: " . $conn->error;
    }

    // Close connection
    $conn->close();
?>