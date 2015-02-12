<?php
App::uses('AppModel', 'Model');
/**
 * Printer Model
 *
 * @property Job $Job
 */
class Printer extends AppModel {
	public $displayFild = 'name';
	public $order = array('name'=>'asc');
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Job' => array(
			'className' => 'Job',
			'foreignKey' => 'printer_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array('Job.date'=>'desc'),
			'limit' => '30',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Spool' => array(
			'className' => 'Spool',
			'foreignKey' => 'printer_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);



/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'users_printers',
			'foreignKey' => 'printer_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

	

	// public function afterFind($results=array())
	// {
	// 	pr($results);
	// 	if (!empty($results['Job'])) {			
	// 		foreach ($results['Job'] as $key => $value) {
				
	// 		}
	// 	}
	// }

}
