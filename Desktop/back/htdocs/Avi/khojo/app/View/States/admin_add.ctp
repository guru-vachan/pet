<div class="box-content">
    <?php
    echo $this->Form->create('State', array('class' => 'form-horizontal', 'inputDefaults' => array('div' => array('class' => 'form-group')), 'novalidate' => true));
    echo $this->Form->input('state_name', array('class' => 'form-control', 'placeholder' => 'State Name', 'label' => 'State Name <span class="req"> *</span>'));
    echo $this->Form->submit('Submit', array('class' => 'btn btn-default', 'div' => false));
    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $this->Html->link('Cancel', array('admin' => true, 'controller' => 'states', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-default'));
    echo $this->Form->end();
    ?>
</div> 

