
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-envelope"></i> Email Templates</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
               
                <table class="table  table-bordered responsive">
                    <thead>
                        <tr>
                           <th><?php echo $this->Paginator->sort('Template.name', 'Template Name') ?></th>
                            <th>Template Subject</th>
                            <th>Date Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="content_updates">
                        <?php
                        if (!empty($data)) {
                            foreach ($data as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $value['Template']['name']; ?></td>
                                    <td><?php echo $value['Template']['subject']; ?></td>
                                    <td class="center"><?php echo $this->Time->format($value['Template']['modified'], '%B %e, %Y %H:%M %p'); ?></td>
                                    <td class="center">
                                        <?php //echo $this->Html->link(' <i class="glyphicon glyphicon-zoom-in icon-white"></i>View', 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-success view_user', 'data-id' => $value['Template']['id'])); ?>
                                        <?php echo $this->Html->link(' <i class="glyphicon glyphicon-edit icon-white"></i> Edit', array('admin' => true, 'controller' => 'templates', 'action' => 'edit', $value['Template']['id']), array('escape' => false, 'class' => 'btn btn-info')); ?>
                                        <?php //echo $this->Html->link(' <i class="glyphicon glyphicon-trash icon-white"></i> Delete', array('admin' => true, 'controller' => 'templates', 'action' => 'delete', $value['Template']['id']), array('escape' => false, 'class' => 'btn btn-danger','onclick'=>'javascript:return confirm_delete(this);')); ?>
                                    </td>
                                </tr>

                                <?php
                            }
                        } else {
                            ?>
                            <tr><td colspan="5" style="text-align: center;">No Record Found.</td></tr>
                        <?php }
                        ?>
                    </tbody>

                </table>

                <div class="row">
                    <div class="col-xs-12">  
                    <?php echo $this->element('admin/pagination'); ?>
                     </div>      
                </div>


            </div>
        </div>
    </div>
    <!--/span-->
  
</div><!--/row-->
<style type="text/css">
    label{
        float: left;
        margin: 3% 5% 0 0;
    }
    .form-control{
        width: 76%;
    }
    a:hover, a:focus {
        text-decoration: none;
    }
    .pagination{
        margin: 0 auto;
    }
</style>

<?php echo $this->Js->writeBuffer(); ?>
