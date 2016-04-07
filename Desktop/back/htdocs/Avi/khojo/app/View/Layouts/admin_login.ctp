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
        //echo $this->Html->script(array('jquery.min', 'charisma'));
        echo $this->Html->script(array('jquery.min', 'bootstrap.min', 'jquery.cookie', 'common','jquery.alerts', 'jquery.dataTables.min', 'chosen.jquery.min', 'responsive-tables', 'jquery.uploadify-3.1.min', 'jquery.autogrow-textarea', 'charisma'));
        echo $this->Html->css(array('bootstrap-cerulean.min.css', 'charisma-app.css'));
        ?>
    </head>
    <body>

        <div class="ch-container">
            <div class="row">
                <div class="col-md-12 center login-header">
                    <h2>Welcome to Khojo</h2>
                </div>
                <!--/span-->
            </div><!--/row-->
            <div class="row">
                <?php echo $this->fetch('content'); ?>

            </div><!--/row-->

        </div><!--/.fluid-container-->
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>
