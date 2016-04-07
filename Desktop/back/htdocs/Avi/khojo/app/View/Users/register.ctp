<?php
echo $this->Form->create('User', array('class' => 'form-horizontal', 'inputDefaults' => array('div' => array('class' => 'form-group')), 'novalidate' => true));
echo $this->Form->input('first_name', array('class' => 'form-control', 'placeholder' => 'First Name', 'label' => 'First Name <span class="req"> *</span>'));
echo $this->Form->input('last_name', array('class' => 'form-control', 'placeholder' => 'Last Name', 'label' => 'Last Name <span class="req"> *</span>'));
echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email address', 'label' => 'Email address <span class="req"> *</span>'));
echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password', 'label' => 'Password <span class="req"> *</span>'));
echo $this->Form->input('confirm_password', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm password', 'label' => 'Confirm password <span class="req"> *</span>'));
echo $this->Form->input('industry_id', array('empty' => 'choose one', 'label' => 'Select Industry', 'options' => $industries));
echo $this->Form->input('investment_id', array('empty' => 'choose one', 'label' => 'Select Investment', 'options' => $investments));
echo $this->Form->input('location_id', array('empty' => 'choose one', 'label' => 'Select Location', 'options' => $locations));
echo $this->Form->input('referred_by', array('class' => 'form-control', 'placeholder' => 'Referred By', 'label' => 'Referred By'));
echo $this->Html->image($this->Html->url(array('controller' => 'users', 'action' => 'captcha'), true), array('id' => 'img-captcha', 'vspace' => 2));
echo '<a href="javascript:" id="a-reload">Can\'t read? Reload</a>';
echo $this->Form->input('captcha', array('autocomplete' => 'off', 'label' => 'Enter security code shown above: <span class="req"> *</span', 'class' => ''));
echo $this->Form->submit('Submit', array('class' => 'btn btn-default', 'div' => false));
echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $this->Html->link('Cancel', array('controller' => 'users', 'action' => 'login'), array('escape' => false, 'class' => 'btn btn-default'));
echo $this->Form->end();
?>
<script>
    $('#a-reload').click(function() {
        var $captcha = $("#img-captcha");
        $captcha.attr('src', $captcha.attr('src') + '?' + Math.random());
        return false;
    });
</script>