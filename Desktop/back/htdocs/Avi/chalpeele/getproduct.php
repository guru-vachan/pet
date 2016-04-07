<?php
ob_start();
session_start();
$con = mysql_connect('localhost','root','');
mysql_select_db('chalpeele',$con);
$category_id=$_REQUEST['category_id'];
//echo $category_id;die;
$cat_sql=mysql_query("SELECT * FROM `product` WHERE `category_id`=".(int)$category_id);

	  $i=0;
	  $html = '';
	  while($row = mysql_fetch_array($cat_sql,MYSQL_ASSOC)){
			if($i%2==0){
			  $br ='';
			  $class = 'leftbox';
			  }else{
			  $class = 'rightbox';
			  $br ='<div class="clear br"></div>';
			  }
			  $html.='<div class="'.$class.'">';
			  $html.='<h3>'.$row["p_name"].'</h3><img src="../product_image/small/'.$row["product_image"].'" alt="Smile" class="left" />';
			  $html.='<p><b>Price:</b> <b>'.$row['p_price'].'</b> &amp; eligible for FREE Super Saver Shipping on orders over <b>$195</b>.</p><p><b>Availability:</b> Usually ships within 24 hours</p>';
			  $html.='<p class="readmore"><a class="buy_now"  href="javascript:" data-id="'.$row["p_id"].'">BUY <b>NOW</b></a></p><div class="clear"></div>';
			  $html.=' </div>'.$br;
			  $i++;
		    }
			echo $html;
         ?>
		 
        
     
