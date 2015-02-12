<?php
App::uses('ServiceAppController', 'Service.Controller');
/**
 * Printers Controller
 *
 */

class PrintersController extends ServiceAppController {

	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('title_for_layout', __(ucfirst('printers')));
	}

	public function index() {
		pr($_SERVER['DOCUMENT_ROOT']);
		exit;

	}

}