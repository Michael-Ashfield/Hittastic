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
$songID = $_POST["ID"];
$quantity = $_POST["quantity"];

$conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
if ($quantity > 0){
	$username = $_SESSION["gatekeeper"];
	$results = $conn->query("SELECT balance FROM ht_users WHERE username='$username'");
	$row = $results->fetch();
	$myBalance = $row["balance"];
	
	$results = $conn->query("SELECT * FROM wadsongs WHERE ID='$songID'");
	$row = $results->fetch();
	$songPrice = $row["price"];
	$songTitle = $row["title"];
	$songArtist = $row["artist"];
	$songQuantity = $row["quantity"];
	
	$total = $songPrice * $quantity;
	
	if(($myBalance = $myBalance - $total) >= 0){
		$results = $conn->query("UPDATE ht_users SET balance=balance-'$total' WHERE username='$username'");
		$results = $conn->query("UPDATE wadsongs SET quantity=quantity-'$quantity' WHERE ID='$songID'");
		echo "<h2>Thank you for ordering " . $songTitle . " by " . $songArtist . "!</h2>";
		echo "<p>This song has " . ($songQuantity - $quantity) . " units left instock</p>";
		echo "<p><a href='index.php'>Return home</a></p>";
	}
	else{
		echo "You do not have enough balance to purchase this song";
		
	};
}
else{
	echo "This song is not in stock";
};
?>

<?php
}
?>