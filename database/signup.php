<?php
include("dbconnect.php"); 

session_start();
session_destroy();

if (isset($_POST['submit'])) {
    $FirstName = $_POST['firstname'];
    $LastName = $_POST['lastname'];
    $Age = $_POST['age'];
    $Address = $_POST['address'];
    $Username = $_POST['username'];
    $Password = $_POST['password'];

    $check_query = "SELECT * FROM croki WHERE username='$Username'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo '<script>
                window.location.href = "index2.php";
                alert("Username already exists. Please choose a different one.");
              </script>';
        exit();
    }
    else{
        $insert_query = "INSERT INTO croki (firstname, lastname, age, address, username, password) 
        VALUES ('$FirstName', '$LastName', '$Age', '$Address', '$Username', '$Password')";
        if ($conn->query($insert_query) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
        }

    }
}