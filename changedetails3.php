<?php
   	session_start();
    if ( !isset ($_SESSION["gatekeeper"])){
        echo "
        <link rel='stylesheet' type='text/css' href='style.css'>
        You're not logged in. Go away!";
        echo "<p><a href='login.html'>Login</a></p>";
    }
    else{
        $username = $_SESSION["gatekeeper"];
        $conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
        $admin = $conn->query("SELECT isadmin FROM ht_users WHERE username='$username'");
        $row = $admin->fetch();
        if($row["isadmin"] != 1){
            echo '<link rel="stylesheet" type="text/css" href="style.css">';
            echo "You must be an admin to access this page.";
            echo "<p><a href='index.php'>Return home</a></p>";
        }
        else{
        ?>
        
<?php
echo '<link rel="stylesheet" type="text/css" href="style.css">';
$ID = $_POST["id"];
$title = $_POST["title"];
$artist = $_POST["artist"];
$day = $_POST["day"];
$month = $_POST["month"];
$year = $_POST["year"];
$chart = $_POST["chart"];
$likes = $_POST["likes"];
$downloads = $_POST["downloads"];
$genre = $_POST["genre"];
$quantity = $_POST["quantity"];
$price = $_POST["price"];

$conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
$results = $conn->query("UPDATE wadsongs SET title='$title', 
artist='$artist', 
day='$day', 
month='$month', 
year='$year',
chart='$chart',
likes='$likes',
downloads='$downloads',
genre='$genre',
quantity='$quantity',
price='$price' 
WHERE ID='$ID'");

$results = $conn->query("select * from wadsongs where ID='$ID'");
$row = $results->fetch();
if ($row == false){
        echo "No results found!";
    }
    
    else{
        while($row != false)
        {
            echo "<h2>Details updated!</h2>";
            echo "<p>";
            echo " Song ID: " . $row["ID"] . "<br />";
            echo " Song title: ". $row["title"] . "<br /> ";
            echo " Artist: " . $row["artist"] . "<br /> " ; 
            echo " Day: " . $row["day"] . "<br /> " ; 
            echo " Month: " . $row["month"] . "<br /> " ; 
            echo " Year: " .$row["year"]. "<br /> " ;
            echo " Chart: " . $row["chart"] . "<br /> " ; 
            echo " Likes: " . $row["likes"] . "<br /> " ; 
            echo " Downloads: " . $row["downloads"] . "<br /> " ; 
            echo " Genre: " . $row["genre"] . "<br /> " ; 
            echo " Quantity: " . $row["quantity"] . "<br /> " ; 
            echo " Price: " . $row["price"] . "<br /> " ; 
            echo "</p>";
            echo "<a href='index.php'>Return home</a>";
            $row = $results->fetch();
        };
    };
?>

<?php
};
}
?>