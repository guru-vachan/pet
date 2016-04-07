<?php
//echo '<pre>';
        //print_r ($_FILES[]);die;
//print_r $_FILES["ram"];die;
if(isset($_POST['submit'])){
    $target_path = "uploads/";
    /* Add the original filename to our target path.  
    Result is "uploads/filename.extension" */
    $target_path = $target_path . basename( $_FILES['fileToUpload']['name']); 
    $target_path = "uploads/";
    $target_path = $target_path . basename( $_FILES['fileToUpload']['name']); 
        if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "img/matrimonial/fegerman.jpg")){
            echo "The file ".  basename( $_FILES['fileToUpload']['name']). " has been uploaded";
        }else{
            echo "There was an error uploading the file, please try again!";
        }
    }

?>



