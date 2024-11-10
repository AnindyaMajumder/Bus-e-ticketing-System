<?php
    session_start();

    $Route = "";
    if ($_SESSION['Coach'] =='1') {
        $Route = "Dhaka to Chittagong";
    }
    elseif($_SESSION['Coach'] =='2') {
        $Route = "Dhaka to Sylhet";
    }
    elseif($_SESSION['Coach'] =='3') {
        $Route = "Chittagong to Dhaka";
    }
    elseif($_SESSION['Coach'] =='4') {
        $Route = "Sylhet to Dhaka";
    }
?>

<!DOCTYPE html>
<html>
<head>
<link href="assets/img/favicon.png" rel="icon">
    <title>Bus Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
            background-image: linear-gradient(to right, #fff94c, #f7e767, #fff94c);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
        }
        th {
            background-color: #ffeb3b;
            color: #333;
        }
        tr:hover {
            background-color: #fffde7;
        }
        .button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #ffeb3b;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #fdd835;
        }
    </style>
</head>
<body>

<h2>Bus Ticket Details</h2>

<table>
    <tr>
        <th>Detail</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>Route</td>
        <td><?php echo $Route; ?></td>
    </tr>
    <tr>
        <td>UserID</td>
        <td><?php echo $_SESSION['USER']; ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $_SESSION['email']; ?></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td><?php echo $_SESSION['Phone']; ?></td>
    </tr>
    <tr>
        <td>Date</td>
        <td><?php echo $_SESSION['date']; ?></td>
    </tr>
    <tr>
        <td>Time</td>
        <td><?php echo $_SESSION['time']; ?></td>
    </tr>
    <tr>
        <td>Number of Persons</td>
        <td><?php echo $_SESSION['no_of_person']; ?></td>
    </tr>
    <tr>
        <td>Cost</td>
        <td><?php echo $_SESSION['Cost']; ?></td>
    </tr>
    <tr>
        <td>Transaction ID</td>
        <td><?php echo $_SESSION['TrnxID']; ?></td>
    </tr>
</table>

<a href="index.html" class="button">Back to Home</a>

</body>
</html>