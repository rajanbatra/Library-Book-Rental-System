<?php
  $con = mysql_connect("localhost","root","");
  if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }
  mysql_select_db("my_db", $con);
    mysql_query("SET CHARACTER SET utf8");
  $filename = $_FILES['file']['tmp_name']; 
  if (empty ($filename)) { 
    echo '<script>alert("请选择要导入的CSV文件！");</script>'; 
    //echo 'self.close(); ';
  } 
  $handle = fopen($filename, 'r'); 
  $result = input_csv($handle);
  $len_result = count($result); 
  if($len_result==0){ 
    echo '<script>alert("没有任何数据！");</script>'; 
    //echo 'self.close(); ';
  } 
  $data_values = "";
  for ($i = 1; $i < $len_result; $i++) {
    $isbn = $result[$i][0];
    $category = iconv("GB2312", "UTF-8", $result[$i][1]); 
    $name = iconv("GB2312", "UTF-8", $result[$i][2]); 
	$publisher = iconv("GB2312", "UTF-8", $result[$i][3]);
	$year = intval($result[$i][4]);
	$author = iconv("GB2312", "UTF-8", $result[$i][5]);
	$price = $result[$i][6];
	$stock = $result[$i][7];
    $data_values .= "('$isbn', '$category', '$name', '$publisher', $year, '$author', $price, $stock, $stock),"; 
  } 
  $data_values = substr($data_values, 0, -1);
  fclose($handle); 
  echo $data_values;
  $query = mysql_query("insert into book (book_id, kind, book_name, press, year, author, price, total, stock) values $data_values");
  if($query){ 
      echo '<script>alert("导入成功！");</script>'; 
      //echo 'self.close(); ';
  } else { 
      echo '<script>alert("导入失败！");</script>'; 
      //echo 'self.close(); '; 
  }  
  
  function input_csv($handle) { 
    $out = array (); 
    $n = 0; 
    while ($data = fgetcsv($handle, 10000)) { 
      $num = count($data); 
      for ($i = 0; $i < $num; $i++) { 
        $out[$n][$i] = $data[$i]; 
      } 
      $n++; 
    } 
    return $out; 
  } 
?>