
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Advertisers</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <?php
                echo $this->Form->create('User', array('inputDefaults' => array('div' => array('class' => 'form-group col-md-4')),'novalidate' => true));
                echo $this->Form->input('first_name', array('class' => 'form-control', 'placeholder' => 'Name', 'label' => 'Name'));
                echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email address'));
                echo $this->Form->submit('Search', array('class' => 'btn btn-default', 'div' => false, 'before' => '<p>', 'after' => '</p>'));
                echo $this->Form->end();
                ?>
                <table class="table  table-bordered responsive">
                    <?php echo $this->Form->create('User', array('url' => array('admin' => true, 'controller' => 'users', 'action' => 'process'), 'id' => 'UserAdminProcessForm', 'name' => 'UserAdminProcessForm')); ?>
                    <thead>
                        <tr>
                            <th><?php echo $this->Form->checkbox('select_all', array('hiddenField' => false, 'class' => 'select_all')); ?></th>
                            <th><?php echo $this->Paginator->sort('User.first_name', 'Name') ?></th>
                            <th>Email</th>
                            <th>Date registered</th>
                            <th><?php echo $this->Paginator->sort('User.status', 'Status') ?></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="content_updates">
                        <?php
                        if (!empty($data)) {
                            foreach ($data as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $this->Form->checkbox('User.id][', array('hiddenField' => false, 'id' => 'UserId' . $value['User']['id'], 'value' => $value['User']['id'], 'class' => 'selectuserId')); ?></td>
                                    <td><?php echo $value['User']['first_name']; ?></td>
                                    <td class="center"><?php echo $value['User']['email']; ?></td>
                                    <td class="center"><?php echo $this->Time->format($value['User']['created'], '%B %e, %Y %H:%M %p'); ?></td>
                                    <td class="center">
                                        <?php echo $this->Html->link(($value['User']['status'] == 1) ? '<span class="label-success label label-default">Active</span>' : '<span class="label-default label label-danger">Inactive</span>', array('admin' => true, 'controller' => 'users', 'action' => 'status', $value['User']['id']), array('escape' => false)); ?>

                                    </td>
                                    <td class="center">
                                        <?php //echo $this->Html->link(' <i class="glyphicon glyphicon-zoom-in icon-white"></i>View', 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-success view_user', 'data-id' => $value['User']['id'])); ?>
                                        <?php echo $this->Html->link(' <i class="glyphicon glyphicon-edit icon-white"></i> Edit', array('admin' => true, 'controller' => 'users', 'action' => 'edit', $value['User']['id']), array('escape' => false, 'class' => 'btn btn-info')); ?>
                                        <?php echo $this->Html->link(' <i class="glyphicon glyphicon-trash icon-white"></i> Delete', array('admin' => true, 'controller' => 'users', 'action' => 'delete', $value['User']['id']), array('escape' => false, 'class' => 'btn btn-danger', 'onclick' => 'javascript:return confirm_delete(this);')); ?>
                                         <?php echo $this->Html->link(' <i class="glyphicon glyphicon-lock icon-white"></i> Login', 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-success view_user', 'data-id' => $value['User']['id'])); ?>
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

                    <?php
                    echo $this->Form->hidden('action');
                    echo $this->Form->end();
                    ?>
                </table>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="btn-group">
                            <?php
                            echo $this->Html->link('<i class="glyphicon glyphicon-user icon-white"></i> Action', 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-primary'));
                            echo $this->Html->link('<span class="caret"></span>', 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-primary dropdown-toggle', 'data-toggle' => 'dropdown'));
                            ?> 
                            <ul class="dropdown-menu user_action">
                                <li>
                                    <?php
                                    echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>Activate', 'javascript:void(0);', array('escape' => false));
                                    ?>
                                </li>
                                <li>
                                    <?php
                                    echo $this->Html->link('<i class="glyphicon glyphicon-ban-circle"></i>Inactivate', 'javascript:void(0);', array('escape' => false));
                                    ?>

                                <li>
                                    <?php
                                    echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i>Delete', 'javascript:void(0);', array('escape' => false));
                                    ?>
                                </li>

                            </ul>

                        </div>
                    </div>
                    <div class="col-xs-6">                     
                        <?php echo $this->element('admin/pagination'); ?>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <!--/span-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>View User</h3>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('.view_user').on('click', function(e) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo Router::url(array('admin' => false, 'controller' => 'users', 'action' => 'login')) ?>",
                type: 'POST',
                data: {id: id},
                success: function(data) {
                   
                    var url = "<?php echo Router::url(array('admin' => false, 'controller' => 'users', 'action' => 'dashboard')) ?>";
                   win = window.open(url, '_blank');
                   win.focus();
                }
            })

        });
        $('.user_action li>a').on('click', function(e) {
            var action = $(this).text().toLowerCase();
            $('#UserAction').val(action);
            validateChk('UserAdminProcessForm', action);
        });


        /*$(document).on('click', '.select_all',function() {
         if (this.checked) {
         $('.selectuserId').each(function() {
         this.checked = true;
         });
         } else {
         $('.selectuserId').each(function() {
         this.checked = false;
         });
         }
         });
         $(document).on('click', '.selectuserId',function() {
         
         if ($(".selectuserId").length == $(".selectuserId:checked").length) {
         $(".select_all").prop("checked", true);
         } else {
         $(".select_all").prop("checked",false);
         }
         
         });*/
        $('.select_all').on('click', function() {
            if (this.checked) {
                $('.selectuserId').each(function() {
                    this.checked = true;
                });
            } else {
                $('.selectuserId').each(function() {
                    this.checked = false;
                });
            }
        });
        $('.selectuserId').on('click', function() {

            if ($(".selectuserId").length == $(".selectuserId:checked").length) {
                $(".select_all").prop("checked", true);
            } else {
                $(".select_all").prop("checked", false);
            }

        });
    });
</script>
<?php echo $this->Js->writeBuffer(); ?>
