<?php
App::uses('PrintersController', 'Service.Controller');

/**
 * PrintersController Test Case
 *
 */
class PrintersControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.service.printer',
		'plugin.service.job',
		'plugin.service.user',
		'plugin.service.department',
		'plugin.service.spool',
		'plugin.service.users_printer'
	);

}
