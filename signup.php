<?php
echo '<link rel="stylesheet" type="text/css" href="style.css">';

$username = $_POST["username"];
$password = $_POST["password"];
$name = $_POST["name"];
$day = $_POST["day"];
$month = $_POST["month"];
$year = $_POST["year"];
$dob = "$day/$month/$year";
$date = getdate();
$dateyear = $date["year"];

if (($year + 18) > $dateyear) //If user is under 18
{
	echo "<h1>You must be over 18 to use this site</h1>"	;
}

else //details are correct
{
	echo "
		<p>You have signed up with:</p>
		<p>Name: $name</p>
		<p>Username: $username</p>
		<p>Date of birth: $dob</p>
	";
	$conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
    $results = $conn->query("INSERT INTO ht_users (username,password,name,dayofbirth,monthofbirth,yearofbirth) VALUES ('$username','$password','$name',$day,$month,$year)");
}
echo "<p><a href='index.php'>Return home</a></p>";
?>