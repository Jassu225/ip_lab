<?php
    
    require("db_connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"]) && $_POST["name"] == ""){
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        
        $sql = "SELECT * FROM student WHERE mobile='$mobile'";
        $result  = $conn->query($sql);
        if ( $result->num_rows > 0) {
            $record = $result->fetch_assoc();

            $mobile = $record["mobile"];
            $name = $record["name"];
            $fname = $record["fatherName"];
            $roll = $record["roll"];
            $laddress = $record["ladd"];
            $paddress = $record["padd"];
            $gender = $record["gender"];
            $email = $record["email"];
        } else {
            echo "alert('Error: $sql <br> $conn->error')";
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {

        echo var_dump($_POST);

        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $fname = mysqli_real_escape_string($conn, $_POST['fatherName']);
        $roll = mysqli_real_escape_string($conn, $_POST['roll']);
        $laddress = mysqli_real_escape_string($conn, $_POST['postalAddress']);
        $paddress = mysqli_real_escape_string($conn, $_POST['permanentAddress']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $sql = "INSERT INTO student VALUES ('$mobile', '$name', '$fname', '$roll', '$laddress', '$paddress', '$gender', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "alert('New record created successfully')";
        } else {
            echo "alert('Error: $sql <br> $conn->error')";
        }

    }

    $conn->close();
?>