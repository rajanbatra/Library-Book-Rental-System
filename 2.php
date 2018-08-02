<link href="./style1.css" rel="stylesheet">
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="utf8"/>
</head>

<?php
session_start();
// $con = mysql_connect("localhost","root","");
// 	if (!$con)
// 	  {
// 	  die('Could not connect: ' . mysql_error());
// 	  }
  include 'dbinfo.php';
$con = oci_connect($username, $password, $connection_string);
  if (!$con)
    {
    die('Could not connect: ' . oci_error());
    }
	else echo "<script>alert('searched successfully!')</script>";
 
	// some code
	
	// mysql_query("set CHARACTER SET utf8");
	$url = $_SERVER['REQUEST_URI'];
$p = 1;
// if ($_GET["orderby"] == "")
// 	$order = " order by book_name";
// else $order = " order by ".$_GET["orderby"];
$x = $_GET["yearstart"];
$y = $_GET["yearend"];
$z = $_GET["bookname"];
$w = $_GET["authorname"];
if ($x == "") $x = 0;
if ($y == "") $y = 2019;

	// $sql = "select * 
	// 			from "BOOKWITHCATE"
	// 			where year between ".$x." and ".$y.$order;
if($z == "") {$z = "%%";}
  else $z = "%".$_GET["bookname"]."%";

if ($w == "") {$w = "%%";}
  else $w = "%".$_GET["authorname"]."%";

$yearsql = oci_parse($con,'SELECT bibnum,title,itemcount FROM bookwithcate WHERE "PUBLICATIONYEAR">=(:startyear) 
   AND "PUBLICATIONYEAR"<=(:endyear) 
   AND "TITLE" like (:bookname)
   AND "AUTHOR" like (:authorname) 
   ORDER BY "PUBLICATIONYEAR"');
  
  oci_bind_by_name($yearsql, ":startyear", $x);
  oci_bind_by_name($yearsql, ":endyear", $y);
  oci_bind_by_name($yearsql, ":bookname",$z);
  oci_bind_by_name($yearsql, ":authorname",$w);
  $resu=oci_execute($yearsql);
	// $result= mysql_query($sql);
  echo "<h1 align=\"center\">
          Library Database
        </h1>
          <div class=\"container\">
            <div class=\"flat-form_q\">";
              
  echo "<div class = \"breathe-btn\"> The books searched</div>";
 // oci_fetch_all($yearsql, $results);
    
  while($nrows = oci_fetch_array($yearsql))  {
    echo "<div id = \"login\" class=\"form-action show\">";
   
    echo "<form action=\"userborrow.php\" method=\"get\">";

    echo "<ul>";
    

    echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">NO.";
    echo $p."</li>";
    echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Number:</li>";
    $book_id_now = $nrows['BIBNUM']; 
    echo $book_id_now;
    echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Name:</li>";
    echo iconv("UTF-8", "GB2312", $nrows['TITLE']);
    echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Numbers In stock:</li>";
    echo $nrows['ITEMCOUNT'];
    $CardNumber = $_GET['CardNumber'];
    echo "<input type = \"hidden\" name = \"CardNumber\" value = $CardNumber \>";
    echo "<input type = \"hidden\" name = \"BookNumber\" value = $book_id_now \>";
    echo "<input type = \"hidden\" name = \"url\" value = $url \>";
    echo "<input style = \"font-size :13px; \" type=\"submit\" value = \"borrow it\" class = \"button\">";
    echo "</ul>";
    echo "</form>";
    echo "</div>";
    $p++;
    if ($p>50) break;
  }

   echo "<div id = \"login\" class=\"form-action show\">";
   
    echo "<form action=\"user.php\" method=\"get\">";

    echo "<ul>";
     echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Finally,";
    echo "</li>";
    echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Return to the User Page</li>";
    $CardNumber = $_GET['CardNumber'];
    $Password = $_GET['password'];
    echo "<input type = \"hidden\" name = \"username\" value = $CardNumber \>";
     echo "<input type = \"hidden\" name = \"password\" value = $Password \>";
    echo "<input type = \"hidden\" name = \"url\" value = $url \>";
    echo "<input style = \"font-size :13px; \" type=\"submit\" value = \"Return\" class = \"button\">";
    echo "</ul>";
    echo "</form>";
    echo "</div>";

	// while($row = oci_fetch_array($resu))
 //  {   
 //    var_dump($row);
 //  echo "<div id = \"login\" class=\"form-action show\">";
 
 //  echo "<form action=\"userborrow.php\" method=\"get\">";
 
 //  echo "<ul>";
  
 //  echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">NO.";
 //  echo $p."</li>";
 //  echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Number:</li>";
 //  echo $row['BIBNUM'];
 //  $book_id_now = $row['BIBNUM']; 
 //  echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Name:</li>";
 //  echo iconv("UTF-8", "GB2312", $row['TITLE']);
 //  echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Numbers In stock:</li>";
 //  echo $row['ITEMCOUNT'];
 //  $CardNumber = $_SESSION['US_ID'];
 //  echo "<input type = \"hidden\" name = \"CardNumber\" value = $CardNumber \>";
 //  echo "<input type = \"hidden\" name = \"BookNumber\" value = $book_id_now \>";
 //  echo "<input type = \"hidden\" name = \"url\" value = $url \>";
 //  echo "<input style = \"font-size :13px; \" type=\"submit\" value = \"borrow it\" class = \"button\">";
 //  echo "</ul>";
 //  echo "</form>";
 //  echo "</div>";
 //  $p++;
 //  if ($p>50) break;
 //  }
// $nrows = oci_fetch_all($yearsql, $results);
// if ($nrows > 0) {
//    echo "<table border=1> ";
//    echo "<tr> ";
//    foreach ($results as $key => $val) {
//       echo "<th>$key</th> ";
//    }
//    echo "</tr> ";

//    for ($i = 0; $i < $nrows; $i++) {
//       echo "<tr> ";
//       foreach ($results as $data) {
//          echo "<td>$data[$i]</td> ";
//       }
//       echo "</tr> ";
//    }
//    echo "</table> ";
// } else {
//    echo "No data found<br /> ";
// }
// echo "$nrows Records Selected<br /> ";

 
// $y = "'".$_GET["bookname"]."'";
// 	$sql = "select * 
// 				from book
// 				where book_name = ".$y.$order;
// 	$result= mysql_query($sql);
// 	while($row = mysql_fetch_array($result))
//   {
//      echo "<div id = \"login\" class=\"form-action show\">";
 
//   echo "<form action=\"userborrow.php\" method=\"get\">";
 
//   echo "<ul>";
  
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">NO.";
//   echo $p."</li>";
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Number:</li>";
//   echo $row['book_id'];
//   $book_id_now = $row['book_id']; 
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Name:</li>";
//   echo iconv("UTF-8", "GB2312//IGNORE", $row['book_name']);
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Numbers In stock:</li>";
//   echo $row['stock'];
//   $CardNumber = $_SESSION['CardNumber'];
//   echo "<input type = \"hidden\" name = \"CardNumber\" value = $CardNumber \>";
//   echo "<input type = \"hidden\" name = \"BookNumber\" value = $book_id_now \>";
//   echo "<input type = \"hidden\" name = \"url\" value = $url \>";
//   echo "<input style = \"font-size :13px; \" type=\"submit\" value = \"borrow it\" class = \"button\">";
//   echo "</ul>";
//   echo "</form>";
//   echo "</div>";
//   $p++;
//   if ($p>50) break;
//   }
  
 
//   $y = "'".$_GET["authorname"]."'";
// 	$sql = "select * 
// 				from book
// 				where author = ".$y.$order;
// 	$result= mysql_query($sql);
// 	while($row = mysql_fetch_array($result))
//   {
//    echo "<div id = \"login\" class=\"form-action show\">";
 
//   echo "<form action=\"userborrow.php\" method=\"get\">";
 
//   echo "<ul>";
  
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">NO.";
//   echo $p."</li>";
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Number:</li>";
//   echo $row['book_id'];
//   $book_id_now = $row['book_id']; 
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Name:</li>";
//   echo iconv("UTF-8", "GB2312", $row['book_name']);
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Numbers In stock:</li>";
//   echo $row['stock'];
//   $CardNumber = $_GET['CardNumber'];
//   echo "<input type = \"hidden\" name = \"CardNumber\" value = $CardNumber \>";
//   echo "<input type = \"hidden\" name = \"BookNumber\" value = $book_id_now \>";
//   echo "<input type = \"hidden\" name = \"url\" value = $url \>";
//   echo "<input style = \"font-size :13px; \" type=\"submit\" value = \"borrow it\" class = \"button\">";
//   echo "</ul>";
//   echo "</form>";
//   echo "</div>";
//   $p++;
//   if ($p>50) break;
//   }
 
//   $y = "'".$_GET["kind"]."'";
// 	$sql = "select * 
// 				from book
// 				where kind = ".$y.$order;
// 	$result= mysql_query($sql);
// 	while($row = mysql_fetch_array($result))
//   {
//    echo "<div id = \"login\" class=\"form-action show\">";
 
//   echo "<form action=\"userborrow.php\" method=\"get\">";
 
//   echo "<ul>";
  
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">NO.";
//   echo $p."</li>";
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Number:</li>";
//   echo $row['book_id'];
//   $book_id_now = $row['book_id']; 
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Name:</li>";
//   echo iconv("UTF-8", "GB2312", $row['book_name']);
//   echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Numbers In stock:</li>";
//   echo $row['stock'];
//   $CardNumber = $_GET['CardNumber'];
//   echo "<input type = \"hidden\" name = \"CardNumber\" value = $CardNumber \>";
//   echo "<input type = \"hidden\" name = \"BookNumber\" value = $book_id_now \>";
//   echo "<input type = \"hidden\" name = \"url\" value = $url \>";
//   echo "<input style = \"font-size :13px; \" type=\"submit\" value = \"borrow it\" class = \"button\">";
//   echo "</ul>";
//   echo "</form>";
//   echo "</div>";
//   $p++;
//   if ($p>50) break;
//   }  
//     echo("
//             </div>
//           </div>")
// ;
//echo $x;
//echo $y;
?>
<html>
<body>

<body>
<html>