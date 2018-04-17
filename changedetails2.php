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
$songID = $_POST["id"];

$conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
$results = $conn->query("select * from wadsongs where ID='$songID'");
$row = $results->fetch();
if ($row == false){
        echo "No results found!";
    }
    
    else{
        while($row != false)
        {
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
            echo " <hr />";
            
            echo "<form method='POST' action='changedetails3.php'>";
                echo "<fieldset>";
                    echo "<legend>Update song</legend>";
                    echo " <input type='hidden' name='id' value='" . $row["ID"] . "' />";
                    echo " <label>Song title:</label><input type='text' name='title' value='" . $row["title"] . "' /><br /> ";
                    echo " <label>Artist:</label><input type='text' name='artist' value='" . $row["artist"] . "' /><br /> " ; 
                    echo " <label>Day:</label><input type='text' name='day' value='" . $row["day"] . "' /><br /> " ; 
                    echo " <label>Month:</label><input type='text' name='month' value='" . $row["month"] . "' /><br /> " ; 
                    echo " <label>Year:</label><input type='text' name='year' value='" . $row["year"] . "' /><br /> " ;
                    echo " <label>Chart:</label><input type='text' name='chart' value='" . $row["chart"] . "' /><br /> " ; 
                    echo " <label>Likes:</label><input type='text' name='likes' value='" . $row["likes"] . "' /><br /> " ; 
                    echo " <label>Downloads:</label><input type='text' name='downloads' value='" . $row["downloads"] . "' /><br /> " ; 
                    echo " <label>Genre:</label><input type='text' name='genre' value='" . $row["genre"] . "' /><br /> " ; 
                    echo " <label>Quantity:</label><input type='text' name='quantity' value='" . $row["quantity"] . "' /><br /> " ; 
                    echo " <label>Price:</label><input type='text' name='price' value='" . $row["price"] . "' /><br /> " ;
                    echo " <input type='submit' value='Submit new details' />";
                echo "</fieldset>";
            echo "</form>";
            $row = $results->fetch();
        };
    };
    echo "<p><a href='index.php'>Return home</a></p>";
?>

<?php
};
}
?>