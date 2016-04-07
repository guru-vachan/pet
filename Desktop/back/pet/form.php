<html><head>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<style>
.error {color: #FF0000;}
</style>
</head>
<body background="pop.jpg"> 


<div align="center" style="
    background-color:;
">
<fieldset style="
    margin-top: 100px;
    margin-left: 250px;
    margin-right: 250px;
    margin-bottom: 0px;
    background-color: rgb(42, 165, 90);
">
<h2> User Registration Form </h2>
<p><span class="error">* required field.</span></p>
<!--<form method="post" action="/pet/form.php" style="
"> -->
<form method="POST" action="connectivity1.php" style="">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="Inputname" name="name" placeholder="Enter name" style="
    width: 30%;
">
<span class="error">* </span>
  </div>
    <div class="form-group" style="
    width: 30%;
">
    <label for="breed">Breed</label>
    <input type="text" class="form-control" id="Inputbreed" name="breed" placeholder="Enter Breed">
	<span class="error">* </span>
  </div>
   <div class="form-group" style="
    width: 30%;
">
    <label for="age">Age</label>
    <input type="number" class="form-control" id="inputage" name="age" placeholder="Enter Age">
  </div>
   <div class="form-group" style="
    width: 100%;
">
    <label for="Description">Description</label>
    <input type="text" class="form-control" id="Inputdetails" name="details" placeholder="Enter details" style="
    width: 300px;
    height: 100px;
">
  </div>
   
   Gender:
   <input type="radio" name="gender" value="female">Female
   <input type="radio" name="gender" value="male">Male
   <span class="error">* </span>
   <br><br><br>
    <div class="form-group" style="
    width: 30%;
">
    <label for="location">Location</label>
    <input type="text" class="form-control" id="Inputlocation" name="location" placeholder="Enter location">
  </div>
   <div class="form-group" style="
    width: 30%;
">
    <label for="price">Price</label>
    <input type="number" class="form-control" id="Inputprice" name="price" placeholder="Enter price">
	<span class="error">* </span>
  </div>
   
   
   <label>Photos :</label>
   <input type="file" name="photos">
   <br>
   <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>
</fieldset>
</div>





</body></html>