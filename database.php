<?php
    session_start();
    $host = 'localhost';
    $dbname = 'kd printing services';
    $username = 'root';
    $password = '';
    try  {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $fullname = $_SESSION['fullname'];
            $email = $_SESSION['email'];
            $address = $_SESSION['address'];
            $password = $_SESSION['password'];
            $sql = 'INSERT INTO account (fullname, email, address, password) VALUES (:fullname, :email, :address, :password)';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['fullname' => $fullname, 'email' => $email, 'address' => $address, 'password' => $password]);
            header('Location: http://localhost/KD Printing Services/homepage.php');
            session_unset();
            session_destroy();
    }  catch(PDOException $pe) {
        die("Could not create account $dbname : " . $pe->getMessage());
    } 
?>