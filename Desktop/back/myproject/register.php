	<?php
 /* echo '<pre>';
print_r($_SERVER);die; */
 
 include('config.php');
 $nameErr=$emailErr=$genderErr=$ageErr = $hobbyErr ="";
 $countrySql = mysql_query("SELECT * FROM `countries` WHERE `status` =1");

if($_POST){
  //echo '<pre>';
 //print_r($_POST); 
  echo '<pre>';
 print_r($_FILES);die;   
$name = test($_POST['fname']);
$email = test($_POST['email']);
$flag = true;
	if(empty($_POST['fname'])){
		$nameErr="Name is required";
		$flag = false;
	}else if(!preg_match("/^[a-zA-Z]*$/",$name)){
		$nameErr="Only letters and White space allowed";
		$flag = false;
	}else{
		$flag = true;
	} 
	if(empty($_POST['email'])){
		$emailErr="Email is required";
		$flag = false;
	}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$emailErr="Invalid email format";
		$flag = false;
	}else{
		$flag = true;
	} 

	//$email = $_POST['email'];
	$password = $_POST['password'];
	if(empty($_POST['sex'])){
		$genderErr="Gender is required";
	}else{
		$sex = test($_POST['sex']);
	}	  

	$age = $_POST['age'];
	if(empty($age)){
		$ageErr =' Age is required';
		$flag = false;
	}else if(!preg_match("/^[0-9]*$/",$age)){
		$ageErr="Only number allowed";
		$flag = false;
	} 
	else if($age<18){
		$ageErr="age should be greater than 18 years.";
		$flag = false;
	}else{
		$flag = true;
	}
	
	if(!isset($_POST['hobbies'])){
		$hobbyErr = 'Hobbies are required.';
		$flag = false;	
	}else{
		$flag = true;
		$hobbies = $_POST['hobbies'];
		$hobbies = implode(',',$hobbies);
	}
	if(empty($_POST['comment'])){
	    $aboutUs=" ";
		}else{
		  $aboutUs = test($_POST['comment']);
		  }
		  
	//$aboutUs = $_POST['comment'];
	$register_date = date('Y-m-d H:i:s');
	$profile_picture = NULL;
	if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=''){
		//echo getExtension($_FILES['file']['name']);die;
		$file = pathinfo($_FILES['file']['name']);
		$filename = $file['filename'].time(); 
		$extension = $file['extension']; 
		$fileArr = array('jpg','jpeg','png');
		if(!in_array(strtolower($extension),$fileArr)){
				$fileErr = 'Please upload only jpg,jpeg and png file.';
				$flag = false;
		}else{
		$flag = true;
		$filename = $filename.'.'.$extension; 
		if(move_uploaded_file($_FILES["file"]["tmp_name"], "profile_picture/" . $filename)){
				$profile_picture = $filename;
			
	  }
	}
		
	}else{
		$fileErr = 'Please upload file';
		$flag = false;
	}
	if($flag){
	
	$sql = "INSERT INTO `register` (`name`, `email`, `password`, `sex`, `age`, `hobbies`, `about_us`, `register_date`,`profile_pic`) VALUES('".$name."','".$email."','".$password."','".$sex."',".$age.",'".$hobbies."','".$aboutUs."','".$register_date."','".$profile_picture."')";
	$execsql = mysql_query($sql);
	
		if($execsql){
		 //echo 'Record insert successfully';
		 $_SESSION['INSERT']=TRUE;
		 header('LOCATION: user_listing.php');
		}
		else
		{
		 echo "Record insert unsuccessfully.";
		}  
  }
  else{
  echo 'Please correct Errors';
  }
}
function test($data)
	{
	 $data=trim($data);
	 $data=stripslashes($data);
	 $data=htmlspecialchars($data);
	 return $data;
	}
 ?>
<html>
<head>
<style>
.error{color: #FF0000;}</style>
<title>SignUp</title>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$('#country').on('change',function(){
	var country_id = $(this).val();
	if(country_id != ''){
		$.ajax({
			url:'getstates.php',
			type:'POST',
			data:{country_id:country_id,'action':'test'},
			success:function(response){
				//alert(response)
				//$('#states').html(response);
				$('div.state_data').html(response);
			}
		});
	}

});
$(document).on('change','#states',function(){
   
       var state_id=$(this).val();
	   if(state_id !=''){
	       
		   $.ajax({
		    
			 url :'dist.php',
			 type:'POST',
             data: { state_id:state_id},
			 success:function(answer){
			 
                $('#dist').html(answer);
            }
        });
   }
});   
			  
 /* $('input[type=submit]').click(function(){
  $('#sub_btn').click(function(e){
	e.preventDefault();
	var fname = $('#fname');
	var email = $('#email');
	var password = $('#password');
	var c_password = $('#c_password');
	var age = $('#age');
	var comment = $('#comment');
	var gender = $('.gender:checked').length;
	var gender = $('.gender:checked').length;
	
	var flag = true;
	$('#f_name_err').html();
	if($.trim(fname.val())==''){
		//alert('Please enter fname');
		$('#f_name_err').html('Please enter fname');
		flag = false;
		fname.focus();
		return false;
	} else if($.trim(email.val())==''){
		alert('Please enter email');
		flag = false;
		email.focus();
		return false;
	}else if(gender==0){
		alert('Please select gender');
		flag = false;
		
		return false;
	}
	if(flag){
		$('#register_form').submit();
	}
	
  });*/
  
});
</script>
</head>
<body>
 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data" id="register_form">
   Name:<input type = "text" name="fname" id="fname" value="<?php echo isset($_POST['fname'])?$_POST['fname']:'';?>" />
      <span class="error" id="f_name_err">*<?php echo $nameErr;?></span><br/><br/><br/>
  
   Email: <input type="type" name="email" id="email" value="<?php echo isset($_POST['email'])?$_POST['email']:'';?>"/>
         <span class="error">*<?php echo $emailErr;?></span><br/><br/><br/>
		 
	Country : <select name="country" id="country">
				<option value="">Please Select </option>
				<?php 
				while($countryData = mysql_fetch_array($countrySql)){?>
				<option value="<?php echo $countryData['id'];?>"><?php echo $countryData['name'];?> </option>
				
				<?php }?> 
				</select><br/><br/>
	<div class="state_data"	>		
			States : <select name="states" id="states">
				<option value="">Please Select </option>
				
				</select>
				</div><br/><br/>
		 Dist:	<select name="dist" id="dist">
		          <option value="">please select</option>
				  
				  </select><br/><br/>
   Password: <input type="password" name="password" id="password" /><br/><br/>
   Confirm Password: <input type="password" name="c_password" id="c_password" /><br/><br/>
   Sex: <input type="radio" name="sex" value="male" class="gender" />Male
        <input type="radio" name="sex" value="female" class="gender"/>Female
	     <span class="error">*<?php echo $genderErr;?></span><br/><br/><br/>
    Age: <input type = "text" name="age" id="age" value="<?php echo isset($_POST['age'])?$_POST['age']:'';?>"/><span class="error">*<?php echo $ageErr;?></span><br/><br/>
	 
	Hobbies:<input type="checkbox" name="hobbies[]" value="Game" /> I like to play Game &nbsp;&nbsp; <input type="checkbox" name="hobbies[]" value="Movie" /> I like to watch hollywood Movies.<br/><br/>
	     <span class="error">*<?php echo $hobbyErr;?></span><br/><br/><br/>
	<input type="file" name="file"/><br/>
       <span class="error">*<?php echo isset($fileErr)?$fileErr:'';?></span><br/>
   AboutUs:<textarea rows="3" cols="10" name="comment" id="comment"> </textarea><br/><br/><br/>
   <input type= "submit" value="Submit" id="sub_btn"/>
   
    
</body>
</html>