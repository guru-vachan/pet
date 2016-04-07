<?php
ob_start();
 include('config.php');
  include('header.php');
  if(!isset($_SESSION['LoginUser']) && empty($_SESSION['LoginUser'])){
	header('Location:index.php');
}

$count_user=mysql_query("SELECT COUNT(*) as totat_user FROM users where role_id <> 1");

$total=mysql_fetch_row($count_user,MYSQL_ASSOC);
$count_category=mysql_query("SELECT COUNT(*) totat_categories FROM categories where parent_id = 0");

$total_c=mysql_fetch_array($count_category,MYSQL_ASSOC);

  ?> 
  <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Dashboard</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a href="user_listing.php" data-toggle="tooltip" title="<?php echo $total['totat_user'];?> new members." class="well top-block" href="#">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Total Users</div>
            <div><?php echo $total['totat_user'];?></div>
            <span class="notification"><?php echo $total['totat_user'];?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a href="category_listing.php"  data-toggle="tooltip" title="<?php echo $total_c['totat_categories'];?> new pro members." class="well top-block" href="#">
            <i class="glyphicon glyphicon-star green"></i>

            <div>Total Category</div>
            <div><?php echo $total_c['totat_categories'];?></div>
            <span class="notification green"><?php echo $total_c['totat_categories'];?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="$34 new sales." class="well top-block" href="#">
            <i class="glyphicon glyphicon-shopping-cart yellow"></i>

            <div>Sales</div>
            <div>$13320</div>
            <span class="notification yellow">$34</span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
            <i class="glyphicon glyphicon-envelope red"></i>

            <div>Messages</div>
            <div>25</div>
            <span class="notification red">12</span>
        </a>
    </div>
</div>
<?php include('footer.php'); ?>
