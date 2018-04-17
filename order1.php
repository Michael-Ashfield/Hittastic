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

$conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
$IDquery = $conn->query("SELECT * FROM wadsongs WHERE ID='$songID'");
$row = $IDquery->fetch();
echo "This song has " . $row["quantity"] . " units left in stock.";

if ($row["quantity"] > 0){ //Ensures song is instock for it to be ordered
  echo "
    <form method='POST' action='order2.php'>
        <fieldset>
            <legend>Order a physical copy</legend>
            <input type='hidden' name='ID' value='$songID' />
            <label>Quantity: </label><input type='number' min='1' max='" . $row["quantity"] . "' name='quantity' required />
            <br />
            <input type='submit' value='Submit' style='margin-top: 10px;'/>
        </fieldset>
    </form>
    ";  
}
else{
    echo "<h2 style='color: red;'>This song is <b>NOT</b> instock, please come back later to see if it is instock.<h2>";
}
echo "<p><a href='index.php'>Return home</a></p>";

?>

<?php
}
?>