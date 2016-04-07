
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> States</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <?php
                echo $this->Form->create('State', array('inputDefaults' => array('div' => array('class' => 'form-group col-md-8'))));
                echo $this->Form->input('state_name', array('class' => 'form-control', 'placeholder' => 'State Name', 'label' => 'State Name'));
                echo $this->Form->submit('Search', array('class' => 'btn btn-default', 'div' => false, 'before' => '<p>', 'after' => '</p>'));
                echo $this->Form->end();
                ?>
                <table class="table  table-bordered responsive">
                    <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('State.state_name', 'State Name') ?></th>
                            <th>Date Updated</th>
                            <th><?php echo $this->Paginator->sort('State.status', 'Status') ?></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="content_updates">
                        <?php
                        if (!empty($data)) {
                            foreach ($data as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $value['State']['state_name']; ?></td>
                                    <td class="center"><?php echo !empty($value['State']['modified'])?$this->Time->format($value['State']['modified'], '%B %e, %Y %H:%M %p'):$this->Time->format($value['State']['created'], '%B %e, %Y %H:%M %p'); ?></td>
                                    <td class="center">
                                        <?php echo $this->Html->link(($value['State']['status'] == 1) ? '<span class="label-success label label-default">Active</span>' : '<span class="label-default label label-danger">Inactive</span>', array('admin' => true, 'controller' => 'states', 'action' => 'status', $value['State']['id']), array('escape' => false)); ?>

                                    </td>
                                    <td class="center">
                                        <?php //echo $this->Html->link(' <i class="glyphicon glyphicon-zoom-in icon-white"></i>View', 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-success view_paln', 'data-id' => $value['State']['id'])); ?>
                                        <?php echo $this->Html->link(' <i class="glyphicon glyphicon-edit icon-white"></i> Edit', array('admin' => true, 'controller' => 'states', 'action' => 'edit', $value['State']['id']), array('escape' => false, 'class' => 'btn btn-info')); ?>
                                        <?php echo $this->Html->link(' <i class="glyphicon glyphicon-trash icon-white"></i> Delete', array('admin' => true, 'controller' => 'states', 'action' => 'delete', $value['State']['id']), array('escape' => false, 'class' => 'btn btn-danger', 'onclick' => 'javascript:return confirm_delete(this);')); ?>
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
        margin: 1% 2% 0 0;
    }
    .form-control{
        width: 50%;
    }
    a:hover, a:focus {
        text-decoration: none;
    }
    .pagination{
        margin: 0 auto;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        /*$('.view_user').on('click', function(e) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "<?php //echo Router::url(array('admin' => true, 'controller' => 'users', 'action' => 'view')) ?>",
                type: 'POST',
                data: {id: id},
                success: function(data) {
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            })

        });*/
        
    });
</script>
<?php echo $this->Js->writeBuffer(); ?>
