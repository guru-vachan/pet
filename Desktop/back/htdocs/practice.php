<?php
//print_r ($_SERVER);die();
$con=mysql_connect('localhost','root','guru');
mysql_select_db('quiz',$con);

?>

<!DOCTYPE html>
<html>
<body>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
   Dance: <input type="text" name="fname">
   <input type="submit">
</form>

<?php
if ($_POST) {
     
     $name = $_POST['fname']; 
     if (empty($name)) {
         echo "Name is empty";
     } else {
         echo $name."<br>";
     }
	 //echo "hii";
	 //echo "select *from dance where 'dance'='".$name."'";die();
	 
	 $sql=mysql_query("select id from dance where dance='".$name."'");
	 $ar=mysql_fetch_array($sql,MYSQL_ASSOC);
	 //echo $sql;
	 //echo "hii1";
	
	 $sql1=mysql_query("select re from requirment where did=".(int)$ar['id']);
	 
	 $data=mysql_fetch_array($sql1,MYSQL_ASSOC);
	 
	 print_r ($data['re']);
	 
}
?>

</body>
</html>