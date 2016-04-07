<?php
//include_once("auth.php");
 ob_start();
class Cart{

    var $dbh;
    
    function __construct() {
        require_once('db_fns.php');
        $this->dbh = new PDOConfig;
    }
	
	public function addPet($id){
		return $this->addItem($id, 1);
	}
	
	public function addProduct($id){
		return $this->addItem($id, 2);
	}
	
	public function addItem($id, $type){
		if(!isset($_SESSION["cart"]))
			$_SESSION["cart"] = array();
		if(isset($_SESSION["cart"][$type][$id])){
			$_SESSION["cart"][$type][$id] += 1;
		} else {
			$_SESSION["cart"][$type][$id] = 1;
		}
		if($type==1)
			$_SESSION['msg']['market'] = "Successfully added item. <a class='btn btn-warning' href='checkout.php'>Checkout</a>";
		else
			$_SESSION['msg']['product'] = "Successfully added item. <a class='btn btn-warning' href='checkout.php'>Checkout</a>";
	}
	
	public function removePet($id){
		return $this->removeItem($id, 1);
	}
	
	public function removeProduct($id){
		return $this->removeItem($id, 2);
	}
	
	public function removeItem($id, $type){
		if(!isset($_SESSION["cart"]))
			return;
		if(isset($_SESSION["cart"][$type][$id])){
			if($_SESSION["cart"][$type][$id] > 1){
				$_SESSION["cart"][$type][$id] -= 1;
			} else {
				unset($_SESSION["cart"][$type][$id]);
			}
			if($type==1)
				$_SESSION['msg']['checkout'] = "Successfully removed pet.";
			else
				$_SESSION['msg']['product'] = "Successfully removed product.";
		}
	}
	
	public function getCartCount(){
	
		if(!isset($_SESSION["cart"]))
			return 0;
		else{
			$ret = 0;
			//if(isset($_SESSION["cart"][1])) $ret += count($_SESSION["cart"][1]);
			if(isset($_SESSION["cart"][1])) {
				foreach($_SESSION["cart"][1] as $c){
					$ret += $c;
				}
			}
			if(isset($_SESSION["cart"][2])) {
				foreach($_SESSION["cart"][2] as $c){
					$ret += $c;
				}
			}
			//if(isset($_SESSION["cart"][2])) $ret += count($_SESSION["cart"][2]);
			return $ret;
		}
	}
	
	public function getAllPetsInCart(){
		return isset($_SESSION["cart"][1])?$_SESSION["cart"][1]:false;
		
	}
	
	public function getAllProductsInCart(){
		return isset($_SESSION["cart"][2])?$_SESSION["cart"][2]:false;
	
	}
	
	public function getAllItemsInCart(){
		return isset($_SESSION["cart"])?$_SESSION["cart"]:false;
	}
	
	public function getPetDetails($id){
		require_once('market_fns.php');
		$obj = new Market;
		return $obj->getPetById($id);
	}
	
	public function getProductDetails($id){
		require_once('product_fns.php');
		$obj = new Products;
		return $obj->getProductById($id);
	}
	
	public function getCheckoutId($cuid){
		$sql = "INSERT INTO checkout (id, user_id, added_on) VALUES(NULL, $cuid, NOW())";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array());
		return $this->dbh->lastInsertId();
	}
	
	public function insertIntoCheckoutDetails($id,$quan,$type, $cid){
		$sql = "INSERT INTO checkout_details (did, cid, type, iid, quantity) VALUES(NULL, $cid, $type, $id, $quan)";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array());
		return true;
	}
	
	public function insertAddress($address, $mob, $cid){
		$sql = "INSERT INTO checkout_address (aid, cid, address, mob) VALUES(NULL, ?, ?, ?)";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($cid, $address, $mob));
		return true;
	}
	
	public function setPetSold($id){
		$sql = "UPDATE breed_sell SET sold=1 WHERE id = $id";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array());
		return true;
	}
	
	public function decreaseProduct($id, $quan){
		$sql = "UPDATE products SET stock=stock-$quan WHERE pid = $id";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array());
		return true;
	}
	
	public function processRequest($address, $mob){
		require_once('auth.php');
		//echo "hii";die;
		
		$helper = new AuthHelper;
		//echo "hii";die;
		if(!$helper->loggedIn()){
			header('Location: ../checkout.php');
			exit;
		}
		
		if(!isset($_SESSION["cart"]) || empty($_SESSION["cart"])){
			header('Location: ../checkout.php');
			exit;
		}
		
		$pets = $this->getAllPetsInCart();
		$products = $this->getAllProductsInCart();
		if($pets == false && $products == false){
			header('Location: ../checkout.php');
			exit;
		}
		
		// insert into checkout table and get ID
		$checkout_id = $this->getCheckoutId($helper->getId());
		
		// insert checkout details
		
		if($pets){
			foreach($pets as $pet=>$val){
				// insert pets
				$this->insertIntoCheckoutDetails($pet,$val,1,$checkout_id);
				//sold pets set
				$this->setPetSold($pet, $val);
			}
		}
		
		if($products){
			foreach($pets as $product=>$val){
				// insert products
				$this->insertIntoCheckoutDetails($product,$val,1,$checkout_id);
				// decrease products
				$this->decreaseProduct($product, $val);
			}
		}
		
		// insert address
		$this->insertAddress($address, $mob, $checkout_id);
		
		// empty cart
		unset($_SESSION["cart"]);
		
		return true;
	}
	
}
?>