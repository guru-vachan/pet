<?php

foreach ($products as $key => $value) {
    ?>
    <div class="box">
        <div class="text"><?php echo $value->name; ?> </div>
        <div class="text"><?php echo $value->description; ?></div>
        <div class="text"><?php echo $value->interval . ' ' . ucfirst($value->interval_unit); ?></div>
        <div class="text"><?php echo '$' . ($value->price_in_cents / 100); ?></div>
<!--        <div class="text"><?php //echo $this->Html->link('Subscribe', array('admin' => false, 'controller' => 'users', 'action' => 'subscribe_plan', $value->id)); ?></div>-->
        <?php 
            
            $plan_id = $this->Session->read('Plans.UserPlan.plan_id');
            if(isset($plan_id) && $plan_id == $value->id){
        ?>
        <div class="text"><?php echo $this->Html->link('Cancel', 'https://franchiseisland.chargify.com/h/'.$value->id.'/subscriptions/new',array('target'=>'_blank')); ?></div>
            <?php } else { ?>
        <div class="text"><?php echo $this->Html->link('Subscribe', 'https://franchiseisland.chargify.com/h/'.$value->id.'/subscriptions/new',array('target'=>'_blank')); ?></div>
            <?php }?> 
    </div>
<?php }
?> 

<style type="text/css">
    .box {
        background-color: coral;
        width: 30%;
        display:inline-block;
        margin:10px 0;
        border-radius:5px;
    }
    .text {
        padding: 10px 0;
        color:white;
        font-weight:bold;
        text-align:center;
    }
</style>

<?php echo $this->Html->link('Logout', array('admin' => false, 'controller' => 'users', 'action' => 'logout'), array('escape' => false)); ?>