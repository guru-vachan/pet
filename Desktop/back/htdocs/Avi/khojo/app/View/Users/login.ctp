
<div class="well col-md-5 center login-box">
    <div class="alert alert-info">
       <?php 
        $msg = $this->Session->flash() . $this->Session->flash('auth');
        echo (!empty($msg))?$msg:'Please login with your Username and Password.'
        ?>
    </div>
    <?php echo $this->Form->create('User', array('class' => 'form-horizontal', 'inputDefaults' => array('div' => array('class' => 'input-group input-group-lg'), 'label' => false))); ?>

    <fieldset>
        <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email address', 'before' => ' <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>', 'between' => '')); ?>
        <div class="clearfix"></div><br>
        <?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password', 'before' => '<span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>')); ?>
        <div class="clearfix"></div>
        <div class="input-prepend">
            <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>
        </div>
        <div class="clearfix"></div>

        <p class="center col-md-5">
            <?php
            echo $this->Form->submit('Login', array('class' => 'btn btn-primary', 'div' => false));
            echo $this->Html->link('Register',array('controller' => 'users', 'action' => 'register'));
            echo $this->Form->end();
            ?>
        </p>
    </fieldset>
</form>
</div>
<!--/span-->
