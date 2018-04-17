<?php
   	session_start();
    if ( !isset ($_SESSION["gatekeeper"])){
        echo "
        <link rel='stylesheet' type='text/css' href='style.css'>
        You're not logged in. Go away!";
        echo "<p><a href='login.html'>Login</a></p>";
    }
    else{
        ?>
        
<?php
echo '<link rel="stylesheet" type="text/css" href="style.css">';

$username = $_POST["username"];
$pass = $_POST["newpassword"];



$conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
$results = $conn->query("SELECT * FROM ht_users WHERE username='$username'");
$check = $results->fetch();
if ($check == true){
    echo "You updated your password";
    $results = $conn->query("UPDATE ht_users SET password='$pass' WHERE username='$username'");
}
else{
    echo "User not found, please check that you are using a valid username.";
}
echo "<p><a href='index.php'>Return home</a></p>";

?>

<?php
}
?>