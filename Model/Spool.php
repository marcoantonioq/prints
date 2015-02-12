<?php
App::uses('AppModel', 'Model');
/**
 * Spool Model
 *
 * @property User $User
 * @property Printer $Printer
 */
class Spool extends AppModel {

	public $order = array("Spool.updated"=>"DESC");


	public $actsAs = array(
	    'Upload' => array(
	        'File' => array(
	        	'field' => 'file',
	        	'field_dir' => 'file_dir',
	        )
	    )
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'printer_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'page' => array(
			'page' => array(
				'rule' => array('page_ranges'),
				'message' => 'Intervalo inválido',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'file' => array(
			'type' => array(
				'rule'=> array("typeFile"),
				'message' =>'Arquivo enviado é inválido!'
			),
			// 	'rule' => array('notEmpty'),
			// 	'message' => 'Selecione arquivo',
			// 	'allowEmpty' => false,
			// 	//'required' => false,
			// 	//'last' => false, // Stop validation after this rule
			// 	//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Printer' => array(
			'className' => 'Printer',
			'foreignKey' => 'printer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function afterSave($created, $options=array())
	{
		// pr($this->data); exit;
	}


	public function beforeSave($options=array())
	{
		// -U marcos -h 10.11.0.3
		$print = $this->Printer->find("first", array(
			'recursive'=>-1,
			'conditions'=>array("Printer.id"=>$this->data['Spool']['printer_id'])
		));

		$user = $this->User->find("first", array(
			'recursive'=>-1,
			'conditions'=>array("User.id"=>$this->data['Spool']['user_id'])
		));

		$this->data['Spool']['params'] = " -d {$print['Printer']['name']}";
		$this->data['Spool']['params'] .= " -U {$user['User']['suap']}";
		$this->data['Spool']['params'] .= " -o fit-to-page";
		
		// if (!empty($this->data['Spool']['host']))
		// 	$this->data['Spool']['params'] .= " -h  {$this->data['Spool']['host']}";

		if (!empty($this->data['Spool']['copies']))
			$this->data['Spool']['params'] .= " -n {$this->data['Spool']['copies']}";

		if (!empty($this->data['Spool']['pages']))
			$this->data['Spool']['params'] .= " -o page-ranges={$this->data['Spool']['pages']}";

		if (!empty($this->data['Spool']['double_sided']))
			$this->data['Spool']['params'] .= " -o sides={$this->data['Spool']['double_sided']}";

		if (!empty($this->data['Spool']['page_set']))
			$this->data['Spool']['params'] .= " -o page-set={$this->data['Spool']['page_set']}";
	
		if (!empty($this->data['Spool']['media']))
			$this->data['Spool']['params'] .= " -o media={$this->data['Spool']['media']}";
			
		if (!empty($this->data['Spool']['orientation']))
			$this->data['Spool']['params'] .= " -o orientation-requested={$this->data['Spool']['orientation']}";

		// pr($this->data); exit;
		// pr($this->data['Spool']['params']);
		// $this->data['Spool']['status'] = 0; // não imprimir		
	}


	public function page_ranges($data=array())
	{
		$search = array("/"," ",":",";");
		$this->data['Spool']['page'] = str_replace($search, ",",  $this->data['Spool']['page']);
		return true;
	}
}
