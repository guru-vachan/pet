<?php echo ($this->Html->script(array('ckeditor/ckeditor'))); ?>
<div class="box-content">
    <?php
    echo $this->Form->create('Page', array('class' => 'form-horizontal', 'inputDefaults' => array('div' => array('class' => 'form-group')), 'novalidate' => true));
    echo $this->Form->hidden('id');
    echo $this->Form->input('title', array('class' => 'form-control', 'placeholder' => 'Title'));
    echo $this->Form->input('heading', array('class' => 'form-control', 'placeholder' => 'Heading', 'type' => 'text'));
    echo $this->Ck->input('content');
    echo $this->Form->input('meta_title', array('class' => 'form-control', 'placeholder' => 'Meta Title'));
    echo $this->Form->input('meta_keywords', array('class' => 'form-control', 'placeholder' => 'Meta Keywords'));
    echo $this->Form->input('meta_description', array('class' => 'form-control', 'placeholder' => 'Meta Description', 'rows' => '5', 'type' => 'textarea', 'escape' => false));

    echo $this->Form->submit('Submit', array('class' => 'btn btn-default', 'div' => false));
    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $this->Html->link('Cancel', array('admin' => true, 'controller' => 'pages', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-default'));
    echo $this->Form->end();
    ?>
</div> 
<script type="text/javascript">
    $(document).ready(function() {
        $("label").append('<span class="req"> *</span>');
    });
</script> 