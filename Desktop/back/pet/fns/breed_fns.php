<?php

class Breed {

    var $dbh;
    
    function __construct() {
        require_once('db_fns.php');
        $this->dbh = new PDOConfig;
    }
    
    function getBreedDetailsById($id){
        $sql = "SELECT * FROM breeds WHERE id = $id";
        $stmt = $this->dbh->prepare($sql);                // This line prepares the SQL query
        $stmt->execute(array());                          // This line executes the SQL query
        return $stmt->fetch(PDO::FETCH_ASSOC);         // This line fetched the result.
        
        // fetchAll is to fetch all the rows returned.
        // fetch is to fetch a single row
        // as we have a single row, we will use fetch
        // PDO::FETCH_ASSOC means FETCH_ASSOC variable of PDO class. Using this returns associative array as we used that day.
        
    }
    
    function getHomePageBreeds(){
        $sql = "SELECT * FROM breeds LIMIT 6";
        $stmt = $this->dbh->prepare($sql);                
        $stmt->execute(array());                          
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getAllBreeds(){
        $sql = "SELECT * FROM breeds";
        $stmt = $this->dbh->prepare($sql);                
        $stmt->execute(array());                          
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
	
}
    ?>