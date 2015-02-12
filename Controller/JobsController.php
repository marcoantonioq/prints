<?php
App::uses('AppController', 'Controller');
/**
 * Jobs Controller
 *
 * @property Job $Job
 * @property PaginatorComponent $Paginator
 */
class JobsController extends AppController {

	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('title_for_layout', __(ucfirst('jobs')));
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

            $this->Paginator->settings = $this->Job->action($this->request->data);
			//pr($this->Paginator->settings); exit;

            echo $this->Session->setFlash('Filtro definido!', 'layout/success');
			$this->Job->recursive = 0;
			$jobs = $this->Paginator->paginate();
			$this->set(compact('jobs'));
        } 
	}

	public function advanced() {
		if ($this->request->is('post')) {
            $this->Paginator->settings = $this->Job->action($this->request->data);
        	//pr($this->Paginator->settings); exit;

            echo $this->Session->setFlash('Filtro definido!', 'layout/success');
        }

        
		$this->Job->recursive = 0;
		$jobs = $this->Paginator->paginate();
		$this->set(compact('jobs'));
	}

	public function app_index() {

		if ($this->request->is('post')) {
            $this->Paginator->settings = $this->Job->action($this->request->data);
            echo $this->Session->setFlash('Filtro definido!', 'layout/success');
        }

		$this->Paginator->settings['conditions']['AND'] = array(
			'User.id' => $this->Session->read("Auth.User.id")
		);
        // pr($this->Paginator->settings);

		$this->Job->recursive = 0;
		$jobs = $this->Paginator->paginate();
		$this->set(compact('jobs'));
	}

	public function sync(){
		$this->render(false);
		$this->Job->recursive = -1;
		$jobs = $this->Job->find("all");
		$this->Job->sync($jobs);
		$this->redirect($this->referer());
	}


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Job->exists($id)) {
			throw new NotFoundException(__('Inválido job'));
		}
		$options = array('conditions' => array('Job.' . $this->Job->primaryKey => $id));
		$this->set('job', $this->Job->find('first', $options));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Job->create();
			if ($this->Job->save($this->request->data)) {
				$this->Session->setFlash(__('Foi salvo.'), 'layout/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não pôde ser salvo. Por favor, tente novamente.'), 'layout/error');
			}
		}
		$users = $this->Job->User->find('list', array('conditions'=>array("User.id"=>$this->Session->read('Auth.User.id'))));
		$printers = $this->Job->Printer->find('list');
		$this->set(compact('users', 'printers'));
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Job->exists($id)) {
			throw new NotFoundException(__('Inválido job'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Job->save($this->request->data)) {
				$this->Session->setFlash(__('Foi salvo.'), 'layout/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não pôde ser salvo. Por favor, tente novamente.'), 'layout/error');
			}
		} else {
			$options = array('conditions' => array('Job.' . $this->Job->primaryKey => $id));
			$this->request->data = $this->Job->find('first', $options);
		}
		$users = $this->Job->User->find('list');
		$printers = $this->Job->Printer->find('list');
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
		// pr($id); 
		// pr($this->request->data);
		// exit;
		$this->Job->id = $id;
		if (!$this->Job->exists()) {
			throw new NotFoundException(__('Inválido job'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Job->delete()) {
	
			$this->Session->setFlash(__('Foi excluído.'), 'layout/success');
		} else {
			$this->Session->setFlash(__('Não foi excluído. Por favor, tente novamente.'), 'layout/error');
		}
		return $this->redirect(array('action' => 'index'));
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function deleteall($id = null) {
		$message = 'Foi excluído.';
		foreach ($this->request->data['row'] as $id => $value) {
			if ($value) {
				$this->Job->id = $id;
				$this->request->onlyAllow('post', 'delete');
				if (!$this->Job->delete()) {		
					$message = 'Não foi excluído. Por favor, tente novamente.';
				}
				$this->Session->setFlash(__($message), 'layout/warning');
			}
		}
		return $this->redirect(array('action' => 'index'));
	}
}
