<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Spools Controller
 *
 * @property Spool $Spool
 * @property PaginatorComponent $Paginator
 */
class SpoolsController extends AppController {

	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('title_for_layout', __(ucfirst('spools')));
		$this->Auth->allow('active');
	}

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is('post')) {
            $this->Paginator->settings = $this->Spool->action($this->request->data);
            echo $this->Session->setFlash('Filtro definido!', 'layout/success');
        }
		$this->Spool->recursive = 0;
		$this->set('spools', $this->Paginator->paginate());
	}

	public function active() {
		$this->Spool->recursive = 0;
		$this->Paginator->settings = array(
			'conditions' => array(
				'Spool.status' => true,
				'Spool.user_id' => $this->Session->read("Auth.User.id")
			)
		);

		$this->set('spools', $this->Paginator->paginate());
	}
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Spool->exists($id)) {
			throw new NotFoundException(__('Inválido spool'));
		}
		$options = array('conditions' => array('Spool.' . $this->Spool->primaryKey => $id));
		$this->set('spool', $this->Spool->find('first', $options));
	}

	public function app_view($id = null) {
		if (!$this->Spool->exists($id)) {
			throw new NotFoundException(__('Inválido spool'));
		}
		$options = array('conditions' => array('Spool.' . $this->Spool->primaryKey => $id));
		$this->set('spool', $this->Spool->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$name = ""; 
			foreach ($this->request->data['Spool']['file'] as $nome)
				$name .= $nome['name']."; ";

			$this->Spool->create();

			if ($this->Spool->save($this->request->data)) {
				$this->Session->setFlash(__('Impressão enviada.'), 'layout/success');

				$this->Spool->User->recursive = -1;
				$user = $this->Spool->User->read(array('name', 'email'), $this->request->data['Spool']['user_id']);
				$this->Spool->sendEmail($user['User']['email'], 'Impressão enviada: '.$name );

				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Impressão não pôde ser enviada. (Arquivos válidos: pdf, txt, png, jpge).'), 'layout/error');
			}
		}
		// $users = $this->Spool->User->find('list', array('conditions'=>array("User.id"=>$this->Session->read('Auth.User.id'))));
		$users = $this->Spool->User->find('list');
		$printers = $this->Spool->Printer->find('list');
		$this->set(compact('users', 'printers'));
	}

/**
 * add method
 *
 * @return void
 */
	public function addteste() {
		if ($this->request->is('post')) {

			$name = ""; 
			foreach ($this->request->data['Spool']['file'] as $nome)
				$name .= $nome['name']."; ";


			pr($this->request->data); exit;

			// $this->Spool->create();

			// if ($this->Spool->save($this->request->data)) {
			// 	$this->Session->setFlash(__('Impressão enviada.'), 'layout/success');

			// 	$this->Spool->User->recursive = -1;
			// 	$user = $this->Spool->User->read(array('name', 'email'), $this->request->data['Spool']['user_id']);
			// 	$this->Spool->sendEmail($user['User']['email'], 'Impressão enviada: '.$name );

			// 	return $this->redirect(array('action' => 'index'));
			// } else {
			// 	$this->Session->setFlash(__('Impressão não pôde ser enviada. (Arquivos válidos: pdf, txt, png, jpge).'), 'layout/error');
			// }
		}
		// $users = $this->Spool->User->find('list', array('conditions'=>array("User.id"=>$this->Session->read('Auth.User.id'))));
		$users = $this->Spool->User->find('list');
		$printers = $this->Spool->Printer->find('list');
		$this->set(compact('users', 'printers'));
	}

	public function app_add($id = null) {
		if ($this->request->is('post')) {
			
			$this->Spool->create();

			if ($this->Spool->save($this->request->data)) {
				$this->Session->setFlash(__('Impressão enviada.'), 'layout/success');				
				return $this->redirect(array('controller'=>'printers', 'action' => 'index'));

			} else {
				$this->Session->setFlash(__('Impressão não pôde ser enviada. (Arquivos válidos: pdf, txt, png, jpge).'), 'layout/error');
			}
		}

		$users_printers = $this->Spool->Printer->UsersPrinter->find("all", array(
			'conditions'=>array('UsersPrinter.user_id'=>$this->Session->read("Auth.User.id"))
		));

		$options_users_printers = array();
		$options_users_printers = array("Printer.allow" => true);			
		foreach ($users_printers as $users_printer) {
			$options_users_printers[] = array('Printer.id' => $users_printer['UsersPrinter']['printer_id']);
		}

		$options = array(
			'recursive' => -1,
			'conditions'=>array(
				"OR" => $options_users_printers
			),
		);
		if ( !empty($id) ) {
			$options['conditions'] += array('AND' => array("Printer.id"=>$id));
		}
		
		

		$users = $this->Spool->User->find('list', array('conditions'=>array("User.id"=>$this->Session->read('Auth.User.id'))));
		$printers = $this->Spool->Printer->find('list', $options);
		$this->set(compact('users', 'printers'));
	}

	public function app_upload() {
		$this->layout = 'ajax';
		$this->render(false);

		$data["Spool"] = array(
			'user_id'		=> $this->Session->read("Auth.User.id"),
			'printer_id'	=> $_REQUEST['print_id'],
			'host'			=> $_SERVER['REMOTE_ADDR'],
			'status' 		=> 1,
			'file'			=> array('0'=>$_FILES['file'])
		);

		$this->Spool->save($data);

		// pr($_REQUEST);
		// pr($_FILES);
		// pr($data);

		// exit;
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Spool->exists($id)) {
			throw new NotFoundException(__('Inválido spool'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Spool->save($this->request->data)) {
				$this->Session->setFlash(__('Foi salvo.'), 'layout/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não pôde ser salvo. Por favor, tente novamente.'), 'layout/error');
			}
		} else {
			$options = array('conditions' => array('Spool.' . $this->Spool->primaryKey => $id));
			$this->request->data = $this->Spool->find('first', $options);
		}
		$users = $this->Spool->User->find('list');
		$printers = $this->Spool->Printer->find('list');
		$this->set(compact('users', 'printers'));
	}
	

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Spool->id = $id;
		if (!$this->Spool->exists()) {
			throw new NotFoundException(__('Inválido spool'));
		}
		
		if ($this->Spool->delete()) {
	
			$this->Session->setFlash(__('Foi excluído.'), 'layout/success');
		} else {
			$this->Session->setFlash(__('Não foi excluído. Por favor, tente novamente.'), 'layout/error');
		}
		return $this->redirect(array('action' => 'index'));
	}}
