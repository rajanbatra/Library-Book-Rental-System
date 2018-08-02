
<?php

$conn = oci_connect('YYU', '31415Zhang', 'oracle.cise.ufl.edu:1521/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM bookwithcate where rownum<=5');
$r = oci_execute($stid);
// oci_fetch_all($stid, $res);
// var_dump($res);


$nrows = oci_fetch_all($stid, $results);
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


// $stid1 = oci_parse($conn, 'SELECT * FROM "CHECKOUTRECORD" where rownum<=5');
// $r = oci_execute($stid1);
// oci_fetch_all($stid1, $res1);
// var_dump($res1);

// Free the statement identifier when closing the connection
oci_free_statement($stid);
// oci_free_statement($stid1);
oci_close($conn);

?> 


 <!-- <?php       
        //设置绑定变量的取值
       $cardNumber="1234";
       $name = "101234";
       $department = "1234";
       $password = "1234";

       $conn = oci_connect('YYU', '31415Zhang', 'oracle.cise.ufl.edu:1521/orcl');
       if (!$conn) {
             $e = oci_error();
             trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
       }
       // $query = "INSERT INTO card
       //  VALUES(:card_number,:name,:department,:password)";
      $stid = oci_parse($conn, 'SELECT * FROM "card" where rownum<=5');
      $r = oci_execute($stid);
      oci_fetch_all($stid, $res);
      var_dump($res);
      oci_free_statement($stid);

       $statement=oci_parse($conn, 'INSERT INTO "card" VALUES(:card_number,:name,:department,:password)');

        oci_bind_by_name($statement,":card_number",$cardNumber);
		oci_bind_by_name($statement, ':name', $name);
		oci_bind_by_name($statement,':department',$department);
		oci_bind_by_name($statement,':password', $password);
       //执行语句
       $resul = oci_execute($statement);
       // //取得结果数据
       // oci_fetch_all($statement, $res1);
       // foreach($res1 as $rows){
       //     echo " ";
       //     foreach($rows as $col_values){
       //     echo $col_values;   
       //     }
       // }
       //释放资源
       oci_free_statement($statement);
       oci_close($conn);
       ?> -->