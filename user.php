<style>
body {
  background: #292929;
  color: white;
  font-family: 'Roboto';
}
.flat-form {
  position:absolute; left:0px; top:80px;
  background: #e74c3c;
  margin: 25px auto;
  width: 400px;
  height: 400px;
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
.tabs li {
  display: block;
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
  padding: 12px 22px 11px 20px
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
  width: 100%;
  height: 40px;
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
    border: none;
    display: block;
    background: #136899;
    height: 40px;
    width: 80px;
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
  session_start();
  // mysql_select_db("my_db", $con);
 /* $create_admin = "CREATE TABLE admin 
  (
    username  varchar(20),
    password varchar(20),
    PRIMARY KEY (username)
  )";
  mysql_query($create_admin);
*/
  $Username = $_GET['username'];
  $Password = $_GET['password'];
  //$Username = "'".$Username_o."'";
        
  $adminstatement = oci_parse($con,'select *
        from "LIBRARYUSER"
        where "LIBRARYUSER".US_ID = (:Username)');
  oci_bind_by_name($adminstatement,":Username",$Username);
  $result = oci_execute($adminstatement);

  $count = 0;

  while($row = oci_fetch_array($adminstatement))
  {
    $count = $count + 1;
    //if ($row['card_number']==$Username)
    $rightPassword = $row['password'];
		$name = $row['name'];
    $email = $row['email'];
    $phonenumber = $row['phonenumber'];		
  }
  

  $searchCard = oci_parse($con,'select *
        from "borrow"
        where "borrow".US_ID = (:Username)
        and "borrow"."returndatetime" = "borrow"."borrowdatetime"');
  oci_bind_by_name($searchCard,":Username",$Username);
  $result = oci_execute($searchCard);

   // $searchCard = "
		// select *
		// from borrow
		// where borrow.card_number = ".$Username." and borrow.return_date = 0";
  // $res = mysql_query($searchCard);
  $total = 0;
  while($row = oci_fetch_array($searchCard))
  {
    $total = $total + 1;
	if ($Password == $rightPassword)
	{ 
		echo "<script>alert('Log in successfully!')</script>";		
	}
  elseif ($count == 0) {
    echo "<script>alert('Inexistent username')</script>";
    echo "<script language=\"javascript\">";
    echo "document.location=\"index\"";
    echo "</script>";
  }
	else {
		echo "<script>alert('Wrong password!')</script>";
		echo "<script language=\"javascript\">";
		echo "document.location=\"index\"";
		echo "</script>";	
	}	
	$s = "123";
?>
<style>
/*.clearfix{ #zoom:1;}
.clearfix:after{ content:' '; display:block; height:0; clear:both; color:#fff;}*/
.breathe-btn{ position:relative; width:400px; height:40px; margin:40px auto; 
line-height:40px; border:1px solid #2b92d4; 
border-radius:5px; 
color:#fff; font-size:20px; 
font-weight :bold;
text-align:center; cursor:pointer; 
box-shadow:0 1px 2px rgba(0,0,0,.3); 
overflow:hidden; 
background-image: /*-webkit-gradient(linear, left top, left bottom, from(#292929), to(#21a1d0));*/
    -webkit-animation-timing-function: ease-in-out;
    -webkit-animation-name: breathe;
    -webkit-animation-duration: 2700ms;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-direction: alternate;
}
@-webkit-keyframes breathe {
    0% { opacity: .2; box-shadow:0 1px 2px rgba(255,255,255,0.1);}
    100% { opacity: 1; border:1px solid rgba(59,235,235,1); box-shadow:0 1px 30px rgba(59,255,255,1);}
}
body {
  background: #292929;
  color: white;
  font-family: 'Roboto';
}
.flat-form_q {
 position:absolute; left:0px; top:80px;
      background: #e74c3c;
      margin: 25px auto;
      width: 500px;
      height: 800px;
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
.tabs li {
      display: block;
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
      padding: 11px 22px 11px 20px;
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
    border: none;
    display: block;
    background: #136899;
    height: 40px;
    width: 80px;
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
	// some code
    // session_start();
  $url = $_SERVER['REQUEST_URI'];
 // echo $url;
  // mysql_select_db("my_db", $con);
	// $create_book = "CREATE TABLE book 
	// (
	// 	book_id  varchar(20),
	// 	kind varchar(20),
	// 	book_name varchar(40),
	// 	press varchar(40),
	// 	year int,
	// 	author varchar(20),
	// 	price double(8,2),
	// 	total int,
	// 	stock int,
	// 	PRIMARY KEY (book_id)
	// )";
	// mysql_query($create_book);

	// $create_card = " CREATE TABLE card
	// (
	// 	card_number varchar(20),
	// 	name varchar(20),
	// 	department varchar(50),
	// 	password varchar(10),
	// 	PRIMARY KEY (card_number)
	// )";
	// mysql_query($create_card);

	// $create_borrow = " CREATE TABLE borrow
	// (
	// 	borrow_number varchar(20),
	// 	book_id varchar(20),
	// 	card_number varchar(20),
	// 	borrow_date date,
	// 	return_date date,
	// 	PRIMARY KEY (borrow_number),
	// 	FOREIGN KEY (book_id) REFERENCES book(book_id),
	// 	FOREIGN KEY (card_number) REFERENCES card(card_number)
	// )";
	// mysql_query($create_borrow);
	
	
?>
<html>
<body>

<div class = "breathe-btn"> Library Database </div>
<div class="container">
        <div class="flat-form_q" >
            <ul class="tabs">
                <li>
                    <a href="#login" class="active">Query</a>
                </li>
                <li>
                    <a href="#register">Card_info</a>
                </li>
                <li>
                    <a href="#reset">Return</a>
                </li>
				<li>
				    <a href="#potential">Recommend</a>
				</li>
            </ul>
            <div id = "login" class="form-action show">
				<form action="2.php" method="get" >
				<h2>Search books:</h2>
					<ul>
						<li> Year </li>
						<li> From <input type="text" name="yearstart"> To <input type="text" name="yearend"> </li>
					</ul>
					<ul>
						<li> Author name:	</li>
						<li> <input type="text_long" name="authorname"> </li>
					</ul>
					<ul>
						<li> Title:	</li>
						<li> <input type="text_long" name="bookname"> </li>
					</ul>
					<ul>
						<li><input type="submit" value = "search" style=" font-size: 14px;"class = "button"></li>
					</ul>
          <input type = "hidden" name = "CardNumber" value = "<?php echo $Username;?>"/>
          <input type = "hidden" name = "password" value = "<?php echo $Password;?>" />
				</form>
			</div>

	<div id="register" class="form-action hide">
		<form action="showCard.php" method="get" />
			<h2>Your Account Information:</h2>
			<ul>
				<li style = "font-size: 24px;" > UserID: </li> 
				<h3> <?php echo $Username;?> </h3>
			</ul>
			<ul>
				<li style = "font-size: 24px;">Name: </li>
			</ul>
			<ul>
			 <h3>
				 <?php echo $name;?>
								</h3>
			</ul>
			 <ul>
				<li style = "font-size: 24px;">Borrowed number:</li>
			 <h3>
			 	<?php echo $total;?>
			 					</h3>
			 </ul>	
		</form>
	</div>
	
	<div id="reset" class="form-action hide">
			<form action="userReturn.php" method="get" >
				<h2> Return Books: </h2>
				<ul>
					<input type = "hidden" name = "CardNumber" value = "<?php echo $Username;?>"/>
					<input type = "hidden" name = "Password" value = "<?php echo $Password;?>"/>
					<input type = "hidden" name = "url" value = "<?php echo $url;?>" />
				</ul>
				<ul>
					<li> Book Number: </li>
					<li> <input type = "text_long" name = "BookNumber" /> </li>
				</ul>
				<ul>
					<input type="submit"  value = "return" style=" font-size: 14px;" class = "button"/>
				</ul>
			</form>
			<form action="showCard.php" method="get" >
				<h2> Search The book Your borrow: </h2>
				<ul>
					<input type = "hidden" name = "CardNumber" value = "<?php echo $Username;?>"/>
           <input type = "hidden" name = "password" value = "<?php echo $Password;?>" />
				</ul>
				<ul>
					<input type="submit"  value = "search" style=" font-size: 14px;" class = "button"/>
				</ul>
			</form>
	</div>

	<div id="potential" class="form-action hide">
		<form action="showCard.php" method="get" />
			<h2>Library Profile</h2>
			<ul>
      	<h3> <?php 
          $numofbooks=oci_parse($con,'SELECT count(*) as booknum from "BOOKWITHCATE"');
          $r1 = oci_execute($numofbooks);
          $row1 = oci_fetch_array($numofbooks);
          $numofbooksresult=$row1["BOOKNUM"];
          echo "<li style = \"font-size : 24px;\"> Total Books Amount:";
          echo $numofbooksresult."</li>";
          ?> 
        </h3>
			</ul>
      <ul>
        <li style = "font-size: 24px;"> <a href="http://our.library.com/bookrank">Library Stock Profile</a> </li>
      </ul>

			<h2>Checkout Record Analysis 2016</h2>
			 <ul>
         <h3> <?php 
          $numofrecords=oci_parse($con,'SELECT count(*) as recordnum from "CHECKOUTRECORD"');
          $r2 = oci_execute($numofrecords);
          $row2 = oci_fetch_array($numofrecords);
          $numofrecordsresult=$row2["RECORDNUM"];
          echo "<li style = \"font-size : 24px;\"> Total Records Amount:";
          echo $numofrecordsresult."</li>";
          ?> </li>
        </h3>
      </ul>

      <ul>
        <li style = "font-size: 24px;"> <a href="http://our.library.com/toppopular">Popular Books Rank</a> </li>
			</ul>
			<ul>
        <li style = "font-size: 24px;"><a href="http://our.library.com/popularperiodrank"> Popular Time Rank</a> </li>
			</ul>

      <h2>Tell me the total number of tuples!</h2>
      <ul>
        <li style = "font-size: 24px;"><a href="http://our.library.com/totaltuples"> Total Tuple Number</a> </li>
      </ul>

		</form>
	</div>

  </div>
</div>

    <script class="cssdeck" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
</body>
</html>
<script language="JavaScript">
(function ( $ ) {
  // constants
  var SHOW_CLASS = 'show',
      HIDE_CLASS = 'hide',
      ACTIVE_CLASS = 'active';
  
  $( '.tabs' ).on( 'click', 'li a', function(e){
    e.preventDefault();
    var $tab = $( this ),
         href = $tab.attr( 'href' );
  
     $( '.active' ).removeClass( ACTIVE_CLASS );
     $tab.addClass( ACTIVE_CLASS );
  
     $( '.show' )
        .removeClass( SHOW_CLASS )
        .addClass( HIDE_CLASS )
        .hide();
    
      $(href)
        .removeClass( HIDE_CLASS )
        .addClass( SHOW_CLASS )
        .hide()
        .fadeIn( 550 );
  });
})( jQuery );
</script>
<script src="/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
  $(".flip").click(function(){
    $(".panel").slideDown("slow");
  });
});
</script>
