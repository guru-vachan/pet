<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersController
 *
 * @author vijayj
 */
App::uses('Sanitize', 'Utility');
App::uses('Security', 'Utility');

class UsersController extends AppController {

    var $components = array('Search.Prg', 'Paginator', 'Captcha');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function admin_index() {
        $this->set('title_for_layout', __(' Advertisers', true));
        $this->Prg->commonProcess();
        $this->Paginator->settings = array(
            'conditions' => array('User.role_id' => 2, $this->User->parseCriteria($this->Prg->parsedParams())),
            'limit' => Configure::read('AdminPageLimit')
        );
        $users = $this->Paginator->paginate('User');
        $this->set('data', $users);
    }

    public function admin_login() {

        $this->layout = 'admin_login';
        $this->set('title_for_layout', __('Admin Login', true));
        //if already logged-in, redirect
        if ($this->Session->check('Auth.Admin')) {
            $this->redirect(array('action' => 'dashboard'));
        }
		if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                if ($this->request->is('post')) {
                    $this->request->data['User']['password'] = "";
                    $this->Session->setFlash(__('Invalid email or password, try again'));
                }
            }
    }

    public function admin_dashboard() {
        //echo 'dashboard';die;
        //pr($this->Auth->user());
        $this->set('title_for_layout', __('Dashboard', true));
        $this->loadModel('Industry');
        $this->loadModel('Investment');
        $this->loadModel('Location');
        $totalUsers = $this->User->find('count', array('conditions' => array('User.role_id' => 2)));
        $totalIndustries = $this->Industry->find('count');
        $totalInvestments = $this->Investment->find('count');
        $totalLocations = $this->Location->find('count');
        $this->set(compact('totalUsers', 'totalIndustries', 'totalInvestments', 'totalLocations'));
    }

    public function admin_logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function admin_profile() {
        $id = $this->Auth->user('id');
        $this->set('title_for_layout', __('Admin Profile', true));
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->request->data)) {
                $this->User->set($this->request->data);
                $this->User->setValidation('add_user');
                if ($this->User->validates()) {
                    $this->request->data = Sanitize::clean($this->request->data);
                    if ($this->User->save($this->request->data)) {
                        $user = $this->User->read(null, $this->User->id);
                        $this->Session->write(AuthComponent::$sessionKey, $user['User']);
                        $this->Session->setFlash(__('Profile has been updated successfully'), 'admin/admin_flash_success');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->Session->setFlash(__('Profile could not be updated. Please, try again.'), 'admin/admin_flash_error');
                    }
                } else {
                    $this->Session->setFlash('Profile could not be updated.  Please, correct errors.', 'admin/admin_flash_error');
                }
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }

    public function admin_add() {
        $this->set('title_for_layout', __('Add Advertiser', true));

        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $this->User->set($this->request->data);
                $this->User->setValidation('add_user');
                if ($this->User->validates()) {
                    $this->request->data = Sanitize::clean($this->request->data);
                    $this->request->data['User']['role_id'] = 2;
                    $this->request->data['User']['status'] = Configure::read('Status.active');
                    if ($this->User->save($this->request->data)) {
                        $this->loadModel('Template');
                        $template = $this->Template->findBySlug('user_registration');
                        $email_subject = $template['Template']['subject'];
                        $subject = __('[' . Configure::read('Site.Title') . '] ' . $email_subject . '', true);
                        $message = str_replace(array('{NAME}', '{SITE}', '{USERNAME}', '{PASSWORD}'), array($this->request->data['User']['first_name'] . ' ' . $this->request->data['User']['last_name'], Configure::read('Site.Title'), $this->request->data['User']['email'], $this->request->data['User']['password']), $template['Template']['content']);
                        $this->sendMail($this->request->data['User']['email'], $subject, $message, array(Configure::read('AdminEmail') => Configure::read('Site.Title')));
                        $this->Session->setFlash(__('Advertiser has been created successfully'), 'admin/admin_flash_success');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->Session->setFlash(__('User could not be created. Please, try again.'), 'admin/admin_flash_error');
                    }
                } else {

                    $this->Session->setFlash('User could not be created.  Please, correct errors.', 'admin/admin_flash_error');
                }
            }
        }
    }

    public function admin_edit($id) {
        $this->set('title_for_layout', __('Edit Advertiser', true));
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->request->data)) {
                $this->User->set($this->request->data);
                $this->User->setValidation('add_user');
                if ($this->User->validates()) {
                    $this->request->data = Sanitize::clean($this->request->data);
                    if ($this->User->save($this->request->data)) {
                        $this->Session->setFlash(__('Advertiser has been updated successfully'), 'admin/admin_flash_success');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->Session->setFlash(__('User could not be updated. Please, try again.'), 'admin/admin_flash_error');
                    }
                } else {

                    $this->Session->setFlash('User could not be updated.  Please, correct errors.', 'admin/admin_flash_error');
                }
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }

    public function admin_status($id = NULL) {
        ($this->User->toggleStatus($id)) ? $this->Session->setFlash(__('Advertiser status has been changed'), 'admin/admin_flash_success') : $this->Session->setFlash(__('Advertiser status does not changed'), 'admin/admin_flash_error');
        $this->redirect(array('action' => 'index'));
    }

    /* public function admin_view() {
      $id = $this->request->data['id'];
      $data = $this->User->read(null, $id);
      $this->set('userDetail', $data);
      } */

    /*
     * delete existing user
     */

    public function admin_delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid Advertiser'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('Advertiser deleted successfully'), 'admin/admin_flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Advertiser was not deleted', 'admin/admin_flash_error'));
        $this->redirect(array('action' => 'index'));
    }

    public function admin_process() {
        if (!empty($this->request->data)) {
            $userIds = $this->request->data['User']['id'];
            $action = Sanitize::escape($this->request->data['User']['action']);
            if ($action == "delete") {
                $this->User->deleteAll(array('User.id' => $userIds));
                $this->Session->setFlash('Advertisers have been deleted successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
            if ($action == "activate") {
                $this->User->updateAll(array('User.status' => Configure::read('Status.active')), array('User.id' => $userIds));
                $this->Session->setFlash('Advertisers have been activated successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
            if ($action == "inactivate") {
                $this->User->updateAll(array('User.status' => Configure::read('Status.inactive')), array('User.id' => $userIds));
                $this->Session->setFlash('Advertisers have been deactivated successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function admin_change_password() {
        $this->set('title_for_layout', __('Change Password', true));
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $this->User->set($this->request->data);
                $this->User->setValidation('change_password');
                if ($this->User->validates()) {
                    $this->request->data = Sanitize::clean($this->request->data);
                    $this->User->id = $this->Auth->user('id');
                    if ($this->User->save($this->request->data)) {
                        $this->Session->setFlash(__('Password changed successfully'), 'admin/admin_flash_success');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->Session->setFlash(__('Password could not be changed. Please, try again.'), 'admin/admin_flash_error');
                    }
                } else {

                    $this->Session->setFlash('Password could not be changed.  Please, correct errors.', 'admin/admin_flash_error');
                }
            }
        }
    }


}
