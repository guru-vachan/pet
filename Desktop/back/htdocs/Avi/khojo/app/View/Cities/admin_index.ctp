
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Cities</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <?php
                echo $this->Form->create('City', array('inputDefaults' => array('div' => array('class' => 'form-group col-md-8'))));
                echo $this->Form->input('city_name', array('class' => 'form-control', 'placeholder' => 'City Name', 'label' => 'City Name'));
                echo $this->Form->submit('Search', array('class' => 'btn btn-default', 'div' => false, 'before' => '<p>', 'after' => '</p>'));
                echo $this->Form->end();
                ?>
                <table class="table  table-bordered responsive">
                    <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('City.city_name', 'City Name') ?></th>
                            <th>Date Updated</th>
                            <th><?php echo $this->Paginator->sort('City.status', 'Status') ?></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="content_updates">
                        <?php
                        if (!empty($data)) {
                            foreach ($data as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $value['City']['city_name']; ?></td>
                                    <td class="center"><?php echo !empty($value['City']['modified'])?$this->Time->format($value['City']['modified'], '%B %e, %Y %H:%M %p'):$this->Time->format($value['City']['created'], '%B %e, %Y %H:%M %p'); ?></td>
                                    <td class="center">
                                        <?php echo $this->Html->link(($value['City']['status'] == 1) ? '<span class="label-success label label-default">Active</span>' : '<span class="label-default label label-danger">Inactive</span>', array('admin' => true, 'controller' => 'cities', 'action' => 'status', $value['City']['id']), array('escape' => false)); ?>

                                    </td>
                                    <td class="center">
                                        <?php //echo $this->Html->link(' <i class="glyphicon glyphicon-zoom-in icon-white"></i>View', 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-success view_paln', 'data-id' => $value['City']['id'])); ?>
                                        <?php echo $this->Html->link(' <i class="glyphicon glyphicon-edit icon-white"></i> Edit', array('admin' => true, 'controller' => 'cities', 'action' => 'edit', $value['City']['id']), array('escape' => false, 'class' => 'btn btn-info')); ?>
                                        <?php echo $this->Html->link(' <i class="glyphicon glyphicon-trash icon-white"></i> Delete', array('admin' => true, 'controller' => 'cities', 'action' => 'delete', $value['City']['id']), array('escape' => false, 'class' => 'btn btn-danger', 'onclick' => 'javascript:return confirm_delete(this);')); ?>
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
