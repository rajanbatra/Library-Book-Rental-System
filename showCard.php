<style>
.clearfix{ #zoom:1;}
.clearfix:after{ content:' '; display:block; height:0; clear:both; color:#fff;}
.breathe-btn{ position:relative; width:400px; height:35px; 
  margin:40px auto; line-height:40px; b
   order:1px solid #2b92d4; 
    color:#494949; 
   font-size:20px; text-align:center; 
   cursor:pointer; box-shadow:0 1px 2px rgba(0,0,0,.3); 
   overflow:hidden; 
   background-image: -webkit-gradient(linear, left top, left bottom, from(#292929), to(#e74c3c));
    -webkit-animation-timing-function: ease-in-out;
    -webkit-animation-name: breathe;
    -webkit-animation-duration: 4000ms;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-direction: alternate;
}
.breathe-btn2{ position:relative; width:300px; height:35px; 
  margin:40px auto; line-height:40px; b
   order:1px solid #2b92d4; 
    color:#494949; 
   font-size:20px; text-align:center; 
   cursor:pointer; box-shadow:0 1px 2px rgba(0,0,0,.3); 
   overflow:hidden; 
   background-image: -webkit-gradient(linear, left top, left bottom, from(#292929), to(#e74c3c));
    -webkit-animation-timing-function: ease-in-out;
    -webkit-animation-name: breathe;
    -webkit-animation-duration: 4000ms;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-direction: alternate;
}
@-webkit-keyframes breathe {
    0% { opacity: .2; box-shadow:0 1px 2px rgba(255,255,255,0.1);}
    100% { opacity: 1; border:1px solid rgba(59,235,235,1); box-shadow:0 1px 30px rgba(59,255,255,0.3);}
}
body {
  background: #292929;
  color: white;
  font-family: 'Roboto';
}
.flat-form_q {
  background: #e74c3c;
  margin: 25px auto;
  width: 400px;
  height: 1600px;
  position: relative;
  font-family: 'Roboto';
}
.flat-form_b {
  background: #e74c3c;
  margin: 25px auto;
  width: 390px;
  height: 340px;
  position: relative;
  font-family: 'Roboto';
}
.flat-form_c {
  background: #e74c3c;
  margin: 25px auto;
  width: 390px;
  height: 340px;
  position: relative;
  font-family: 'Roboto';
}
.tabs {
  background: #c0392b;
  height: 40px;
  margin: 0;
  padding: 0;
  list-style-type: none;
  width: 100%;
  position: relative;
  display: block;
  margin-bottom: 20px;
}
ul{background:#C31B0D;
  padding-left: 20px;
  padding-bottom: 10px;
  padding-right: 10px;
  padding-top: 10px;
   -webkit-transition: all ease .3s;  
    transition: all ease .3s 
}
ul:hover{
-webkit-transform: scale(1.05);  
    transform: scale(1.05);  
    box-shadow: 0px 0px 18px rgba(0,0,0,.5);
}
.tabs li {
  display: block;
  height 15px;
  float: left;
  margin: 0;
  padding: 0;
}
.tabs a {
  background: #c0392b;
  display: block;
  float: left;
  text-decoration: none;
  color: white;
  font-size: 16px;
  padding: 15px 25px 15px 27px;
  /*border-right: 1px solid @tab-border;*/
}
.tabs li:last-child a {
  border-right: none;
  width: 174px;
  padding-left: 0;
  padding-right: 0;
  text-align: center;
}

.tabs a.active {
  background: #e74c3c;
  border-right: none;
  -webkit-transition: all 0.5s linear;
  -moz-transition: all 0.5s linear;
  transition: all 0.5s linear;
}
.form-action {
  padding: 0 20px;
  position: relative;
}

.form-action h1 {
  font-size: 42px;
  padding-bottom: 10px;
}
.form-action p {
  font-size: 12px;
  padding-bottom: 10px;
  line-height: 25px;
}
form {
  padding-right: 20px !important;
}
form input[type=text],
form input[type=password],
form input[type=submit] {
  font-family: 'Roboto';
}

form input[type=text],
form input[type=password] {
  width: 35%;
  height: 30px;
  margin-bottom: 10px;
  padding-left: 15px;
  background: #fff;
  border: none;
  color: #e74c3c;
  outline: none;
}

form input[type=text_long] {
  width: 95%;
  height: 30px;
  margin-bottom: 10px;
  padding-left: 15px;
  background: #fff;
  border: none;
  color: #e74c3c;
  outline: none;
}
.dark-box {
  background: #5e0400;
  box-shadow: 1px 3px 3px #3d0100 inset;
  height: 40px;
  width: 50px;
}
.form-action .dark-box.bottom {
  position: absolute;
  right: 0;
  bottom: -24px;
}
.tabs + .dark-box.top {
  position: absolute;
  right: 0;
  top: 0px;
}
.show {
  display: block;
}
.hide {
  display: none;
}

.button {
    position:absolute;
    top: 50px; 
    right:50px; 
    border: none;
    display: block;
    background: #136899;
    height: 40px;
    width: 70px;
    color: #ffffff;
    text-align: center;
    border-radius: 5px;
    /*box-shadow: 0px 3px 1px #2075aa;*/
    -webkit-transition: all 0.15s linear;
    -moz-transition: all 0.15s linear;
    transition: all 0.15s linear;
}

.button:hover {
  background: #1e75aa;
  /*box-shadow: 0 3px 1px #237bb2;*/
}

.button:active {
  background: #136899;
  /*box-shadow: 0 3px 1px #0f608c;*/
}

::-webkit-input-placeholder {
  color: #e74c3c;
}
:-moz-placeholder {
  /* Firefox 18- */
  color: #e74c3c;
}
::-moz-placeholder {
  /* Firefox 19+ */
  color: #e74c3c;
}
:-ms-input-placeholder {
  color: #e74c3c;
}
</style>
<?php
  include 'dbinfo.php';
  $con = oci_connect($username, $password, $connection_string);
	if (!$con)
	  {
	  die('Could not connect: ' . oci_error());
	  }
	else echo "<script>alert('searched successfully!')</script>";
	
		$cardNumber = $_GET['CardNumber'];
// 	$sqlQuery = " 	
// 		select *
// 		from book, borrow
// 		where borrow.card_Number = " .$cardNumber.
// 		" and book.book_id = borrow.book_id
// 		and borrow.return_date = 0
// 	";
	//echo $sqlQuery;
	$checkuser=oci_parse($con,'
SELECT * FROM "BOOKWITHCATE", "borrow" where "borrow"."US_ID" =(:userid)
    AND "BOOKWITHCATE"."BIBNUM" = "borrow"."bibnum" 
    and "borrow"."returndatetime" = "borrow"."borrowdatetime"');
	oci_bind_by_name($checkuser, ":userid",$cardNumber);
	$result = oci_execute($checkuser);
 	 // $nrows = oci_fetch_all($checkuser, $results);
   //    if ($nrows > 0) {
   //       echo "<table border=1> ";
   //       echo "<tr> ";
   //       foreach ($results as $key => $val) {
   //          echo "<th>$key</th> ";
   //       }
   //       echo "</tr> ";
   //       for ($i = 0; $i < $nrows; $i++) {
   //          echo "<tr> ";
   //          foreach ($results as $data) {
   //             echo "<td>$data[$i]</td> ";
   //          }
   //          echo "</tr> ";
   //       }
   //       echo "</table> ";
   //    } else {
   //       echo "No data about the user is found.<br /> ";
   //    }
   //    echo "$nrows Records Selected<br /> ";
  	
  /*
  while($row = mysql_fetch_array($result))
  {
    echo $row['book_name'];
  }*/
	/*echo $query;
	echo "Card Number: ";
	echo "<br />";
	echo $cardNumber;
	echo "<br /><br />Books Borrowed:<br />";
	while($row = mysql_fetch_array($query))
	{
		echo " \"";
		echo $row['book_name'];
		echo "\" <br />";
	}
	echo "<br />"*/
	$url = $_SERVER['REQUEST_URI'];
$p = 1;
  echo "<h1 align=\"center\">
          Library Database
        </h1>
          <div class=\"container\">
            <div class=\"flat-form_q\">";
              
              echo "<div class = \"breathe-btn\"> The books This card borrow</div>";
	while($row = oci_fetch_array($checkuser))
  {   
  echo "<div id = \"login\" class=\"form-action show\">";
 
  echo "<form action=\"userReturn.php\" method=\"get\">";
 
  echo "<ul>";
  
  echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">NO.";
  echo $p."</li>";
  echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Number:</li>";
  $book_id_now = $row['BIBNUM'];
  echo $book_id_now;
  echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Book Name:</li>";
  echo $row['TITLE'];
  echo "<li style = \"font-size :18px; font-weight:bold; color:#C8C8C8\">Numbers In stock:</li>";
  echo $row['ITEMCOUNT'];
  $CardNumber = $_GET['CardNumber'];
  $Password = $_GET['password'];
  echo "<input type = \"hidden\" name = \"CardNumber\" value = $CardNumber \>";
  echo "<input type = \"hidden\" name = \"BookNumber\" value = $book_id_now \>";
  echo "<input type = \"hidden\" name = \"password\" value = $Password \>";
  echo "<input type = \"hidden\" name = \"url\" value = $url \>";
  echo "<input style = \"font-size :13px; \" type=\"submit\" value = \"return it\" class = \"button\">";
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

      echo("
            </div>
          </div>")
;
?>

<html>
<body>

</body>
</html>
