<?php
$model = Inflector::camelize(Inflector::singularize(str_replace('', '', $this->params['controller'])));
if($this->params['controller']=='reports'){
    $model = 'User';
}

?>

<!--<div class="col-xs-4">
    <div class="dataTables_info" id="example2_info"> <?php //echo $this->Paginator->counter('Showing {:start} to {:end} of {:count} entries');   ?></div>
</div>-->

    <?php
    if ($this->request->params['paging'][$model]['count'] > Configure::read('AdminPageLimit')) {
        $this->Paginator->options(array(
          'update' => '#content',
          'evalScripts' => true,
          'before' => $this->Js->get('#busy-indicator')->effect(
          'fadeIn', array('buffer' => false)
          ),
          'complete' => $this->Js->get('#busy-indicator')->effect(
          'fadeOut', array('buffer' => false)
          )
          )); 
        ?>

        <div class="dataTables_paginate paging_bootstrap center-block ">
            <ul class="pagination pagination-centered">
                <?php
                echo $this->Paginator->prev('← Previous', array('tag' => 'li', 'title' => __('Previous page'), 'disabledTag' => 'span', 'escape' => false), null, array('tag' => 'li', 'disabledTag' => 'span', 'escape' => false, 'class' => 'disabled'));
                echo $this->Paginator->numbers(array('separator' => false, 'tag' => 'li', 'currentTag' => 'span', 'currentClass' => 'active'));
                echo $this->Paginator->next('Next →', array('tag' => 'li', 'disabledTag' => 'span', 'title' => __('Next page'), 'escape' => false), null, array('tag' => 'li', 'disabledTag' => 'span', 'escape' => false, 'class' => 'disabled'));
                ?>
            </ul>
        </div>

    <?php } ?>
