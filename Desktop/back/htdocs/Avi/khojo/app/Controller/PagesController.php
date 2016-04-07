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
class PagesController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array();
    public $helpers = array('Ck');

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     * @throws NotFoundException When the view file could not be found
     * 	or MissingViewException in debug mode.
     */
    public function display() {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
        $this->set(compact('page', 'subpage', 'title_for_layout'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingViewException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

    public function admin_index() {
        //$this->Prg->commonProcess();
        $this->Paginator->settings = array(
            'conditions' => array($this->Page->parseCriteria($this->Prg->parsedParams())),
            'limit' => Configure::read('AdminPageLimit')
        );
        $pages = $this->Paginator->paginate('Page');
        $this->set('data', $pages);
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
     * edit existing admin
     */
    public function admin_edit($id = null) {

        $this->Page->id = $id;
        if (!$this->Page->exists()) {
            throw new NotFoundException(__('Invalid Page'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

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
        } else {
            $this->request->data = $this->Page->read(null, $id);
        }
    }

    public function admin_status($id = NULL) {
        ($this->Page->toggleStatus($id)) ? $this->Session->setFlash(__('Page status has been changed'), 'admin/admin_flash_success') : $this->Session->setFlash(__('Page status does not changed'), 'admin/admin_flash_error');
        $this->redirect(array('action' => 'index'));
    }

    public function admin_process() {
        if (!empty($this->request->data)) {
            $pageIds = $this->request->data['Page']['id'];
            $action = Sanitize::escape($this->request->data['Page']['action']);
            if ($action == "activate") {
                $this->Page->updateAll(array('Page.status' => Configure::read('Status.active')), array('Page.id' => $pageIds));
                $this->Session->setFlash('Pages have been activated successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
            if ($action == "inactivate") {
                $this->Page->updateAll(array('Page.status' => Configure::read('Status.inactive')), array('Page.id' => $pageIds));
                $this->Session->setFlash('Pages have been deactivated successfully', 'admin/admin_flash_success');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

}
