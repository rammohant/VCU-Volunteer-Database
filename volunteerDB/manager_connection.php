<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "rammohant";
$password = "V00854777";
$database = "project_rammohant";

$link = mysqli_connect($servername, $username, $password, $database);

try {
    // Establish a connection with the MySQL server
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Start or resume session variables
session_start();

// If the user_ID session is not set, then the user has not logged in yet
if (!isset($_SESSION['userID']))
{
    // If the page is receiving the email and password from the login form then verify the login data
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $stmt = $conn->prepare("SELECT userID, password FROM users WHERE email=:email and type IN ('organizer','admin')");
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->execute();
        
        $queryResult = $stmt->fetch();

        $stmt2 = $conn->prepare("SELECT userID, password FROM users WHERE email=:email and type IN ('volunteer')");
        $stmt2->bindValue(':email', $_POST['email']);
        $stmt2->execute();
        
        $queryResult2 = $stmt->fetch();
        
        // Verify password submitted by the user with the hash stored in the database
        if(!empty($queryResult) && password_verify($_POST["password"], $queryResult['password']))
        {
            // Create session variable
            $_SESSION['userID'] = $queryResult['userID'];
            
            // Redirect to URL
            header("location:manager_v.php"); 
        } else if(!empty($queryResult) && password_verify($_POST["password"], $queryResult2['password'])) {
            // Create session variable
            $_SESSION['userID'] = $queryResult['userID'];
            // Redirect to URL
            header("location:volunteer_v.php"); 
        } else {
            // Password mismatch
            echo("Please login to access this page.");
            require('login.php');
            exit();
        }
    } 
    else
    {
        // Show login page
        echo("Please login to access this page.");
        require('login.php');
        exit();
    }
}

?>
