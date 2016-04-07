<?php
/**
 *	@author programofreak
 *	@code functions related to restaurants
 */

class User {
	var $dbh;
	var $helper;
	
	function __construct() {
		require_once(FNS.'/static/constants.php');
		require_once(FNS.'/dynamic/db_fns.php');
		require_once(FNS.'/dynamic/auth.php');
		$this->dbh = new PDOConfig;
		$this->helper = new AuthHelper;
	}

	function getAllAddress($id=null){
		if($id==null){
			$id = $this->helper->getId();
		}
		$sql = "SELECT sid,".T_ADD.".name,room,mob,mob_alt,".T_HOSTEL.".name as hostel_name FROM ".T_ADD." JOIN ".T_HOSTEL." WHERE cuid = ? AND ".T_HOSTEL.".hid = ".T_ADD.".hostel";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($id));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	function isAddressOfUser($sid,$cuid=null){
		if($cuid==null){
			$cuid = $this->helper->getId();
		}
		$stmt = $this->dbh->prepare("SELECT count(*) FROM ".T_ADD." WHERE sid = ? AND cuid = ?");
		$stmt->execute(array($sid,$cuid));
		if($stmt->rowCount()){
			return true;
		} else {
			return false;
		}
	}
	
	function getName($id=null) {
		list($a,$b) = $this->getMany($id,array($fname, $lname));
		return "$a $b";
	}
	
	function getEmail($id=null) {
	
	}
	
	function getMob($id=null) {
		return $this->getOne($id,"mob");
	}
	
	function getContact($id=null){
		return $this->getMob($id);
	}
	
	function getAllOrders($id=null) {
		//$sql = "SELECT ";
	}
	
	#TODO table name to constants
	
	function getLatestOrder($id=null) {
		if($id==null) {
			$id = $this->getId();
		}
		$sql = "SELECT order_detail.name, order_detail.num, order_detail.cost, order.vat, order.stax, order.delivery_charge, order.added_on, order.spoons, order.coke, order.invoice, order.discount, order.order_status, rest.name as rest, rest.nick as nick FROM order_detail JOIN `order`,rest WHERE order.oid = (SELECT oid FROM `order` WHERE cuid = 2 ORDER BY oid DESC LIMIT 1) AND order.oid = order_detail.oid AND rest.rid = order.rid";
	}
	
	#TODO table name to constants
	function getBasicLatestOrder($id=null) {
		if($id==null) {
			$id = $this->getId();
		}
		$sql = "SELECT ".T_ORDER.".invoice, ".T_ORDER.".added_on,".T_ORDER.".order_status, rest.name as rest, rest.nick as nick, ".T_ORDER.".rid FROM `".T_ORDER."` JOIN ".T_REST." WHERE cuid = ?  AND ".T_ORDER.".rid = ".T_REST.".rid ORDER BY oid DESC LIMIT 1";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($id));
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	#TODO table name to constants
	function getBasicOrder($offset, $limit, $id=null) {
		if($id==null) {
			$id = $this->getId();
		}
		$sql = "SELECT order.invoice, order.added_on, rest.name as rest, rest.nick as nick FROM `".T_ORDER."` JOIN ".T_REST." WHERE cuid = ? AND ".T_ORDER.".rid = ".T_REST.".rid ORDER BY cuid DESC";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($id));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function getPendingOrders($id=null) {
	
	}
	
	function getAllReviews($id=null) {
		if($id==null){
			$id = $this->helper->getUid();
		}
		$stmt = $this->dbh->prepare("SELECT ".T_R_REVIEW.".id, ".T_R_REVIEW.".rid, ".T_REST.".name as rest, ".T_REST.".nick as nick, comment, votes, downvotes, ".T_R_REVIEW.".added_on FROM ".T_R_REVIEW." JOIN ".T_CUSER.", ".T_USER.", ".T_REST." WHERE ".T_USER.".uid = ? AND ".T_R_REVIEW.".uid = ".T_USER.".uid AND ".T_USER.".id = ".T_CUSER.".cuid AND ".T_REST.".rid = ".T_R_REVIEW.".rid ORDER BY added_on DESC");
		$stmt->execute(array($id));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	function getLatestReview($id=null) {
	
	}
	
	function getPic($id=null) {
		return $this->getOne($id,"pic");
	}
	
	function getLogo($id=null) {
		return $this->getPic($id);
	}

	function getBasic($id=null) {
		return $this->getMany($id,array("fname","lname","mob","pic"));
	}
	
	function getBasicInfo($id=null) {
		if($id==null) {
			$id = $this->getId();
		}
		$sql = "SELECT fname, lname, mob, pic, email FROM ".T_CUSER." JOIN ".T_USER." WHERE ".T_CUSER.".cuid = ? AND ".T_USER.".id = ".T_CUSER.".cuid";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($id));
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	function getId() {
		return $this->helper->getId();
	}
	
	function getOne($id, $name) {
		if($id==null) {
			$id = $this->getId();
		}
		$query = "SELECT $name FROM ".T_CUSER." WHERE cuid = ?";
		$stmt = $this->dbh->prepare($query);
		$stmt->execute(array($id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		//var_dump($stmt->errorInfo());
		return $result[$name];
	}
	
	function getMany($id, $names) {
		if($id==null) {
			$id = $this->getId();
		}
        $sql = "SELECT ".implode(', ',$names)." FROM ".T_CUSER." WHERE cuid = ?";
        $stmt = $this->dbh->prepare($sql);
        if($stmt->execute(array($id)))
        {
            if($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $result;
            } 
            else {
                return false;
            }
        }
		var_dump($stmt->errorInfo());
        return false;
    }
}
	