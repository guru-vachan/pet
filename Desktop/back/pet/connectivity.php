<?php 
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'pet'); 
define('DB_USER','root');
 define('DB_PASSWORD','guru');
 $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
 $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error()); 
 /* $ID = $_POST['user']; $Password = $_POST['pass']; */
// function SignIn()
// {
// session_start(); //starting the session for user profile page if(!empty($_POST['user'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text
// {

 #if(!empty($row['userName']) AND !empty($row['pass'])) 
 //{ $_SESSION['userName'] = $row['pass']; 
# <a href="index.html"> </a>
 //}
 //else { echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY..."; 
 //}
 //}
 //}
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
 $query = mysql_query("insert into form values ('$a' , '$b' , $c , '$d' , '$e' , '$f' , $g , '$h')") or die(mysql_error()); 
 $row = mysql_fetch_array($query) or die(mysql_error()); 
// SignIn();
 }
 ?>

