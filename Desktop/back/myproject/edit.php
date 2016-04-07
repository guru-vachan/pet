<?php
include('config.php');
if(isset($_GET['id'])){
$id=$_GET['id'];

//print_r($id);
$sql = mysql_query("SELECT * FROM `register` WHERE `id` =".(int)$id);
$row = mysql_fetch_array($sql,MYSQL_ASSOC);

//echo '<pre>';
//print_r($row);
$mchecked = '';
$fchecked = '';
if($row['sex']=='male'){
$mchecked = "checked ='checked'";
}else{
$fchecked = "checked ='checked'";
}
$hobbies = explode(',',$row['hobbies']);
//print_r($hobbies);
 }

 if($_POST){
  /*  echo '<pre>';
 print_r($_POST); 
  echo '<pre>';
 print_r($_FILES);
 die; */ 
	$update_id = $_POST['id'];
	$name = $_POST['fname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sex = $_POST['sex'];
	$age = $_POST['age'];
	$hobbies = $_POST['hobbies'];
	$hobbies = implode(',',$hobbies);
	$aboutUs = $_POST['comment'];
	$register_date = date('Y-m-d H:i:s');
	if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=''){
		//echo getExtension($_FILES['file']['name']);die;
		$file = pathinfo($_FILES['file']['name']);
		$filename = $file['filename'].time(); 
		$extension = $file['extension']; 
		$filename = $filename.'.'.$extension; 
		if(move_uploaded_file($_FILES["file"]["tmp_name"], "profile_picture/" . $filename)){
		@unlink("profile_picture/" . $_POST['previous_profile_pic']);
			$profile_picture = $filename;
	  }
	}else{
	  $profile_picture = $_POST['previous_profile_pic'];
	}
	$execsql=mysql_query("UPDATE register SET `name`='".$name."',`email`='".$email."',`password`='".$password."',`sex`='".$sex."',`age`=".$age.",`hobbies`='".$hobbies."',`about_us`='".$aboutUs."',`register_date`='".$register_date."',`profile_pic`='".$profile_picture."' WHERE id=".(int)$update_id);
	//echo $sql;
	//$execsql = mysql_query($sql);
	//echo $execsql;
	
if($execsql){
// echo 'Record update successfully';
$_SESSION['update'] = true;
 header("Location:user_listing.php");
}
else
{
 echo "Record update unsuccessfully.";
}
}
?>

<html>
<head>
<title>SignUp</title>
</head>
<body>
 <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?php echo $id;?>"/>
   Name:<input type = "text" name="fname" value="<?php echo $row['name'];?>" /><br/><br/><br/>
  
   Email: <input type="type" name="email" value="<?php echo $row['email'];?>"/><br/><br/><br/>
   Sex: <input type="radio" name="sex" value="male" <?php echo $mchecked;?>/>Male
    <input type="radio" name="sex" value="female" <?php echo $fchecked;?>/>Female<br/><br/><br/>
    Age: <input type = "text" name="age" value="<?php echo $row['age'];?>"/><br/><br/>
	Hobbies:<input type="checkbox" name="hobbies[]" value="Game" <?php if(in_array('Game',$hobbies)){ echo "checked ='checked'";}else{} ;?>/> I like to play Game &nbsp &nbsp <input type="checkbox" name="hobbies[]" value="Movie" <?php if(in_array('Movie',$hobbies,True)){ echo "checked ='checked'";}else{} ;?>/> I like to watch hollywood Movies.<br/><br/>
	
	<?php if(isset($row['profile_pic']) && $row['profile_pic']!=NULL){?>
	<img src="profile_picture/<?php echo $row['profile_pic'];?>" alt="profile_pic" width="100" height="100"/><br/></br/>
	<input type="hidden" name="previous_profile_pic" value="<?php echo $row['profile_pic'];?>"/>
	<?php }?>
     <input type="file" name="file"/><br/>   
   AboutUs:<textarea rows=3 cols=10" name="comment"> <?php echo $row['about_us'];?></textarea><br/><br/><br/>
   <input type= "submit" value="Submit"/>
   </body>
   </html>+