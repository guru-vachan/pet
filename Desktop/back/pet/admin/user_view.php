<?php
include('config.php');
if (isset($_GET['id'])){
$id=$_GET['id'];
//echo $id ; 

$row=mysql_query("SELECT * FROM users where id=".(int)$id);
$view= mysql_fetch_array($row,MYSQL_ASSOC);

?>
   <strong>Id:<?php echo $view['id'];?> </strong></br>
   <strong>First Name:</strong> <?php echo $view['f_name'];?> </br>
  <strong>Last Name:</strong> <?php echo $view['l_name'];?> </br>
  <strong>Email:</strong> <?php echo $view['email']; ?> </br>
 <strong>Role Id:</strong> <?php echo $view['role_id']; ?> </br>
 <strong>Status:</strong> <?php echo $view['status']; ?> </br>
  <strong>Created:</strong> <?php echo $view['created']; ?> </br>
<?php 
}
?>