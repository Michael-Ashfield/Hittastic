<?php
session_start();

$un = $_POST["username"];
$pw = $_POST["password"];

$conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
$statement = $conn->prepare("SELECT username, password FROM ht_users WHERE username=:username");
$statement->bindParam(":username", $un);
$statement->execute();
$row = $statement->fetch();
if ($row == false){
        echo "
        <link rel='stylesheet' type='text/css' href='style.css'>
        This account does not exist";
    }
    
    else{
        while($row != false)
        {
            if ($pw == $row["password"]){
                $_SESSION["gatekeeper"] = $row["username"];
                header ("Location: index.php");
            }
            else{
                echo "
                <link rel='stylesheet' type='text/css' href='style.css'>
                Incorrect password";
            };
            $row = $statement->fetch();
        };
    }; 
echo "<p><a href='login.html'>Go back</a></p>";
?>