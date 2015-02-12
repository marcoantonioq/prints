<?php
App::uses('AppController', 'Controller');
/**
 * Departments Controller
 *
 * @property Department $Department
 * @property PaginatorComponent $Paginator
 */
class DepartmentsController extends AppController {

	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('title_for_layout', __(ucfirst('departments')));
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
            $this->Paginator->settings = $this->Department->action($this->request->data);
            echo $this->Session->setFlash('Filtro definido!', 'layout/success');
        }
		$this->Department->recursive = 0;
		$this->set('departments', $this->Paginator->paginate());
	}


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Department->exists($id)) {
			throw new NotFoundException(__('Inválido department'));
		}
		$options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
		$this->set('department', $this->Department->find('first', $options));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Department->create();
			if ($this->Department->save($this->request->data)) {
				$this->Session->setFlash(__('Foi salvo.'), 'layout/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não pôde ser salvo. Por favor, tente novamente.'), 'layout/error');
			}
		}
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Department->exists($id)) {
			throw new NotFoundException(__('Inválido department'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Department->save($this->request->data)) {
				$this->Session->setFlash(__('Foi salvo.'), 'layout/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não pôde ser salvo. Por favor, tente novamente.'), 'layout/error');
			}
		} else {
			$options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
			$this->request->data = $this->Department->find('first', $options);
		}
	}
	

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Department->id = $id;
		if (!$this->Department->exists()) {
			throw new NotFoundException(__('Inválido department'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Department->delete()) {
	
			$this->Session->setFlash(__('Foi excluído.'), 'layout/success');
		} else {
			$this->Session->setFlash(__('Não foi excluído. Por favor, tente novamente.'), 'layout/error');
		}
		return $this->redirect(array('action' => 'index'));
	}}
