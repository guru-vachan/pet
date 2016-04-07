<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-user blue"></i> <div>Total Advertisers</div> <div>' . $totalUsers . '</div>', array('admin' => true, 'controller' => 'users', 'action' => 'index'), array('class' => 'well top-block', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => $totalUsers . ' Advertisers.')); ?> 
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-star green"></i> <div>Total Industries</div> <div>' . $totalIndustries . '</div>', array('admin' => true, 'controller' => 'industries', 'action' => 'index'), array('class' => 'well top-block', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => $totalIndustries . ' Industries.')); ?> 
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-star-empty"></i> <div>Total Investments</div> <div>' . $totalInvestments . '</div>', array('admin' => true, 'controller' => 'investments', 'action' => 'index'), array('class' => 'well top-block', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => $totalInvestments . ' Investments.')); ?> 
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-signal"></i> <div>Total Locations</div> <div>' . $totalLocations . '</div>', array('admin' => true, 'controller' => 'locations', 'action' => 'index'), array('class' => 'well top-block', 'escape' => false, 'data-toggle' => 'tooltip', 'title' => $totalLocations . ' Locations.')); ?> 
    </div>
</div>