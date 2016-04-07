<?php
include('simple_html_dom.php');
$html = new simple_html_dom();

 $html->load_file('http://pets.webmd.com/');
 $element=$html->find("p");
 
 
 echo $html->save();


?>