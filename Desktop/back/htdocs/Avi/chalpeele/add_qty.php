<?php
session_start();
/*  print_r($_GET);
print_r($_REQUEST);
 */
$price=$_REQUEST['price'];
$p_id=$_REQUEST['p_id'];
$action=$_REQUEST['action'];
$data =array();
if($action=='add'){
 if(array_key_exists($p_id,$_SESSION['cart']))
	 {  // echo 'hii1';
	  //echo '<pre>';
	  //print_r ($_SESSION['cart']);
	    $_SESSION['cart'][$p_id]['qty']++;
		$qty = $_SESSION['cart'][$p_id]['qty'];
		$totalPrice = ($_SESSION['cart'][$p_id]['qty'])*$price;
		$data['qty'] = $qty;
		$data['totalPrice'] = $totalPrice;
		$data['action'] = true;
		
	 }
}else if($action=='minus'){

 if(array_key_exists($p_id,$_SESSION['cart']))
	 {   //echo 'hii1';
	  //echo '<pre>';
	  //print_r ($_SESSION['cart']);
	    $_SESSION['cart'][$p_id]['qty']--;
		$qty = $_SESSION['cart'][$p_id]['qty'];
		$totalPrice = ($_SESSION['cart'][$p_id]['qty'])*$price;
		$data['qty'] = $qty;
		$data['totalPrice'] = $totalPrice;
		//echo  $_SESSION['cart'][$p_id]['qty'];
		$data['action'] = true;
	 }


}else{
	if(array_key_exists($p_id,$_SESSION['cart']))
	{
		unset($_SESSION['cart'][$p_id]);
		
	}
	$data['action'] = false;
}
header('Content-Type:application/json');
echo json_encode($data);die;
	//echo $_SESSION['cart']['p_id']['qty'];die;
//header("Location:view_cart.php");
?>