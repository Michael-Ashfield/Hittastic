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
$artist = $_GET["artist"];
echo '<link rel="stylesheet" type="text/css" href="style.css">';
echo "<h1>You are searching for songs by $artist</h1>";

if ($artist == ""){
    echo "<p>Nothing entered!</p>";
    echo "<p>Please return and enter an artist</p>";
}

else{
    $conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
    $results = $conn->query("select * from wadsongs where artist='$artist'");
    $row = $results->fetch();
    
    if ($row == false){
        echo "No results found!";
    }
    
    else{
        while($row != false)
        {
            echo "<p>";
            echo " Song title: ". $row["title"] ."<br /> ";
            echo " Artist: " . $row["artist"] . "<br /> " ; 
            echo " Year " .$row["year"]. "<br /> " ; 
            echo " <a href='download.php?ID=" . $row["ID"] . "'>Download</a><br /> ";
            echo " <a href='https://www.youtube.com/results?search_query=" . $row["title"] . "+" . $row["artist"] . "'>Youtube</a><br /> ";
            echo " <a href='order1.php?ID=" . $row["ID"] . "'>Order physical copy</a><br /> " ;
            echo " </p>";
            echo " <hr />";
            $row = $results->fetch();
        };
    };
}
echo "<p><a href='index.php'>Return home</a></p>";
?>

<?php
}
?>