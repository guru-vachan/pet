<?php //Security::cipher($this->request->data['User']['email'], 'mykey');     ?>  
<div class="well col-md-5 center login-box">
    <div class="alert alert-info">
        <?php
        $msg = $this->Session->flash() . $this->Session->flash('auth');
        echo (!empty($msg)) ? $msg : 'Please login with your Username and Password.'
        ?>
    </div>
    <?php echo $this->Form->create('User', array('class' => 'form-horizontal', 'inputDefaults' => array('div' => array('class' => 'input-group input-group-lg'), 'label' => false))); ?>

    <fieldset>
        <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email address', 'before' => ' <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>', 'between' => '')); ?>
        <div class="clearfix"></div><br>
        <?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password', 'before' => '<span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>')); ?>
        <div class="clearfix"></div>
        <!--        <div class="input-prepend">
                    <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>
                </div>-->
        <div class="clearfix"></div>

        <p class="center col-md-5">
            <?php
            echo $this->Form->submit('Login', array('class' => 'btn btn-primary', 'div' => false));
            echo $this->Form->end();
            ?>
        </p>
    </fieldset>
</form>
</div>
<!--/span-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4>Settings</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger invalid_token">
                    <button  class="close invalid_token_close" type="button">×</button>
                    Invalid token,please enter valid token.
                </div>
                <?php
                echo $this->Form->create('User', array('id' => 'LoginToken'));
                $email = isset($this->request->data['User']['email']) ? base64_encode($this->request->data['User']['email']) : '';
                //$pass = isset($this->request->data['User']['password']) ? base64_encode($this->request->data['User']['password']) : '';
                echo $this->Form->input('token', array('class' => 'form-control', 'placeholder' => 'Token'));
                echo $this->Form->hidden('email', array('value' => $email));
                //echo $this->Form->hidden('password', array('value' => $pass));
                ?>
            </div>
            <div class="modal-footer">
                <a href="javascript:" class="btn btn-default" data-dismiss="modal">Close</a>
                <a href="javascript:" class="btn btn-primary" id="login_from_token">Submit</a>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<?php if (isset($user) && $user) { ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.invalid_token').hide();
            $('#myModal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#login_from_token').on('click', function() {
                datastring = $('#LoginToken').serialize();
                $.ajax({
                    url: "<?php echo Router::url(array('controller' => 'users', 'action' => 'login', 'admin' => true)); ?>",
                    type: 'POST',
                    data: datastring,
                    success: function(data, textStatus, jqXHR) {
                        if ($.trim(data) == 'failed') {
                            $('.invalid_token').show('slow');
                        } else {
                            $('#myModal').modal('hide');
                            window.location.href = '<?php echo Router::url(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true)); ?>'
                        }
                    }

                });
            });
            $('.invalid_token_close').on('click', function() {
                $(this).parent().hide('slow');
            });

        });
    </script>
    <?php
}?>