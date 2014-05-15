<?php
class AuthenticatesController extends AppController{
	public $uses = array('User', 'Pc', 'SoftwareLicense');

	public function beforeFilter() {
		parent::beforefilter();
		$this->Auth->allow('index');
		$this->autoRender = false;
	}

	public function isAuthorized(){
		if($this->action === "logout") return $this->_isLevel(1);
		return $this->_isLevel(2);
	}

	public function index(){
		if($this->request->is('post')){
			if($this->Auth->login()){
				AuthComponent::$sessionKey = "Auth.Level{$this->Auth->User('authority_level')}User";

				$this->redirect($this->Auth->redirectUrl());
			} else{
				$this->Session->setFlash('ユーザ名またはパスワードが間違っています。');
				$this->redirect(array('action' => 'index'));
			}
		}
		if($this->Auth->loggedIn()){
			$this->Session->setFlash('既にログインしています');
			$this->redirect($this->Auth->redirectUrl());
		}
		$this->request->data = array('User' => array('user_name' => 'Guest', 'password' => 'guest'));

		$this->set('title_for_layout',"ソフトウェアライセンス一覧");
		$this->paginate = $this->SoftwareLicense->getTotal();
		$this->set('datas', $this->paginate('SoftwareLicense'));
		$this->render('../SoftwareLicenses/index');

	}

	public function logout(){
		$this->redirect($this->Auth->logout());
	}

	public function view(){
		$this->set('title_for_layout',"ユーザ詳細情報");
		$this->paginate = array('Pc' => array('limit' => 5, 'conditions' => array('user_id' => $this->Auth->user('id'))));
		$this->set('datas', $this->paginate('Pc'));
		$this->request->data = $this->User->findById($this->Auth->user('id'));
		$this->render('../Users/view');
	}

	public function password(){
		$this->layout = 'form';
		$this->set('title_for_layout','	ユーザパスワードの編集');
		if($this->request->is('post')){
			$this->request->data['User']['password'] = $this->Auth->password($this->data['User']['password']);
			if($this->User->validates()){
				if($this->User->save($this->data))
					$this->Session->setFlash('パスワードが変更されました。');
				else $this->Session->setFlash('パスワードが変更されませんでした。もう一度試して下さい。');
				$this->Transition->clearData();
				$this->redirect(array('action' => 'view', $this->Auth->user('id')));
			}
		}
		$this->Transition->clearData();
		$this->request->data['User']['id'] = $this->Auth->user('id');
	}

	public function edit(){
		$this->set('title_for_layout','ユーザ情報の編集');
		$this->set('select', $this->User->find('list'));

		$this->Transition->checkData("confirm");
		if ($this->request->is('get')) $this->Transition->clearData();
		$this->request->data['User'] = $this->Auth->User();
		$this->render('../Users/input');
	}

	public function confirm(){
		$this->request->data =  $this->Transition->mergedData();

		$this->Transition->automate('edit', "save");
		$this->render('../Users/confirm');
	}

	public function save(){
		$this->request->data = $this->Transition->mergedData();

		if($this->User->save($this->data))
			$this->Session->setFlash('ユーザ情報が保存されました。');
		else $this->Session->setFlash('ユーザ情報を保存できませんでした。もう一度試して下さい。');
		$this->Transition->clearData();
		$this->redirect(array('action' => 'index'));
	}
}

?>