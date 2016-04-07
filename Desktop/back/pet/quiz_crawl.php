<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>crawl</title>
</head>

<body>

<?php

ini_set('memory_limit', '-1');
echo"medication details<br>";
$cn=mysql_connect("localhost","root","guru");
mysql_select_db("pet",$cn);

include('simple_html_dom.php');
$html=file_get_html('http://www.medicines4pets.co.uk/c-104-fleas-ticks-worms.aspx');
$del="delete from tab";
mysql_query($del);

		for($i=0;$i<10;$i++)
		{$id=$i+1;
			$name[$i] = $html->find('div[class="botcatnamewrap"]',$i);
		    $name1[$i] = $html->find('span[class="variantprice"]',$i);
			
			$a=$name[$i]->plaintext;
			$b=$name1[$i]->plaintext;
			
			echo $a;
		    echo $b;
			
			$insert="insert into tab values('$id','$a','$b')";
			mysql_query($insert);
		}
		
		
		
	set_time_limit(0);
	
?>
</body>
</html>
