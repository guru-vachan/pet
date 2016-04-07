<?php echo ($this->Html->script(array('ckeditor/ckeditor'))); ?>
<div class="box-content">
    <?php
    echo $this->Form->create('Template', array('class' => 'form-horizontal', 'inputDefaults' => array('div' => array('class' => 'form-group')), 'novalidate' => true));
    echo $this->Form->hidden('id');
    echo $this->Form->input('subject', array('class' => 'form-control', 'placeholder' => 'Title'));
    echo $this->Ck->input('content');
    echo $this->Form->submit('Submit', array('class' => 'btn btn-default', 'div' => false));
     echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $this->Html->link('Cancel', array('admin' => true, 'controller' => 'templates', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-default'));
    echo $this->Form->end();
    ?>
</div> 
<script type="text/javascript">
    $(document).ready(function() {
        $("label").append('<span class="req"> *</span>');
    });
</script> 