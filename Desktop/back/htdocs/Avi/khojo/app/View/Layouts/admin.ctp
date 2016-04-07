<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo Configure::read('Site.Title') . ' | ' . $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Html->script(array('jquery.min', 'bootstrap.min', 'jquery.cookie', 'common','jquery.alerts', 'jquery.dataTables.min', 'chosen.jquery.min', 'responsive-tables', 'jquery.uploadify-3.1.min', 'jquery.autogrow-textarea', 'charisma'));
        echo $this->Html->css(array('bootstrap-cerulean.min', 'charisma-app', 'chosen.min', 'responsive-tables','jquery.alerts'));
        ?>
    </head>
    <body>
        <?php echo $this->element('admin/header'); ?>
        <div class="ch-container">
            <div class="row">
                <?php echo $this->element('admin/left_nav'); ?>  
                <noscript>
                <div class="alert alert-block col-md-12">
                    <h4 class="alert-heading">Warning!</h4>

                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                        enabled to use this site.</p>
                </div>
                </noscript>
                <div id="content" class="col-lg-10 col-sm-10">
                    
                    <?php echo $this->Session->flash(); ?>
                    <?php
                    echo $this->Html->image('ajax-loaders/ajax-loader-5.gif', array('id' => 'busy-indicator', 'style' => 'display:none;position:absolute;top:62%;left:35%'));?>
                    <?php echo $this->fetch('content'); ?>
                </div>



            </div><!--/fluid-row-->
            <hr/>
            <?php echo $this->element('admin/footer'); ?>
            <?php echo $this->element('sql_dump'); ?>
        </div><!--/.fluid-container-->

    </body>
</html>
