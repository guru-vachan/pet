<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndustrysController
 *
 * @author vijayj
 */
App::uses('Sanitize', 'Utility');

class IndustriesController extends AppController {

    var $components = array('Search.Prg', 'Paginator', 'Upload');
    public $mainImagePath, $thumbImagePath, $thumbWidth, $thumbheight;

    public function beforeFilter() {
        parent::beforeFilter();
        $this->mainImagePath = Configure::read('INDUSTRY.MAIN_ICON');
        $this->thumbImagePath = Configure::read('INDUSTRY.THUMB_ICON');
        $this->thumbWidth = Configure::read('INDUSTRY.THUMB_WIDTH');
        $this->thumbheight = Configure::read('INDUSTRY.THUMB_HEIGHT');
    }

    public function admin_index() {
        $this->Prg->commonProcess();
        $this->Paginator->settings = array(
            'conditions' => array($this->Industry->parseCriteria($this->Prg->parsedParams())),
            'order' => array('Industry.industry_title' => 'asc'),
            'limit' => Configure::read('AdminPageLimit')
        );
        $users = $this->Paginator->paginate('Industry');
        $this->set('data', $users);
    }

    public function admin_add() {
        //echo WEBROOT_DIR.' '.WWW_ROOT;
        $this->set('title_for_layout', __('Add Industry', true));
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $this->Industry->set($this->request->data);
                $this->Industry->setValidation('add_industry');
                if ($this->Industry->validates()) {
                    //$this->request->data = Sanitize::clean($this->request->data);
                    $file = array();
                    if (isset($this->request->data['Industry']['industry_icon']['name']) && !empty($this->request->data['Industry']['industry_icon']['name'])) {
                        $file = $this->request->data['Industry']['industry_icon'];
                        if (!empty($file) && $file['tmp_name'] != '' && $file['size'] > 0) {
                            $small_thumb = array('size' => array($this->thumbWidth, $this->thumbheight), 'type' => 'resizecrop');
                            $thumbResult = $this->Upload->upload($file, $this->thumbImagePath . DS, '', $small_thumb);
                            $res1 = $this->Upload->upload($file, $this->mainImagePath . DS, '');

                            if (!empty($this->Upload->result) && empty($this->Upload->errors)) {
                                $this->request->data['Industry']['industry_icon'] = $this->Upload->result;
                            }
                        }
                    }
                    $this->request->data = Sanitize::clean($this->request->data);
                    if ($this->Industry->save($this->request->data)) {
                        $this->Session->setFlash(__('Industry has been created successfully'), 'admin/admin_flash_success');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->Session->setFlash(__('Industry could not be created. Please, try again.'), 'admin/admin_flash_error');
                    }
                } else {

                    $this->Session->setFlash('Industry could not be created.  Please, correct errors.', 'admin/admin_flash_error');
                }
            }
        }
    }

    public function admin_edit($id) {
        $this->set('title_for_layout', __('Edit Industry', true));
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->request->data)) {
                $this->Industry->set($this->request->data);
                $this->Industry->setValidation('add_industry');
                if ($this->Industry->validates()) {
                    $file = array();
                    if (isset($this->request->data['Industry']['industry_icon']['name']) && !empty($this->request->data['Industry']['industry_icon']['name'])) {
                        $file = $this->request->data['Industry']['industry_icon'];
                        if (!empty($file) && $file['tmp_name'] != '' && $file['size'] > 0) {
                            $small_thumb = array('size' => array($this->thumbWidth, $this->thumbheight), 'type' => 'resizecrop');
                            $thumbResult = $this->Upload->upload($file, $this->thumbImagePath . DS, '', $small_thumb);
                            $res1 = $this->Upload->upload($file, $this->mainImagePath . DS, '');

                            if (!empty($this->Upload->result) && empty($this->Upload->errors)) {
                                $this->request->data['Industry']['industry_icon'] = $this->Upload->result;
                                if (file_exists($this->mainImagePath . DS . $this->request->data['Industry']['image1'])) {
                                    @unlink($this->mainImagePath . DS . $this->request->data['Industry']['image1']);
                                }
                                if (file_exists($this->thumbImagePath . DS . $this->request->data['Industry']['image1'])) {
                                    @unlink($this->thumbImagePath . DS . $this->request->data['Industry']['image1']);
                                }
                            }
                        }
                    } else {
                        $this->request->data['Industry']['industry_icon'] = isset($this->request->data['Industry']['image1']) ? $this->request->data['Industry']['image1'] : '';
                    }
                    $this->request->data = Sanitize::clean($this->request->data);
                    if ($this->Industry->save($this->request->data)) {
                        $this->Session->setFlash(__('Industry has been updated successfully'), 'admin/admin_flash_success');
                        $this->redirect(array('action' => 'admin_index'));
                    } else {
                        $this->Session->setFlash(__('Industry could not be updated. Please, try again.'), 'admin/admin_flash_error');
                    }
                } else {
                    if (!empty($this->request->data['Industry']['industry_icon']['error'])) {
                        $this->request->data['Industry']['industry_icon'] = isset($this->request->data['Industry']['image1']) ? $this->request->data['Industry']['image1'] : '';
                    }
                    $this->Session->setFlash('Industry could not be updated.  Please, correct errors.', 'admin/admin_flash_error');
                }
            }
        } else {
            $this->request->data = $this->Industry->read(null, $id);
        }
    }

    public function admin_status($id = NULL) {
        ($this->Industry->toggleStatus($id)) ? $this->Session->setFlash(__('Industry status has been changed'), 'admin/admin_flash_success') : $this->Session->setFlash(__('Industry status does not changed'), 'admin/admin_flash_error');
        $this->redirect(array('action' => 'index'));
    }

    /* public function admin_view() {
      $id = $this->request->data['id'];
      $data = $this->Industry->read(null, $id);
      $this->set('userDetail', $data);
      } */

    /*
     * delete existing industry
     */

    public function admin_delete($id = null) {
        $data = $this->Industry->read(null, $id);
        $this->Industry->id = $id;
        if (!$this->Industry->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->Industry->delete()) {
            if (file_exists($this->mainImagePath . DS . $data['Industry']['industry_icon'])) {
                @unlink($this->mainImagePath . DS . $data['Industry']['industry_icon']);
            }
            if (file_exists($this->thumbImagePath . DS . $data['Industry']['industry_icon'])) {
                @unlink($this->thumbImagePath . DS . $data['Industry']['industry_icon']);
            }
            $this->Session->setFlash(__('Industry deleted successfully'), 'admin/admin_flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Industry was not deleted', 'admin/admin_flash_error'));
        $this->redirect(array('action' => 'index'));
    }

    public function admin_process() {
        if (!empty($this->request->data)) {
            $userIds = $this->request->data['Industry']['id'];
            $action = Sanitize::escape($this->request->data['Industry']['action']);
            if ($action == "delete") {
                $this->Industry->deleteAll(array('Industry.id' => $userIds));
                $this->Session->setFlash('Industrys have been deleted successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
            if ($action == "activate") {
                $this->Industry->updateAll(array('Industry.status' => Configure::read('Status.active')), array('Industry.id' => $userIds));
                $this->Session->setFlash('Industrys have been activated successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
            if ($action == "inactivate") {
                $this->Industry->updateAll(array('Industry.status' => Configure::read('Status.inactive')), array('Industry.id' => $userIds));
                $this->Session->setFlash('Industrys have been deactivated successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

}
