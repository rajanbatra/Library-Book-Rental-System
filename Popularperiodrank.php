<?php
date_default_timezone_set('UTC');

  include 'dbinfo.php';
  $con = oci_connect($username, $password, $connection_string);
  if (!$con)
    {
    die('Could not connect: ' . oci_error());
    }
 //-------------------number of books
 // $numofbooks=oci_parse($con,'SELECT count(*) as booknum from "BOOKWITHCATE"');
 // $r1 = oci_execute($numofbooks);
 // $row1 = oci_fetch_array($numofbooks);
 // $numofbooksresult=$row1["BOOKNUM"];

 //-------------------Subjects rank  


//--------------------frequency
$readingdays=oci_parse($con, 'SELECT *
        from (select "BORROWDATETIME", count(*) as frequency
          from "CHECKOUTRECORD"
        group by "BORROWDATETIME"
        order by count(*) desc)
        where rownum =1');

$result = oci_execute($readingdays);

  $count = 0;
  while($row = oci_fetch_array($readingdays))
  {
    $count = $count + 1;
    // $topreadday = $row["BORROWDATETIME"]->format('Y-m-d'); //origin
   
    // $topreadday=$row["BORROWDATETIME"]; //workable, but ugly timestamp
    // var_dump($row["BORROWDATETIME"]);
    $topreadday = DateTime::createFromFormat("d#M#y H#i#s*A", $row["BORROWDATETIME"])->format('Y-m-d');
    $topreaddayfre = $row["FREQUENCY"];
  }
  //---------------------
?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Popular Time Rank</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->

    <!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

  
</head>
<body>

<div class="container">
    <h1 align="center">
      Popular Time Rank
    </h1>

    <div class="flat-form">
      <ul class="tabs">
         <!--  <li>
              <a href="#file" class="active">Rank</a>
          </li> -->
          <li>
              <a href="#month" class="active">MONTH</a>
          </li>
          <li>
              <a href="#date">DATE</a>
          </li>
          <li>
              <a href="#hour">HOUR</a>
          </li>
      </ul>

    <!--   <div id="file" class="form-action show">
		<h1>Special Informations:</h1>
        <ul>
        <li style = "font-size: 24px;">Total number of books in library:</li>
        <h3>
       <?php echo $numofbooksresult;?>
       </h3>
       </ul>
			 <ul>
				<li style = "font-size: 24px;">Monthly rank:</li>

			 </ul>	
			 <ul>
				<li style = "font-size: 24px;">Top reading days</li>
			   <h3>
			 	<?php echo $topreadday;?>
        
			   </h3>
			 </ul>
       <ul>
        <li style = "font-size: 24px;">Frequency</li>
        <h3>
       <?php echo $topreaddayfre;?>
       </h3>
       </ul>
             <ul>
				<li style = "font-size: 24px;">Peak hours</li>

			 </ul>
      </div> -->

    
      <div id="month" class="form-action show">
        <h1>
          Peak Month
        </h1>
        <?php
        $rankmonth=oci_parse($con,'SELECT datemonth, count(*) as frequency from (select substr(borrowdatetime,4,3)  as datemonth from checkoutrecord)
          group by datemonth
          order by count(*) desc'
        );
        $resultrankmonth = oci_execute($rankmonth);
        $nrows = oci_fetch_all($rankmonth, $results2);
      if ($nrows > 0) {
         echo "<table border=1> ";
         echo "<tr> ";
         foreach ($results2 as $key => $val) {
            echo "<th>$key</th> ";
         }
         echo "</tr> ";

         for ($i = 0; $i < $nrows; $i++) {
            echo "<tr> ";
            foreach ($results2 as $data) {
               echo "<td>$data[$i]</td> ";
            }
            echo "</tr> ";
         }
         echo "</table> ";
      } else {
         echo "No data found<br /> ";
      }
        ?>
      </div>

      <div id="date"  class="form-action hide">
          <h1>
		    Popular Date Top 20
		  </h1>
      <?php
      $rankdate = oci_parse($con, 'select * from (select bookday, count(*) as frenquency from (select substr(borrowdatetime,1,6)  as bookday from checkoutrecord)
        group by bookday
        order by count(*) desc)
        where rownum<=20'
      );
      $resultrankdate=oci_execute($rankdate);
      $nrows = oci_fetch_all($rankdate, $results1);
      if ($nrows > 0) {
         echo "<table border=1> ";
         echo "<tr> ";
         foreach ($results1 as $key => $val) {
            echo "<th>$key</th> ";
         }
         echo "</tr> ";

         for ($i = 0; $i < $nrows; $i++) {
            echo "<tr> ";
            foreach ($results1 as $data) {
               echo "<td>$data[$i]</td> ";
            }
            echo "</tr> ";
         }
         echo "</table> ";
      } else {
         echo "No data found<br /> ";
      }
      
      ?>

        
      </div>

      <div id="hour" class="form-action hide">
        <h1>
		  Peak Hour
		</h1>
<?php
//       $ranksub=oci_parse($con,'SELECT * from(select subject, count(bibnum) as frequency from bookwithcate
// group by subject 
// order by count(subject) desc)
// where rownum<=30 and subject is not null
//       ');

$ranksub=oci_parse($con,"SELECT peakhour, count(*)as frequency from (select (substr(borrowdatetime,11,2)||' '||substr(borrowdatetime,-2,2))as peakhour from checkoutrecord) group by peakhour order by count(*) desc"
);


      $resultranksub=oci_execute($ranksub);
      $nrows = oci_fetch_all($ranksub, $results);
      if ($nrows > 0) {
         echo "<table border=1> ";
         echo "<tr> ";
         foreach ($results as $key => $val) {
            echo "<th>$key</th> ";
         }
         echo "</tr> ";

         for ($i = 0; $i < $nrows; $i++) {
            echo "<tr> ";
            foreach ($results as $data) {
               echo "<td>$data[$i]</td> ";
            }
            echo "</tr> ";
         }
         echo "</table> ";
      } else {
         echo "No data found<br /> ";
      }
      echo "$nrows Records Selected<br /> ";
      ?>
      </div>
      
    </div>
</div>
<script class="cssdeck" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
</body>


<style type="text/css">
  .file{position:absolute; top:130px; right:360px; height:40px; filter:alpha(opacity:1);opacity: 0;width:80px }
    body {
      background: #292929;
      color: white;
      font-family: 'Roboto';
    }
    .flat-form {
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

</html>

<!--@import url(http://fonts.googleapis.com/css?family=Roboto:100);
//@import url(http://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css);
--!>
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