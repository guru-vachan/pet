
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-book"></i> Pages</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <?php
                /*echo $this->Form->create('Page', array('inputDefaults' => array('div' => array('class' => 'form-group col-md-4'))));
                echo $this->Form->input('title', array('class' => 'form-control', 'placeholder' => 'Title', 'label' => 'Name'));
                echo $this->Form->submit('Search', array('class' => 'btn btn-default', 'div' => false, 'before' => '<p>', 'after' => '</p>'));
                echo $this->Form->end();*/
                ?>
                <table class="table  table-bordered responsive">
                    <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort('Page.title', 'Page Title') ?></th>
                            <th>Page Slug</th>
                            <th>Date Created</th>
                            <th><?php echo $this->Paginator->sort('Page.status', 'Status') ?></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="content_updates">
                        <?php
                        if (!empty($data)) {
                            foreach ($data as $key => $value) {
                                ?>
                                <tr>
                                   <td><?php echo $value['Page']['title']; ?></td>
                                    <td><?php echo $value['Page']['slug']; ?></td>
                                    <td class="center"><?php echo $this->Time->format($value['Page']['modified'], '%B %e, %Y %H:%M %p'); ?></td>
                                    <td class="center">
                                        <?php echo $this->Html->link(($value['Page']['status'] == 1) ? '<span class="label-success label label-default">Active</span>' : '<span class="label-default label label-danger">Inactive</span>', array('admin' => true, 'controller' => 'pages', 'action' => 'status', $value['Page']['id']), array('escape' => false)); ?>

                                    </td>
                                    <td class="center">
                                        <?php //echo $this->Html->link(' <i class="glyphicon glyphicon-zoom-in icon-white"></i>View', 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-success view_user', 'data-id' => $value['Page']['id'])); ?>
                                        <?php echo $this->Html->link(' <i class="glyphicon glyphicon-edit icon-white"></i> Edit', array('admin' => true, 'controller' => 'pages', 'action' => 'edit', $value['Page']['id']), array('escape' => false, 'class' => 'btn btn-info')); ?>
                                        <?php //echo $this->Html->link(' <i class="glyphicon glyphicon-trash icon-white"></i> Delete', array('admin' => true, 'controller' => 'pages', 'action' => 'delete', $value['Page']['id']), array('escape' => false, 'class' => 'btn btn-danger','onclick'=>'javascript:return confirm_delete(this);')); ?>
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
                     <!--<div class="col-xs-6">
                       <div class="btn-group">
                            <?php
                            //echo $this->Html->link('<i class="glyphicon glyphicon-user icon-white"></i> Action', 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-primary'));
                            //echo $this->Html->link('<span class="caret"></span>', 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-primary dropdown-toggle', 'data-toggle' => 'dropdown'));
                            ?> 
                            <ul class="dropdown-menu user_action">
                                <li>
                                    <?php
                                    //echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>Activate', 'javascript:void(0);', array('escape' => false));
                                    ?>
                                </li>
                                <li>
                                    <?php
                                   // echo $this->Html->link('<i class="glyphicon glyphicon-ban-circle"></i>Inactivate', 'javascript:void(0);', array('escape' => false));
                                    ?>

                                <!--   <li>
                                    <?php
                                    //echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i>Delete', 'javascript:void(0);', array('escape' => false));
                                    ?>
                                </li>

                            </ul>

                        </div>
                    </div>-->
                    <div class="col-xs-6">   
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
<script type="text/javascript">
    $(document).ready(function() {
        
        $('.user_action li>a').on('click', function(e) {
            var action = $(this).text().toLowerCase();
            $('#PageAction').val(action);
            validateChk('PageAdminProcessForm', action);
        });

    });
</script>
<?php echo $this->Js->writeBuffer(); ?>
