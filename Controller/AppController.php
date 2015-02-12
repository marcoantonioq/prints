<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
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
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/**
 * Components
 *
 * @var array
 */
    public $components = array(
        'Paginator',
        'RequestHandler',
        'Security' => array(
            'csrfUseOnce' => false,
            "validatePost" => false,
            "enabled" => false,
            "csrfCheck" => false,
        ),
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'suap',
                        'password' => 'password'
                    ),
                    'scope'  => array(
                        'User.status' => 1
                    )
                )
            ),
            // /*
            'authError' => 'Você não possui autorização para executar esta ação.',
            'authorize' => array('Controller'),
            'loginAction' => array(
                'plugin' => false,
                'app'=>true,
                'controller' => 'users',
                'action' => 'login'
            ),
            'loginRedirect' => array('plugin' => false, 'controller' => 'users', 'action' => 'login'),
            'logoutRedirect' => array('plugin' => false, 'controller' => 'users', 'action' => 'login'),
            // */
        )
    );

    public function beforeFilter() {
        $this->Security->validatePost = false;

        if( !empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'app') {
            $this->layout = 'user';
        } else {
            $this->layout = 'admin';            
        }

        if (!env('HTTPS')){
            $this->Security->blackHoleCallback = 'forceSSL'; 
            $this->Security->requireSecure(); 
        }

        if($this->request->is('ajax')){
            $this->layout='reload';
        }
        
        // $this->Auth->allow();
        // $this->Auth->deny();

    }

    public function forceSSL() {
        if (!env('HTTPS')){
            return $this->redirect('https://' . env('SERVER_NAME') . $this->here);
        }
    }

    public function isAuthorized($user = null){

        if( !empty($this->request->params['prefix'])) {
            if($this->request->params['prefix'] == 'app')
                return true;
        } else {
            if( $user['Department']['admin'] ){
                return true;
            }
        }

        // return true;
        return false;
    }

    public function status($id, $status = null, $action="status"){
        if($this->request->is("ajax")){
            // $id = $this->request->params['pass'][0];
            // $status = $this->request->params['pass'][1];
            // $action = $this->request->params['pass'][2];
            $model = $this->modelClass;
            $this->$model->statusAjax($id, $status, $action);
            $this->layout = "ajax";
            $this->render("/Common/ajax");
            return true;
        }
        $this->redirect($this->referer());
    }

}