<?php

class Lost {

    var $dbh;
    
    function __construct() {
        require_once('db_fns.php');
        $this->dbh = new PDOConfig;
    }
	
	function getLostPets(){
        $sql = "SELECT lid, breed_name, pincode, gender, age, pic FROM lost JOIN breeds WHERE lid = id AND active = 1";
        $stmt = $this->dbh->prepare($sql);                
        $stmt->execute(array());                          
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
    ?>