<!-- left menu starts -->
<div class="col-sm-2 col-lg-2">
    <div class="sidebar-nav">
        <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">

            </div>
            <ul class="nav nav-pills nav-stacked main-menu">

                <li><?php echo $this->Html->link('<i class="glyphicon glyphicon-home"></i><span> Dashboard</span>', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'), array('escape' => false, 'class' => 'ajax-link')); ?>
                </li>
                <!--<li class="accordion">
                    <?php echo $this->Html->link('<i class="glyphicon glyphicon-user"></i><span> Advertisers Manager</span>', 'javascript:void(0);', array('escape' => false)); ?>
                    
                    <ul class="nav nav-pills nav-stacked">
                        <li>  <?php echo $this->Html->link('Add New Advertiser', array('admin' => true, 'controller' => 'users', 'action' => 'add'), array('escape' => false)); ?></li>
                        <li>  <?php echo $this->Html->link('List Advertisers',array('admin' => true, 'controller' => 'users', 'action' => 'index'), array('escape' => false)); ?></li>
                    </ul>
                </li>-->
                <li><?php echo $this->Html->link('<i class="glyphicon glyphicon-book"></i><span> Content Manager</span>', array('admin' => true, 'controller' => 'pages', 'action' => 'index'), array('escape' => false, 'class' => 'ajax-link')); ?>
                </li>
                <li><?php echo $this->Html->link('<i class="glyphicon glyphicon-envelope"></i><span> Email Manager</span>', array('admin' => true, 'controller' => 'templates', 'action' => 'index'), array('escape' => false, 'class' => 'ajax-link')); ?></li>
                

                
                <li class="accordion">
                    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i><span> State Manager</span>', 'javascript:void(0);', array('escape' => false)); ?>
                    
                    <ul class="nav nav-pills nav-stacked">
                        <li>  <?php echo $this->Html->link('Add State', array('admin' => true, 'controller' => 'states', 'action' => 'add'), array('escape' => false)); ?></li>
                        <li>  <?php echo $this->Html->link('List States',array('admin' => true, 'controller' => 'states', 'action' => 'index'), array('escape' => false)); ?></li>
                    </ul>
                </li>
				<li class="accordion">
                    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i><span> City Manager</span>', 'javascript:void(0);', array('escape' => false)); ?>
                    
                    <ul class="nav nav-pills nav-stacked">
                        <li>  <?php echo $this->Html->link('Add City', array('admin' => true, 'controller' => 'cities', 'action' => 'add'), array('escape' => false)); ?></li>
                        <li>  <?php echo $this->Html->link('List Cities',array('admin' => true, 'controller' => 'cities', 'action' => 'index'), array('escape' => false)); ?></li>
                    </ul>
                </li>
				

            </ul>

        </div>
    </div>
</div>
<!--/span-->
<!-- left menu ends -->