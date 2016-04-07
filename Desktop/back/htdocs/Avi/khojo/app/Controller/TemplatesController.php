<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TemplatesController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array();
    public $helpers = array('Ck');

       public function admin_index() {
        $this->Paginator->settings = array(
              'conditions' => array('Template.status'=>Configure::read('Status.active')),
            'limit' => Configure::read('AdminPageLimit')
        );
        $emailTemplates = $this->Paginator->paginate('Template');
        $this->set('data', $emailTemplates);
    }

    /* public function admin_add() {
      if (!empty($this->request->data)) {
      //validate Page data
      $this->Page->set($this->request->data);
      $this->Page->setValidation('admin');
      if ($this->Page->validates()) {
      if ($this->Page->save($this->request->data)) {
      $this->Session->setFlash(__('The Page information has been updated successfully', true), 'admin/admin_flash_success');
      $this->redirect(array('action' => 'index'));
      } else {
      $this->Session->setFlash(__('The Page could not be saved. Please, try again.', true), 'admin/admin_flash_error');
      }
      } else {
      $this->Session->setFlash(__('The Page could not be saved. Please, correct errors.', true), 'admin/admin_flash_error');
      }
      }
      } */

    /**
     * edit existing templates
     */
    public function admin_edit($id = null) {

        $this->Template->id = $id;
        if (!$this->Template->exists()) {
            throw new NotFoundException(__('Invalid Template'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->request->data)) {
                //validate Template data
                $this->Template->set($this->request->data);
                $this->Template->setValidation('admin');
                if ($this->Template->validates()) {
                    if ($this->Template->save($this->request->data)) {
                        $this->Session->setFlash(__('The template information has been updated successfully', true), 'admin/admin_flash_success');
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('The template could not be saved. Please, try again.', true), 'admin/admin_flash_error');
                    }
                } else {
                    $this->Session->setFlash(__('The template could not be saved. Please, correct errors.', true), 'admin/admin_flash_error');
                }
            }
        } else {
            $this->request->data = $this->Template->read(null, $id);
        }
    }

    

}
