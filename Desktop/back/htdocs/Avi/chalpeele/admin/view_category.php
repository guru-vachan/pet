<?php
include('config.php');
if (isset($_GET['id'])){
$id=$_GET['id'];
$row=mysql_query("SELECT * FROM categories where id=".(int)$id);
$view= mysql_fetch_array($row,MYSQL_ASSOC);

//print $view['id'];die;
?>
   <strong>Id:<?php echo $view['id'];?> </strong></br>
   <strong> category_name:</strong> <?php echo $view['category_name'];?> </br>
   <strong>parent_id:</strong> <?php echo $view['parent_id'];?> </br>
   <strong>status:</strong> <?php echo $view['status']; ?> </br>
    <strong>Created:</strong> <?php echo $view['created']; ?> </br>
<?php 
}
?>