<?php
include('simple_html_dom.php');
$html=new simple_html_dom();
$html->load_file('http://www.petcarerx.com/');

$element = $html->find('h2');
foreach($element as $head){
	echo $head->innertext;
	echo "<br/>";
	 
}
$imagepath=$html->find('img');
foreach($imagepath as $img){
	echo $img->attr['src'];
	echo '<hr><br/>';
	
}
//echo $html->save();
//$html= file_get_html("http://www.petcarerx.com/");
  //$title = $html->find("#PPExperienceBanner");
   //print_r $title();
  
  ?>
