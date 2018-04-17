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
echo "
<html>
    <head>
    <title>Change details of existing song</title>
    </head>
    <body>
    <h1>Change details of an existing song</h1>
    <form method='post' action='changedetails2.php'>
    <label for='id'>ID of song: </label> <br />
    <input name='id' /><br/>
    <input type='submit' value='Go!' />
    <p><a href='index.php'>Return home</a></p>
    </body>
</html>
"

?>

<?php
};
}
?>