<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LocationsController
 *
 * @author vijayj
 */
App::uses('Sanitize', 'Utility');

class StatesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function admin_index() {
        $this->Prg->commonProcess();
        $this->Paginator->settings = array(
            'conditions' => array($this->State->parseCriteria($this->Prg->parsedParams())),
             'order'=>array('State.State_title' => 'asc'),
            'limit' => Configure::read('AdminPageLimit')
        );
        $users = $this->Paginator->paginate('State');
        $this->set('data', $users);
    }

    public function admin_add() {
        $this->set('title_for_layout', __('Add State', true));
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $this->State->set($this->request->data);
                $this->State->setValidation('add_State');
                if ($this->State->validates()) {
                    $this->request->data = Sanitize::clean($this->request->data);
                    if ($this->State->save($this->request->data)) {
                        $this->Session->setFlash(__('State has been created successfully'), 'admin/admin_flash_success');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->Session->setFlash(__('State could not be created. Please, try again.'), 'admin/admin_flash_error');
                    }
                } else {

                    $this->Session->setFlash('State could not be created.  Please, correct errors.', 'admin/admin_flash_error');
                }
            }
        }
    }

    public function admin_edit($id) {
        $this->set('title_for_layout', __('Edit State', true));
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->request->data)) {
                $this->State->set($this->request->data);
                $this->State->setValidation('add_State');
                if ($this->State->validates()) {
                    $this->request->data = Sanitize::clean($this->request->data);
                    if ($this->State->save($this->request->data)) {
                        $this->Session->setFlash(__('State has been updated successfully'), 'admin/admin_flash_success');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->Session->setFlash(__('State could not be updated. Please, try again.'), 'admin/admin_flash_error');
                    }
                } else {

                    $this->Session->setFlash('State could not be updated.  Please, correct errors.', 'admin/admin_flash_error');
                }
            }
        } else {
            $this->request->data = $this->State->read(null, $id);
        }
    }

    public function admin_status($id = NULL) {
        ($this->State->toggleStatus($id)) ? $this->Session->setFlash(__('State status has been changed'), 'admin/admin_flash_success') : $this->Session->setFlash(__('State status does not changed'), 'admin/admin_flash_error');
        $this->redirect(array('action' => 'index'));
    }


    /*
     * delete existing states
     */

    public function admin_delete($id = null) {
        $this->State->id = $id;
        if (!$this->State->exists()) {
            throw new NotFoundException(__('Invalid state'));
        }
        if ($this->State->delete()) {
            $this->Session->setFlash(__('State deleted successfully'), 'admin/admin_flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('State was not deleted', 'admin/admin_flash_error'));
        $this->redirect(array('action' => 'index'));
    }

    public function admin_process() {
        if (!empty($this->request->data)) {
            $userIds = $this->request->data['State']['id'];
            $action = Sanitize::escape($this->request->data['State']['action']);
            if ($action == "delete") {
                $this->State->deleteAll(array('State.id' => $userIds));
                $this->Session->setFlash('States have been deleted successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
            if ($action == "activate") {
                $this->State->updateAll(array('State.status' => Configure::read('Status.active')), array('State.id' => $userIds));
                $this->Session->setFlash('States have been activated successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
            if ($action == "inactivate") {
                $this->State->updateAll(array('State.status' => Configure::read('Status.inactive')), array('State.id' => $userIds));
                $this->Session->setFlash('States have been deactivated successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
        }
    }


}
