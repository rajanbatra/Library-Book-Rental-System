<?php
	// $con = mysql_connect("localhost","root","");
	// if (!$con)
	// {
	//   die('Could not connect: ' . mysql_error());
	// }
	// mysql_select_db("my_db", $con);
	include 'dbinfo.php';
	$con = oci_connect($username, $password, $connection_string);
	session_start();
    if (!$con)
    {
    die('Could not connect: ' . oci_error());
    }

	$cardNumber = $_GET['CardNumber'];
	$bookNumber = $_GET['BookNumber'];
	$password   = $_GET['password'];
	$url = $_GET['url'];
	
    $searchBook = oci_parse($con,'select *
        from "borrow"
        where "borrow"."bibnum" = (:bookNumber)
        and "borrow".US_ID = (:cardNumber)
        and "borrow"."returndatetime"="borrow"."borrowdatetime"');
    oci_bind_by_name($searchBook,":bookNumber",$bookNumber);
    oci_bind_by_name($searchBook,":cardNumber",$cardNumber);
    $queryBook = oci_execute($searchBook);

	// $searchBook = " 	
	// 	select *
	// 	from borrow
	// 	where book_id = \"" .$bookNumber. "\" 
	// 	and card_number = \"" .$cardNumber.
	// 	"\"";


	// $queryBook = mysql_query($searchBook);

	$countBook = 0;

	while($row = oci_fetch_array($searchBook))
  	{
  		$countBook = $countBook + 1;
  	}

    if ($countBook == 0) {
		echo "<script>alert('The book has already returned!')</script>";
		echo "<script language=\"javascript\">";
		echo "document.location=\"".$url."\"";
		echo "</script>";
	}
	else {
        $updateRecord = oci_parse($con,'update "borrow"
        set "borrow"."returndatetime" = sysdate
        where "borrow"."bibnum" = (:bookNumber)
        and "borrow".US_ID = (:cardNumber)');
        oci_bind_by_name($updateRecord,":bookNumber",$bookNumber);
        oci_bind_by_name($updateRecord,":cardNumber",$cardNumber);
        $queryUpdate = oci_execute($updateRecord);

		// $updateRecord = "
		// 	update borrow
		// 	set return_date = " .date("Ymd"). " 
		// 	where book_id = \"" .$bookNumber. "\" 
		// 	and card_number = \"" .$cardNumber. "\" 
		// 	and borrow_number = \"" .$maxBorrowNumber. "\" 
		// 	";
		// mysql_query($updateRecord);

		$returnBook = oci_parse($con,'update "BOOKWITHCATE"
        set "BOOKWITHCATE".ITEMCOUNT = "BOOKWITHCATE".ITEMCOUNT + 1
        where "BOOKWITHCATE".BIBNUM = (:bookNumber)');
        oci_bind_by_name($returnBook,":bookNumber",$bookNumber);
        oci_execute($returnBook);

		// $returnBook = "
		// 	update book set stock = stock + 1
		// 	where book_id = \"" .$bookNumber. "\"
		// ";
		// mysql_query($returnBook);
		echo "<script>alert('Returned this book successfully!')</script>";
		echo "<script language=\"javascript\">";
		echo "document.location=\"".$url."\"";
		echo "</script>";
	}
	
?>