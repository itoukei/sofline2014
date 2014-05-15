<?php
class UsersController extends AppController{

	public $uses = array('User','Pc');

	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function isAuthorized(){
		return $this->_isLevel(4);
	}

	public function index(){
		$this->set('title_for_layout', 'ユーザ管理');
		$this->paginate = array(
				"User" => array(
						'limit' => 10,
						'order' => array('User.created' => 'desc')
				));
		$this->set('datas', $this->paginate('User'));
	}

	public function add(){
		$this->set('title_for_layout', 'ユーザの追加');
		$this->Transition->checkData("confirm");
		if($this->request->is('get')) $this->Transition->clearData();
		$this->render('input');
	}

	public function edit($id = null){
		$this->set('title_for_layout','ユーザ情報の編集');
		$this->set('select', $this->User->find('list'));

		$this->Transition->checkData("confirm");
		if($this->request->is('get')) {
			if(!$this->User->exists($id)) throw new NotFoundException("不正な情報です。");
			$this->Transition->clearData();
		}
		$this->request->data = $this->User->findById($id);
		$this->render('input');
	}

	public function confirm(){
		$this->request->data =  $this->Transition->mergedData();

		if(isset($this->data['User']['id'])) $this->Transition->automate('edit', "save");
		else $this->Transition->automate('add', "save");
		$this->render('confirm');
	}

	public function save(){
		$this->request->data = $this->Transition->mergedData();
		if(!array_key_exists('id', $this->data['User']) && isset($this->data['User']['password']))
			$this->request->data['User']['password'] = $this->Auth->password($this->data['User']['password']);
		if($this->User->save($this->data))
			$this->Session->setFlash('ユーザ情報が保存されました。');
			else $this->Session->setFlash('ユーザ情報を保存できませんでした。もう一度試して下さい。');
		$this->Transition->clearData();
		$this->redirect(array('action' => 'index'));
	}

	public function delete($id = null){
		if ($this->request->is('post')) {
			$this->User->id = $id;
			if(!$this->User->exists()) throw new NotFoundException("不正な情報です。");

			$this->request->onlyAllow('post', 'delete');
			$name = $this->User->field('screen_name');
			if ($this->User->delete($id, false)) $this->Session->setFlash($name.'が削除されました。');
			else $this->Session->setFlash($name.'が削除されませんでした。');
			$this->redirect(array('action' => 'index'));
		}
	}

	public function view($id = null){
		$this->set('title_for_layout',"ユーザ詳細情報");
		$this->paginate = array('Pc' => array('limit' => 5, 'conditions' => array('user_id' => $id)));
		$this->set('datas', $this->paginate('Pc'));
		$this->request->data = $this->User->findById($id);
	}

}
?>