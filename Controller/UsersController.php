<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	public function beforeFilter(){
		parent::beforeFilter();
        $this->forceSSL();
		$this->set('title_for_layout', __(ucfirst('users')));
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
			// pr($this->request->data);
            $this->Paginator->settings = $this->User->action($this->request->data);
            echo $this->Session->setFlash('Filtro definido!', 'layout/success');
        }
		$this->User->recursive = 0;
		$departments = $this->User->Department->find('list');
		$users = $this->Paginator->paginate();
		
		$this->set(compact('departments', 'users'));

	}

	public function syc() {
		$this->render(false);
		$this->User->recursive = 0;
		$this->User->recursive = -1;
		$users = $this->User->find("all");
		$users = $this->User->sycAD($users);
		$this->redirect($this->referer());
	}

	public function app_login() {
	    $this->layout = "login";
        
        if ($this->request->is('post')) {
        	$this->User->login($this->request->data);
            if ($this->Auth->login()) {
                $this->Session->setFlash('Logado com sucesso.', 'layout/success');
                return $this->redirect(array('controller' => 'printers', 'action'=>'index'));
            } else {
                $this->Session->setFlash('Nome de usuário ou senha estava incorreta.');
            }
        }
    }

 /**
 * logout method
 *
 * @return void
 */
    function app_logout() {
        $this->Session->setFlash('Até logo!', 'layout/success');
    	// if (env('HTTPS')){ $this->_unforceSSL; }
        $this->redirect($this->Auth->logout());
    }

	/**
 * printerCount method
 *
 * @return printerCountUser
 */

	public function printerCount($id) {
		$this->layout = "ajax";
		$this->render("/Users/ajax");
		
		if($this->request->is("ajax")){
			$jobs = $this->User->Job->find("all",array(
				// "recursive"=>-1,
				"conditions"=>array(
					"Job.user_id"=>$id
				)
			));
			echo (isset($jobs['Results']['total']))?$jobs['Results']['total']:0;
            return true;
        }
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Inválido user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user = $this->User->find('first', $options);

		$prints = $this->User->Job->Printer->find('list');
		
		$this->set(compact('user', 'prints'));
	}

	public function app_index($id = null) {
		$id = $this->Session->read('Auth.User.id');
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Inválido user'));
		}	

		$options = array('conditions' => array('User.id' => $id));
		$user = $this->User->find('first', $options);

		$prints = $this->User->Job->Printer->find('list');
		
		$this->set(compact('user', 'prints'));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();

			if ($this->User->save($this->request->data)) {
				$user = $this->User->find("first", array(
					'recursive' => -1,
					'conditions'=>array('User.suap'=> $this->request->data['User']['suap'])
				));
				$user = $this->User->sycAD(array('0'=>$user));

				$this->Session->setFlash(__('Foi salvo.'), 'layout/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não pôde ser salvo. Por favor, tente novamente.'), 'layout/error');
			}
		}
		$departments = $this->User->Department->find('list');
		$this->set(compact('departments'));
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Inválido user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Foi salvo.'), 'layout/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Não pôde ser salvo. Por favor, tente novamente.'), 'layout/error');
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$departments = $this->User->Department->find('list');
		$this->set(compact('departments'));
	}
	

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Inválido user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
	
			$this->Session->setFlash(__('Foi excluído.'), 'layout/success');
		} else {
			$this->Session->setFlash(__('Não foi excluído. Por favor, tente novamente.'), 'layout/error');
		}
		return $this->redirect(array('action' => 'index'));
	}}
