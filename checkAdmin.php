<?php
  include 'dbinfo.php';
  $con = oci_connect($username, $password, $connection_string);
  if (!$con)
  {
    die('Could not connect: ' . oci_error());
  }
 
session_start();
  $Username = $_GET['username'];
  $Password = $_GET['password'];

  
  $adminstatement = oci_parse($con, 'select * from "ADMINUSER" where "ADMINUSER".AD_ID = (:Username)');
  oci_bind_by_name($adminstatement,":Username",$Username);
  $result = oci_execute($adminstatement);

  $count = 0;

  while($row = oci_fetch_array($adminstatement))
  {
    $count = $count + 1;
    $rightPassword = $row['password'];
  }

	if ($Password == $rightPassword)
	{ 
		$_SESSION['CardNumber'] = $Username;
		echo "<script>alert('Log in successfully!')</script>";
		echo "<script language=\"javascript\">";
		echo "document.location=\"admin.php\"";
		echo "</script>";
	}
  elseif ($count == 0) {
    echo "<script>alert('Inexistent username')</script>";
    echo "<script language=\"javascript\">";
    echo "document.location=\"index.php\"";
    echo "</script>";
  }
	else {
		echo "<script>alert('Wrong password!')</script>";
		echo "<script language=\"javascript\">";
		echo "document.location=\"index.php\"";
		echo "</script>";
		
	}
?>
