<?php

class Products {

    var $dbh;
    
    function __construct() {
        require_once('db_fns.php');
        $this->dbh = new PDOConfig;
    }
    
    function getAllProducts(){
        $sql = "SELECT pid, name, cat, pic, thumbsup, cost, rating FROM products JOIN product_types WHERE type = pt_id AND stock > 0";
        $stmt = $this->dbh->prepare($sql);                
        $stmt->execute(array());                          
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getProductById($id){
        $sql = "SELECT pid, name, cat, pic, thumbsup, cost, rating FROM products JOIN product_types WHERE type = pt_id AND stock > 0 AND pid=$id";
        $stmt = $this->dbh->prepare($sql);                
        $stmt->execute(array());                          
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
	
    function getProducts($query){
        $sql = "SELECT pid, name, cat, pic, thumbsup, cost, rating FROM products JOIN product_types WHERE type = pt_id AND stock > 0 AND pt_id IN ($query)";
        $stmt = $this->dbh->prepare($sql);                
        $stmt->execute(array());                          
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	function getAllProductTypes(){
		$sql = "SELECT * FROM product_types";
		$stmt = $this->dbh->prepare($sql);                
        $stmt->execute(array());                          
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
    ?>