<?php 
ob_start();
$con = mysql_connect('localhost','root','');
if($con){
//echo 'connect';
}else{
echo mysql_error();
}
mysql_select_db('chalpeele',$con);

$sql=mysql_query("SELECT id,category_name FROM `categories` WHERE parent_id=0");

?>
 <ul id="browse">
      <?php while($sql1=mysql_fetch_array($sql,MYSQL_ASSOC)){
			$subcat_sql=mysql_query("SELECT id,category_name FROM `categories` WHERE parent_id=".$sql1['id']);
			$nrows = mysql_num_rows($subcat_sql);
	  ?>
	   
      <li class="categories">
		<a href="javascript:" class="cat_name"><?php echo ucfirst($sql1['category_name']);?></a>
		<?php if($nrows > 0){?>
			<ul class="sub_cat">
				<?php while($sub_cat_data=mysql_fetch_array($subcat_sql,MYSQL_ASSOC))
						{?>
					<li><a href="javascript:" class="sub" data-id="<?php echo $sub_cat_data['id'];?>"><?php echo $sub_cat_data['category_name'];?></a></li>
				<?php }?>
			</ul>
			<?php } ?>
	  </li>
	
	<?php } ?>
	
	<?php
	
	//All Categories in select box
	
	$sqlcat=mysql_query("SELECT id,category_name FROM `categories` WHERE parent_id=0");
	?>
      <li class="text">Search Your Favourite Wine</li>
      <li class="searchform">
        <form method="get" action="index.php" name="serach_form">
          <div>
            <select name="cat">
              <option value="">SELECT CATEGORY</option>
              <?php while($catData = mysql_fetch_array($sqlcat,MYSQL_ASSOC)){
					$select = '';
					if(isset($_REQUEST['cat']) && !empty($_REQUEST['cat'])){
						if($_REQUEST['cat']==$catData['id']){
						
							$select = 'selected="selected"';
						}
					}
			  ?>
			  <option value="<?php echo $catData['id'];?>" <?php echo $select;?>><?php echo ucfirst($catData['category_name']);?></option>
			  <?php }?>
            </select>
          </div>
          
          <div class="softright">
            <img src="images/btn_search.gif" onclick="document.serach_form.submit();"/>
          </div>
		  <li class="text">Search Your particular Wine</li>
		  <div>
		    NAME <input type="text" name="wine_name"/>
		  </div>
        </form>
      </li>
    </ul>
	<script type="text/javascript">
		$(function(){
		
			$('ul#browse li.categories:first').addClass('first');
			$('ul#browse li.categories:last').addClass('last');
			$('a.cat_name').on('click',function(){
				$('ul.sub_cat').slideUp();
				$(this).parent().children().slideDown();
			
			});
			
			$('a.sub').on('click',function(){
				var category_id=$(this).attr('data-id');
				
				if(category_id != ''){
					$.ajax({
						url:'getproduct.php',
						type:'POST',
						data:{category_id:category_id},
						success:function(response){
							//alert(response);
							$('div.inner').html(response);
						}
					});
				}

			});
		
	});
	</script>

		