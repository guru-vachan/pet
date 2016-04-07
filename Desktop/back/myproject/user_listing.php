<?php
include('config.php');
$sql = mysql_query("SELECT * FROM `register`");
//$row = mysql_fetch_array($sql,MYSQL_ASSOC);
//echo '<pre>';
//print_r($row);
/* echo '<pre>';
print_r($_GET); */
/* if(isset($_GET['action']) && $_GET['action']=='delete'){
$id=$_GET['id'];
$execsql=mysql_query("delete from register where id=" .(int)$id);

if($execsql)
{
$_SESSION['delete'] =true;
header("Location:user_listing.php");
}
else{
echo 'unsuccessful';
}  */

//}

?>
<html>
	<head> 
		<title>User LIsting</title>
	</head>
	<body>
	<?php if(isset($_SESSION['update']) && $_SESSION['update']==1){?>
	<span> Record update successfully </span>
	<?php }
	unset($_SESSION['update']);
	
	?>
	<?php if(isset($_SESSION['delete']) && $_SESSION['delete']==1){?>
	<span> Record Deleted successfully </span>
	<?php }
	unset($_SESSION['delete']);
	
	?>
	<?php if(isset($_SESSION['INSERT']) && $_SESSION['INSERT']==1){?>
	<span> Record INSERTED successfully </span>
	<?php }
	unset($_SESSION['INSERT']);
	
	?>
	<a href="register.php">Register </a>
			<table width="100%" border="1">
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Sex</th>
					<th>Age</th>
					<th>Hobbies</th>
					<th>About_us</th>
					<th>Register_date</th>
					<th>Action</th>
				</tr>
				<?php  
					while($row = mysql_fetch_array($sql,MYSQL_ASSOC)){
						 //echo '<pre>';
						//print_r($row); 
						?>
						<tr>
							<td><?php echo $row['id'];?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['email'];?></td>
							<td><?php echo $row['sex'];?></td>
							<td><?php echo $row['age'];?></td>
							<td><?php echo $row['hobbies'];?></td>
							<td><?php echo $row['about_us'];?></td>
							<td><?php echo $row['register_date'];?></td>
							<td><a href="edit.php?id=<?php echo $row['id'];?> ">EDIT</a> &nbsp; 
							<!--<a href="delete.php?id=<?php echo $row['id'];?> ">Delete</a> -->
							<a href="user_listing.php?id=<?php echo $row['id'];?>&action=delete">Delete</a> 
							</td>
						</tr>
					
					<?php } ?>
				
			</table>
	</body>