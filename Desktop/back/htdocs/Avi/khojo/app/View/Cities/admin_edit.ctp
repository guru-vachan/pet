<div class="box-content">
    <?php
    echo $this->Form->create('City', array('class' => 'form-horizontal', 'inputDefaults' => array('div' => array('class' => 'form-group')), 'novalidate' => true));
    echo $this->Form->hidden('id');
    echo $this->Form->input('city_name', array('class' => 'form-control', 'placeholder' => 'City Name', 'label' => 'City Name <span class="req"> *</span>'));
    echo $this->Form->submit('Submit', array('class' => 'btn btn-default', 'div' => false));
    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $this->Html->link('Cancel', array('admin' => true, 'controller' => 'cities', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-default'));
    echo $this->Form->end();
    ?>
</div> 
