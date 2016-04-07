<div class="box-content">
    <?php
    echo $this->Form->create('User', array('class' => 'form-horizontal', 'inputDefaults' => array('div' => array('class' => 'form-group'))));
    echo $this->Form->input('old_password', array('class' => 'form-control', 'placeholder' => 'Old Password','type'=>'password'));
    echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password'));
    echo $this->Form->input('confirm_password', array('class' => 'form-control', 'placeholder' => 'Confirm Password','type'=>'password'));
    echo $this->Form->submit('Submit', array('class' => 'btn btn-default', 'div' => false));
    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $this->Html->link('Cancel', array('admin' => true, 'controller' => 'users', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-default'));
    echo $this->Form->end();
    ?>
</div> 
<script type="text/javascript">
    $(document).ready(function() {
        $("label").append('<span class="req"> *</span>');
    });
</script>