<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CitiesController
 *
 * @author vijayj
 */
App::uses('Sanitize', 'Utility');

class CitiesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function admin_index() {
        $this->Prg->commonProcess();
        $this->Paginator->settings = array(
            'conditions' => array($this->City->parseCriteria($this->Prg->parsedParams())),
             'order'=>array('City.city_name' => 'asc'),
            'limit' => Configure::read('AdminPageLimit')
        );
        $users = $this->Paginator->paginate('City');
        $this->set('data', $users);
    }

    public function admin_add() {
        $this->set('title_for_layout', __('Add City', true));
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $this->City->set($this->request->data);
                $this->City->setValidation('add_City');
                if ($this->City->validates()) {
                    $this->request->data = Sanitize::clean($this->request->data);
                    if ($this->City->save($this->request->data)) {
                        $this->Session->setFlash(__('City has been created successfully'), 'admin/admin_flash_success');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->Session->setFlash(__('City could not be created. Please, try again.'), 'admin/admin_flash_error');
                    }
                } else {

                    $this->Session->setFlash('City could not be created.  Please, correct errors.', 'admin/admin_flash_error');
                }
            }
        }
    }

    public function admin_edit($id) {
        $this->set('title_for_layout', __('Edit City', true));
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->request->data)) {
                $this->City->set($this->request->data);
                $this->City->setValidation('add_City');
                if ($this->City->validates()) {
                    $this->request->data = Sanitize::clean($this->request->data);
                    if ($this->City->save($this->request->data)) {
                        $this->Session->setFlash(__('City has been updated successfully'), 'admin/admin_flash_success');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->Session->setFlash(__('City could not be updated. Please, try again.'), 'admin/admin_flash_error');
                    }
                } else {

                    $this->Session->setFlash('City could not be updated.  Please, correct errors.', 'admin/admin_flash_error');
                }
            }
        } else {
            $this->request->data = $this->City->read(null, $id);
        }
    }

    public function admin_status($id = NULL) {
        ($this->City->toggleStatus($id)) ? $this->Session->setFlash(__('City status has been changed'), 'admin/admin_flash_success') : $this->Session->setFlash(__('City status does not changed'), 'admin/admin_flash_error');
        $this->redirect(array('action' => 'index'));
    }


    /*
     * delete existing Citys
     */

    public function admin_delete($id = null) {
        $this->City->id = $id;
        if (!$this->City->exists()) {
            throw new NotFoundException(__('Invalid City'));
        }
        if ($this->City->delete()) {
            $this->Session->setFlash(__('City deleted successfully'), 'admin/admin_flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('City was not deleted', 'admin/admin_flash_error'));
        $this->redirect(array('action' => 'index'));
    }

    public function admin_process() {
        if (!empty($this->request->data)) {
            $userIds = $this->request->data['City']['id'];
            $action = Sanitize::escape($this->request->data['City']['action']);
            if ($action == "delete") {
                $this->City->deleteAll(array('City.id' => $userIds));
                $this->Session->setFlash('Citys have been deleted successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
            if ($action == "activate") {
                $this->City->updateAll(array('City.status' => Configure::read('Status.active')), array('City.id' => $userIds));
                $this->Session->setFlash('Citys have been activated successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
            if ($action == "inactivate") {
                $this->City->updateAll(array('City.status' => Configure::read('Status.inactive')), array('City.id' => $userIds));
                $this->Session->setFlash('Citys have been deactivated successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
        }
    }


}
