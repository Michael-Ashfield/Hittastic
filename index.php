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
        
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to HitTastic</title>
        <link rel="stylesheet" type="text/css" href="style.css">
		<script>
			function ajaxrequest()
				{
					var conn = new XMLHttpRequest();
					var artist = document.getElementById("myArtist").value;
					
					conn.addEventListener("load", resultsReturned);
					
					conn.open('GET', 'http://ephp.solent.ac.uk/~ephp051/hits.php?artist=' + artist);
					conn.send();
				}
	
			function resultsReturned(myData)
				{
					document.getElementById('response').innerHTML = myData.target.responseText;
				}
		</script>
	</head>
	<body>
	    
		<h1>Welcome to HitTastic</h1>
		<p>Search and shop for your favourite top 40 hits on HitTastic! Whether it's pop rock, rap or pure 
		liquid cheese you're into, you can be sure to find it on HitTastic! With the full range of top 40 
		hits from the past 50 years on our database, you can guarantee you'll fund what you're looking for
		in stock. Plus, with our Year Search find out exactly what was in the chart in any year in the 
		past 50 years.
		</p>
		<p>You are logged in as: <?php echo $_SESSION['gatekeeper']; ?></p>
		<p>Your balance is: <?php
		$username = $_SESSION["gatekeeper"];
		$conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
		$myBalance = $conn->query("SELECT balance FROM ht_users WHERE username='$username'");
        $row = $myBalance->fetch();
        echo $row["balance"]; ?>
		</p>
	    <form method="get" action="searchresults.php">
	        <p>
	            <label>Search by Artist</label>
	            <input type="text" name="artist" placeholder="Search by artist"/>
	            <input type="submit" value="Search" />
	        </p>
	    </form>
	    <p>Advanced search:</p>
	    <form method="get" action="advancedsearch.php">
	        <p>
	            <label>Type of search:</label>
	            <select name="advtype">
	                <option value="Title">Title</option>
	                <option value="Artist">Artist</option>
	                <option value="Year">Year</option>
	            </select>
	            <input type="text" name="advsearch" placeholder="Advanced search"/>
	            <input type="submit" value="Advanced search" />
	        </p>
	    </form>
		<p><a href="logout.php">Logout</a></p>
		<?php
		$username = $_SESSION["gatekeeper"];
		$conn = new PDO ("mysql:host=localhost;dbname=ephp051;", "ephp051", "uaxoojei");
		$results = $conn->query("SELECT isadmin FROM ht_users WHERE username='$username'");
		$row = $results->fetch();
		if($row["isadmin"] == 1){
			echo "<p><a href='changedetails1.php'>Update song data</a></p>";
		};
		?>
		<hr />
		<p>
			<label>Instantly search by artist here:</label>
			<input id="myArtist" type="text" placeholder="Enter artist"/>
			<input type="button" value="Search" onclick="ajaxrequest()"/>
		</p>
		<div id="response">
		</div>
	</body>
</html>

<?php
}
?>