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
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
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

	public $components = array(
		'RequestHandler',
        'Session',
        'Auth'
    );

    public function beforeFilter() {
    	$this->Auth->userModel = 'User';
    	$this->Auth->authorize = array('Controller');
    	$this->Auth->loginAction = array('controller' => 'user', 'action' => 'login');
		$this->Auth->authenticate = array(
		    'Form' => array(
		        'fields' => array('username' => 'email', 'password' => 'password'),
		    ),
		);
    	$this->Auth->loginRedirect = array('controller' => 'property', 'action' => 'map_search');
    	$this->Auth->logoutRedirect = array('controller' => 'inmobiliariazumo', 'action' => 'index');
        $this->Auth->allow('index', 'about', 'alliances', 'contact');
    } 

    
    public function isAuthorized($user) {
	    // Admin can access every action
	    if (isset($user['isAdmin']) && $user['isAdmin']) {
	        return true;
	    }

	    // Default deny
	    return false;
	}

	/*function afterFilter() {
		/*if (in_array($this->request->ext, array('xml', 'json'))) {
			$_view = ROOT . DS . APP_DIR . DS . "views" . DS . "common" . DS . $this->RequestHandler->ext . ".ctp";
			$this->render(null, "default", $_view);
		}*/
	//}

	//function beforeRender() {
		// If JSON, XML we don't need to go to any view, just the default one.
		/*if (in_array($this->request->ext, array('xml', 'json'))){
			//$this->layout = 'ajax';
			//$this->disableCache();
		}

		parent::beforeRender();*/
	//}

	 //public function beforeFilter() {

	 	/*if (in_array($this->request->ext, array('xml', 'json'))) {
			// 1. Don't render automatically
			$this->autoRender = false;
			// 2. Don't debug
			//if (Configure::read('debug') > 0) Configure::write('debug', 0);
		}*/

      //  parent::beforeFilter();
    //}

}
?>