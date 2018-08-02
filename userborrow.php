<?php
	// $con = mysql_connect("localhost","root","");
	// session_start();
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

	$url = $_GET['url'];
	$cardNumber = $_GET['CardNumber'];
	$bookNumber = $_GET['BookNumber'];
	$borrowDate = date('Y-m-d');
	$returnDate = date('Y-m-d');

	$searchBook = oci_parse($con,'select *
        from bookwithcate
        where "BIBNUM" = (:bookNumber)');
    oci_bind_by_name($searchBook,":bookNumber",$bookNumber);
    $queryStock = oci_execute($searchBook);

	$countStock = 0;
	while($row = oci_fetch_array($searchBook))
  	{
  		$countStock = $row['ITEMCOUNT'];
  	}

   if ($countStock == 0) {
		echo "<script>alert('This book has no stock now!')</script>";
		echo "<script language=\"javascript\">";
		echo "document.location=\"".$url."\"";
		echo "</script>";
	}
	else {
		$updateBook = oci_parse($con,'update "BOOKWITHCATE"
        set "BOOKWITHCATE".ITEMCOUNT = "BOOKWITHCATE".ITEMCOUNT - 1
        where "BOOKWITHCATE".BIBNUM = (:bookNumber)');
        oci_bind_by_name($updateBook,":bookNumber",$bookNumber);
        $queryUpdate = oci_execute($updateBook);

		// $updateBook = "
		// 	update book
		// 	set stock = stock - 1
		// 	where book_id = \"" .$bookNumber. 
		// "\"";
		// mysql_query($updateBook);

		$searchBorrow = oci_parse($con,'select * from "borrow"');
        $queryBorrow = oci_execute($searchBorrow);

		// $searchBorrow = "
		// 	select *
		// 	from borrow
		// ";
		// $queryBorrow = mysql_query($searchBorrow);
		$countBorrow = 1;
		while($row = oci_fetch_array($searchBorrow))
	  	{
	  		$countBorrow = $countBorrow + 1;
	  	}

        $borrowBook = oci_parse($con,'INSERT INTO "borrow" VALUES (:bibnum,
        	sysdate,
        	sysdate,
         	:US_ID)');
			oci_bind_by_name($borrowBook,':bibnum',$bookNumber);
			// oci_bind_by_name($borrowBook, ':borrowdatetime', $borrowDate);
			// oci_bind_by_name($borrowBook, ':returndatetime', $returnDate);
            oci_bind_by_name($borrowBook, ':US_ID', $cardNumber);
			$resul = oci_execute($borrowBook,OCI_COMMIT_ON_SUCCESS);
		    oci_free_statement($borrowBook);  
		    // if(oci_num_rows){  

		// $borrowBook = "
		// 	insert into borrow 
		// 	values (\"" .$countBorrow. "\", \"" .$bookNumber. "\", \"" .$cardNumber. "\", " .$borrowDate. "
		// 	, 0)";
		// //echo $borrowBook;
		// mysql_query($borrowBook);
		echo "<script>alert('Borrowed this book successfully!')</script>";
		echo "<script language=\"javascript\">";
		echo "document.location=\"".$url."\"";
		echo "</script>";
	}
?>
