<?php
ob_start();
include('config.php');
include('header.php');
 
  $per_page=PER_PAGE_RECORD;
 if(isset($_GET['page'])){
 $page=$_GET['page'];
 $start=($page*$per_page)-1;
 }
 else{
 $start=0;
 }
 //echo "SELECT * FROM `users` LIMIT ".$start.",".$per_page;die;
 $recorad_page=mysql_query("SELECT * FROM `user` LIMIT ".$start.",".$per_page);
 $numrow=mysql_num_rows($recorad_page); 
 
 
 $recorad=mysql_query("SELECT * FROM `user`");
 $totalrow=mysql_num_rows($recorad) ;
  
  //echo $totalrow; die;
 ?> 
 <div class="box-inner">   
   <div id="content" class="col-lg-10 col-sm-10">
        <div class="box-content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                           
                            <th>Email</th>
                            <th>Password</th>
							<th>Role</th>
                            <th>Date registered</th>
                            <th>Last login</th>
                            <th>Status</th>
							<th>Action</th>
                        </tr>
                        </thead>
						<tbody>
                   <?php 
					if($numrow>0){	
						while($row = mysql_fetch_array($recorad_page)){?>
						
                        <tr>
						
                            
                            <td><?Php echo $row['email'];?></td>
                            <td><?Php echo $row['passhash'];?></td>
							<td class="center">
							<span class="label-default label">USer</span>
                            </td>
                            <td><?Php echo $row['reg_date'];?></td>
                            <td><?Php echo $row['last_login'];?></td>
                            <td class="center">
							<?php if($row['group']==2){?>
                                <span class="label-success label label-default">Active</span>
								<?php } else {?>
								<span class="label-default label">Inactive</span>
								<?php }?>
                            </td>
							<td class="center">
                                <a href="user_view.php?id=<?php echo $row['id'];?>"class="btn btn-success" href="#">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    View
                                </a>
                                <a href="edit_user.php?id=<?php echo $row['id'];?>"class="btn btn-info" href="#">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Edit
                                </a>
                                <a href="user_delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger" href="#">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Delete
                                </a>
                            </td>
                            
                        </tr>
						<?php }
							}else{?>
							
							<tr><td colspan="5" style="text-align:center;">No record found.</td></tr>
							<?php }?>
                        </tbody>

						</table>
						
				<?php if($totalrow>0){?>
						<ul class="pagination pagination-centered paging">
                       <?php for($i=1;$i<=$totalrow;$i++){?>
                        <li class="" id="li_<?php echo $i;?>">
                            <a href="user_listing.php?page=<?php echo $i;?>" id="pageNumber_<?php echo $i;?>"><?php echo $i;?></a>
                        </li>
                        <?php } ?>
                        
                    </ul>
					<?php }?>
			   </div>
			</div>
		</div>
<script type ="text/javascript">
	$(document).ready(function(){
		var page = '<?php echo isset($_GET['page'])?$_GET['page']:'1';?>';
		$('#li_'+page).addClass('active');
		$('#pageNumber_'+page).attr('href','javascript:');
	
	});
</script>		
<?php  include('footer.php'); ?>