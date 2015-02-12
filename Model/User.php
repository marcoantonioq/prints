<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Job $Job
 */
class User extends AppModel {
	public $displayFild = 'name';
	public $order = array('User.name'=>'asc');
	public $firstDay = '';

	public $actsAs = array(
	    'AD' => array()
	);
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		// 'name' => array(
		// 	'unique' => array(
		// 		'rule' => 'isUnique',
		// 		'required' => 'create',
		// 		'message' => 'Usuário existente',
		// 	)
		// ),
		'suap' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => 'isUnique',
				'required' => 'create',
				'message' => 'Usuário existente',
			)
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public static function firstDate($format='Y/m/01'){
		$this->firstDay = date('Y/m/01', strtotime('-1month'));
		return $this->firstDay;
	}

	public $hasMany = array(
		'Job' => array(
			'className' => 'Job',
			'foreignKey' => 'user_id',
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
			'foreignKey' => 'user_id',
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
		'Printer' => array(
			'className' => 'Printer',
			'joinTable' => 'users_printers',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'printer_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

/*
 *
	Functions
*/


	public function beforeSave($options = array()) 
	{
    	// if (empty($this->data['User']['password'])) {
     //        unset($this->data['User']['password']);
     //    } else {
     //    	$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
     //    }
	    return true;
    }  

    public function login($data) {

    	$suap = $data['User']['suap'];
    	$pass = $data['User']['password'];

    	if( $this->authUser($suap, $pass) ) 
    	{
    		$this->recursive = -1;
    		$user = $this->find("all", array(
    			'conditions'=>array("User.suap"=>$suap)
    		));

    		pr( $this->getUser($suap) );
	    	

    		if (empty($user)) {
    			// echo "cadastrar usuário";
    			$user['0']['User'] = array();
    		} else {
	    		$this->id = $user['0']['User']['id'];
    		}

	    	$user['0']['User']['suap'] = $suap;
	    	$user['0']['User']['password'] = AuthComponent::password($pass);


    		$user = $this->sycAD($user);
	    	$this->saveAll($user);
    	} 
    	else
    	{
    		// echo "Não logado";
    		return false;
    	}
    	// pr($user); exit;
	    return true;
    }

}
