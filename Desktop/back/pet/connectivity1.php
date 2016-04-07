<?php 
 mysql_connect('localhost','root','guru'); 
 mysql_select_db('formdatabase'); 

 $a=$_REQUEST['name'];
 $b=$_REQUEST['breed'];
 $c=$_REQUEST['age'];
 $d=$_REQUEST['details'];
 $e=$_REQUEST['gender'];
 $f=$_REQUEST['location'];
 $g=$_REQUEST['price'];
 $h=$_REQUEST['photos'];
 
 
 if(isset($_POST['submit']))
 {
// echo "insert into form values ('$a' , '$b' , $c , '$d' , '$e' , '$f' , $g , '$h')"; die;	
 $query = mysql_query("insert into form values ('$a' , '$b' , $c , '$d' , '$e' , '$f' , $g , '$h');"); 
 echo "successfully Insert";
 }
 ?>
 
 
 
 
