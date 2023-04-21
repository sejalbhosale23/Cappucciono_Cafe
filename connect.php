<?php

$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

$conn = mysqli_init();

mysqli_ssl_set($conn,NULL,NULL, "C:\Users\Vedant\Downloads\DigiCertGlobalRootCA.crt.pem", NULL, NULL);
mysqli_real_connect($conn, "cafe.mysql.database.azure.com", "sejal", "Bhosale@2002", "customer_requests", 3306, MYSQLI_CLIENT_SSL);
// print_r($conn);
$sql = "DELETE FROM customerQueries";
if (mysqli_query($conn, $sql)) {
  // echo "all data in table deleted successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
//create table

        // $sql = "CREATE TABLE customerQueries (
        // id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        // customer_name VARCHAR(30) NOT NULL,
        // email VARCHAR(50),
        // feedback_message VARCHAR(100) NOT NULL
        // )";
        
        // if ($conn->query($sql) === TRUE) {
        //   echo "Table MyGuests created successfully";
        // } else {
        //   echo "Error creating table: " . $conn->error;
        // }

        // if (mysqli_query($conn, $sql)) {
        //   echo "Table MyGuests created successfully";
        // } else {
        //   echo "Error creating table: " . mysqli_error($con);
        // }

//insert data

$sql = "INSERT INTO customerQueries (customer_name, email, feedback_message)
VALUES ('$name', '$email', '$message')";

// if (mysqli_query($conn, $sql)) {
//   echo "New record Entered successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }


// $sql = "INSERT INTO Patient (patientname, email, appointment_date, mobile, feedback_message)
// VALUES ('$name', '$email', '$date', '$phone', '$message')";

if (mysqli_query($conn, $sql)) {
  echo "<h1 style='color:#02d62d;text-align:center;'>Your Question is sent to our technical experts. We'll reach back to you soon. Thank You</h1> <br>";
  // echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//delete all data in table

// $sql = "DELETE FROM Patient";
// if (mysqli_query($conn, $sql)) {
//   echo "all data in table deleted successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }


//select data

$sql = "SELECT customer_name, email, feedback_message FROM customerQueries";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "<br>" ."Name: " . $row["customer_name"]. "<br>" . "email id : " . $row["email"]. "<br>". "Feedback Mesaage : " . $row["feedback_message"]. "<br><a href='index.html'><button type='button'>Return to main page</button></a>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?>