<?php
//MySQL functions

function select($sql,$mysqldbname) {
	  $mysqlservername = "localhost";
	  $mysqlusername = "root";
	  $mysqlpassword = "raspberry";
	  $mysqlconn = mysqli_connect($mysqlservername, $mysqlusername, $mysqlpassword, $mysqldbname);
	  if (!$mysqlconn) {
		die("mysqlconnection failed: " . mysqli_connect_error());
	  }
	  $result = mysqli_query($mysqlconn, $sql);
	  mysqli_close($mysqlconn);
return $result;
}


function insert($sql,$mysqldbname) {
	  $mysqlservername = "localhost";
	  $mysqlusername = "root";
	  $mysqlpassword = "raspberry";
	  $mysqlconn = mysqli_connect($mysqlservername, $mysqlusername, $mysqlpassword, $mysqldbname);
	  if (!$mysqlconn) {
		die("mysqlconnection failed: " . mysqli_connect_error());
	  }
	  
	  if (mysqli_query($mysqlconn, $sql)) {
		return false;
	  } else {
		return true;
	  }

	  mysqli_close($conn);
}
?> 



<?php 
/*
	  if (mysqli_num_rows($result) > 0) {
	  // output data of each row
	  while($row = mysqli_fetch_assoc($result)) {
	  echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	  }
	  } else {
	  echo "0 results";
	  }

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
*/
?>
