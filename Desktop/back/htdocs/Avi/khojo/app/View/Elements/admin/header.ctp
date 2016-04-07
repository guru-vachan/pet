<!-- topbar starts -->
<div class="navbar navbar-default" role="navigation">

    <div class="navbar-inner">
        <button type="button" class="navbar-toggle pull-left animated flip">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?php echo $this->Html->link($this->Html->image('logo20.png', array('alt' => 'Leadgen Logo', 'class' => 'hidden-xs')) . '<span>Leadgen</span>', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'), array('escape' => false, 'class' => 'navbar-brand')); ?>


        <!-- user dropdown starts -->
        <div class="btn-group pull-right">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> 
                    <?php
                   //pr($this->Session->read('Auth.Admin'));
                    if ($this->Session->check('Auth.Admin.id')) { //checks if a user is logged in
                        echo $this->Session->read('Auth.Admin.first_name');
                    }
                    ?></span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <?php echo $this->Html->link('Profile', array('admin' => true, 'controller' => 'users', 'action' => 'profile'), array('escape' => false)); ?>
                </li>
                <li class="divider"></li>
                <li>
                    <?php echo $this->Html->link('Change Password', array('admin' => true, 'controller' => 'users', 'action' => 'change_password'), array('escape' => false)); ?>
                </li>
                <li class="divider"></li>
                <li>
                    <?php echo $this->Html->link('Logout', array('admin' => true, 'controller' => 'users', 'action' => 'logout'), array('escape' => false)); ?>
                </li>
                
            </ul>
        </div>
        <!-- user dropdown ends -->




    </div>
</div>
<!-- topbar ends -->