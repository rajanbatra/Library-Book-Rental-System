<?php
    include 'dbinfo.php';
	$con = oci_connect($username, $password, $connection_string);
	session_start();
	if (!$con)
	{
	  die('Could not connect: ' . oci_error());
	}

	$cardNumber = $_GET['CardNumber'];
	$name 		= $_GET['Name'];
	$email = $_GET['Email'];
	$phonenumber = $_GET['Phonenumber'];
	$password 	= $_GET['PassWord'];
	
	$statementselect = oci_parse($con,'select *
		from "LIBRARYUSER"
		where "LIBRARYUSER".US_ID = (:cardNumber)');
	oci_bind_by_name($statementselect,":cardNumber",$cardNumber);
	// oci_bind_by_name($statementselect,':name', $name);
	// oci_bind_by_name($statementselect,':department',$department);
	// oci_bind_by_name($statementselect,':password', $password);
	$result = oci_execute($statementselect);
	// $query = mysql_query($searchCard);
	$countCard = 0;
	while($row = oci_fetch_array($statementselect))
  	{
  		$countCard = $countCard + 1;
  	}

  	if ($countCard > 0) {
  		echo "<script>alert('Pre-existing card number!')</script>";
		echo "<script language=\"javascript\">";
		echo "document.location=\"index.php\"";
		echo "</script>";
  	}
  	else {
  // 		$sqlQuery = " 	
		// 	insert into card
		// 	values (\"" .$cardNumber. "\", \"" .$name. "\", \"" .$department. "\", \"" .$password. "\")
		// ";
			// $sqlQuery = "insert into card(card_number, name, department, password) values(:card_number,:name,:department,:passWord )";
			$statement = oci_parse($con,'INSERT INTO "LIBRARYUSER" VALUES (:card_number,:name,:email,:phonenumber,:passWord )');
			oci_bind_by_name($statement,':card_number',$cardNumber);
			oci_bind_by_name($statement, ':name', $name);
			oci_bind_by_name($statement, ':email', $email);
            oci_bind_by_name($statement, ':phonenumber', $phonenumber);
			// oci_bind_by_name($statement,':department',$department);
			oci_bind_by_name($statement,':password', $password);
			$resul = oci_execute($statement,OCI_COMMIT_ON_SUCCESS);
		    oci_free_statement($statement);  

		echo "<script>alert('Create library user successfully!')</script>";
		echo "<script language=\"javascript\">";
		echo "document.location=\"index.php\"";
		echo "</script>";
		oci_close($con);

  	}
?>
