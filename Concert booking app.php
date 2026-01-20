<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Concert Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            gap: 40px;
            justify-content: center;
            align-items: flex-start;
        }

        form {
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
        }

        .output {
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 500px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .radio-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        fieldset {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        legend {
            font-weight: bold;
            padding: 0 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <form action="" method="post">
        <label for="name">Please enter your name:</label>
        <input type="text" id="name" name="name" required>

        <label for="surname">Please enter your surname:</label>
        <input type="text" id="surname" name="surname" required>

        <label for="age">Please enter your age:</label>
        <input type="number" id="age" name="age" min="1" required>

        <fieldset>
            <legend>Gender:</legend>
            <div class="radio-group">
                <label for="male">Male</label>
                <input type="radio" id="male" name="gender" value="Male" required>
            </div>
            <div class="radio-group">
                <label for="female">Female</label>
                <input type="radio" id="female" name="gender" value="Female">
            </div>
            <div class="radio-group">
                <label for="other">Other</label>
                <input type="radio" id="other" name="gender" value="Other">
            </div>
        </fieldset>

        <fieldset>
            <legend>Ticket Type:</legend>
            <div class="radio-group">
                <label for="standard">General Admission</label>
                <input type="radio" id="standard" name="ticket" value="General Admission" checked>
            </div>
            <div class="radio-group">
                <label for="vip">VIP</label>
                <input type="radio" id="vip" name="ticket" value="VIP">
            </div>
            <div class="radio-group">
                <label for="vvip">VVIP</label>
                <input type="radio" id="vvip" name="ticket" value="VVIP">
            </div>
        </fieldset>

        <input type="submit" value="Submit">
    </form>

    <div class="output">
    <?php
    $MAX_SEATS = 60000;

    // Initialize session data
    if (!isset($_SESSION['seat_number'])) {
        $_SESSION['seat_number'] = 1;
    }

    if (!isset($_SESSION['sales'])) {
        $_SESSION['sales'] = [
            'Female' => ['16-21' => 0, '22-35' => 0],
            'Male' => ['16-21' => 0, '22-35' => 0],
            'Other' => ['16-21' => 0, '22-35' => 0]
        ];
    }

    // Handle submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"], $_POST["surname"], $_POST["age"], $_POST["gender"], $_POST["ticket"])) {
        $name = htmlspecialchars($_POST["name"]);
        $surname = htmlspecialchars($_POST["surname"]);
        $age = intval($_POST["age"]);
        $gender = htmlspecialchars($_POST["gender"]);
        $ticket = htmlspecialchars($_POST["ticket"]);

        echo "<h3>Booking Details:</h3>";
        echo "Name: $name $surname <br>";
        echo "Age: $age <br>";
        echo "Gender: $gender <br>";
        echo "Ticket Type: $ticket <br>";

        if ($age < 16 || $age > 35) {
            echo "<p style='color: red;'>Your age does not meet the criteria (16-35) for this concert.</p>";
        } elseif ($_SESSION['seat_number'] > $MAX_SEATS) {
            echo "<p style='color: red;'>All 60,000 tickets have been sold out. Booking closed.</p>";
        } else {
            $seat_number = $_SESSION['seat_number']++;
            echo "Seat Number: $seat_number <br>";

            switch($ticket){
                case "General Admission": 
                    echo "Ticket Price: R500<br>"; 
                    break;
                case "VIP": 
                    echo "Ticket Price: R2000<br>";
                     break;
                case "VVIP": 
                    echo "Ticket Price: R3000<br>"; 
                    break;
            }

            if ($age >= 16 && $age <= 21) {
                $age_group = "16-21";
            } else {
                $age_group = "22-35";
            }

            echo "Age group: $age_group <br>";
            $_SESSION['sales'][$gender][$age_group]++;
            echo "<p style='color: green;'>Booking confirmed! Enjoy the concert.</p>";
        }

        echo "<hr>";
    }

    // Output total sales and breakdown
    $totalSold = $_SESSION['seat_number'] - 1;
    echo "<h3>Ticket Sales Summary:</h3>";
    echo "<strong>Total Tickets Sold: $totalSold / $MAX_SEATS</strong><br><br>";

    foreach ($_SESSION['sales'] as $g => $groups) {
        foreach ($groups as $group => $count) {
            echo "$g ($group): $count ticket(s) sold<br>";
        }
    }
    ?>
    </div>
</div>

</body>
</html>
