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
$songID = $_GET["ID"];
$username = $_SESSION["gatekeeper"];

$conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
//Update song downloads
$results = $conn->query("UPDATE wadsongs SET downloads=downloads+1 WHERE ID='$songID'");
$IDquery = $conn->query("SELECT * FROM wadsongs WHERE ID='$songID'");
$row = $IDquery->fetch();
$price = $row['price'];
echo "This song has been downloaded " . $row["downloads"] . " times.";
echo "<p><a href='index.php'>Return home</a></p>";
//upodate balance
$myBalance = $conn->query("SELECT balance FROM ht_users WHERE username='$username'");
$row = $myBalance->fetch();
if(($row["balance"]-$price) < 0){
    echo "You do not have enough balance to download this song";
}
else{
    $newBalance = $conn->query("UPDATE ht_users SET balance=balance-$price WHERE username='$username'");
    $trueBalance = $row["balance"] - $price;//Gets the true balance as its not updated from the balance decrease
    echo "<p>Your balance is: $trueBalance </p>";
};
?>

<?php
}
?>