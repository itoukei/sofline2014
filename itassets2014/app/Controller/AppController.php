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

	public $components = array('Auth', 'Session', 'Transition.Transition');

	public function beforeFilter() {
		// アクションごとにレイアウトを決める
		switch($this->action){
			case 'index':
				$layout = "index";
				break;
			case 'view':
				$layout = "view";
				break;
			case 'confirm':
				$layout = "confirm";
				break;
			case 'add':
			case 'edit':
				$layout = "form";
				break;
			default:
				$layout = "default";
				break;
		}
		$this->layout = $layout;

		// 認証に関する設定
		$this->Auth->authenticate = array(
				'all' => array('fields' => array('username' => 'user_name', 'password' => 'password')),
				'Form'
		);
		$this->Auth->authError = (!$this->Auth->loggedIn()) ? "ログインしてください。" : "権限レベル違反があります。";
		$this->Auth->authorize = array('Controller');
		$this->Auth->loginAction = array('controller' => 'Authenticates', 'action' => 'index');
		$this->Auth->loginRedirect = array('controller' => 'SoftwareLicenses', 'action' => 'index');
		$this->Auth->unauthorizedRedirect = (!$this->Auth->loggedIn()) ? $this->Auth->loginAction : $this->Auth->loginRedirect;
		$this->Auth->logoutRedirect =  $this->Auth->loginAction;

		// ログイン情報用
		$level = array('4' => '管理ユーザ', '3' => '研究室管理ユーザ', '2' => '研究室一般ユーザ', '1' => '研究室外ユーザ');

		$this->set('level', $level);
	}

	protected function _isLevel($level = null){
		if($this->Auth->user('authority_level') >= $level)
			return true;
		else return false;
	}
}
