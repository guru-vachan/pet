<?php

class Market {

    var $dbh;
    
    function __construct() {
        require_once('db_fns.php');
        $this->dbh = new PDOConfig;
    }
    
    function getAllPets(){
        $sql = "SELECT breed_sell.id, breeds.breed_name, price, age, pic, gender FROM breed_sell JOIN breeds WHERE sold = 0 AND breeds.id = breed_sell.breed_id";
        $stmt = $this->dbh->prepare($sql);                
        $stmt->execute(array());                          
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	function getPetById($id){
		$sql = "SELECT breed_sell.id, breeds.breed_name, price, age, pic, gender FROM breed_sell JOIN breeds WHERE breeds.id = breed_sell.breed_id AND breed_sell.id = $id";
        $stmt = $this->dbh->prepare($sql);                
        $stmt->execute(array());                          
        return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	function getPets($query){
		$sql = "SELECT breed_sell.id, breeds.breed_name, price, age, pic, gender FROM breed_sell JOIN breeds WHERE sold = 0 AND breeds.id = breed_sell.breed_id AND breed_sell.breed_id IN ($query)";
        $stmt = $this->dbh->prepare($sql);                
        $stmt->execute(array());   
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
    ?>