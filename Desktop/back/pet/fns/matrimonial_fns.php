<?php

class Matrimonial {

    var $dbh;
    
    function __construct() {
        require_once('db_fns.php');
        $this->dbh = new PDOConfig;
    }
    
    function getAllBrides(){
		return $this->getMatri(2);
    }
	
	function getAllGrooms(){
		return $this->getMatri(1);
	}
	
	function getMatri($gender){
        $sql = "SELECT mid, breed_name, pincode, price, gender, age, pic FROM matrimonial JOIN breeds WHERE mid = id AND gender = $gender";
        $stmt = $this->dbh->prepare($sql);                
        $stmt->execute(array());                          
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
    ?>