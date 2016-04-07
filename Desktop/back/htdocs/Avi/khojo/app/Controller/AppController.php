<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    var $components = array('Auth', 'Session', 'Paginator', 'RequestHandler', 'Search.Prg', 'Email');
    var $helpers = array('Time');

    public function beforeFilter() {

        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
            $this->layout = 'admin';
            $this->Auth->userModel = 'User';
            $this->Auth->authenticate = array('Form' => array('scope' => array('User.role_id' => 1,'User.status' =>Configure::read('Status.active')), 'fields' => array('username' => 'email')));
            $this->Auth->loginError = "Login failed. Invalid username or password";
            $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => true);
            $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dashboard', 'admin' => true);
            $this->Auth->autoRedirect = true;
            AuthComponent::$sessionKey = 'Auth.Admin';
            $this->Auth->allow('admin_login');
        } else {
            $this->Auth->userModel = 'User';
            $this->Auth->authenticate = array('Form' => array('scope' => array('User.role_id' =>array(2),'User.status' =>Configure::read('Status.active')), 'fields' => array('username' => 'email')));
            $this->Auth->loginError = "Login failed. Invalid username or password";
            $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
            $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dashboard');
            $this->Auth->autoRedirect = true;
            AuthComponent::$sessionKey = 'Auth.User';
            $this->Auth->allow('login', 'register', 'captcha');
        }
        $this->Auth->authorize = array('Controller');

        /**
         * trimming the all post values 
         */
        if ($this->request->is('post') || $this->request->is('put')) {
            array_walk_recursive(
                    $this->request->data, function(&$val, $key) {
                $val = trim($val);
            });
            $this->request->data = $this->request->data;
        }
    }

    public function isAuthorized() {
        return true;
        
    }

    public function getLastQuery($model) {
        $log = $this->{$model}->getDataSource()->getLog(false, false);
        debug($log);
    }

    public function beforeRender() {

        $response = new CakeResponse();
        $response->disableCache();
        parent::beforeRender();
    }

    public function sendMail($to, $subject, $message, $from) {
        $email = new CakeEmail('gmail');
        $email->template('default')
                ->from($from)
                ->emailFormat('html')
                ->to($to)
                ->subject($subject)
                ->send($message);
    }

}
