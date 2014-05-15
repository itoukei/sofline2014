<?php
class PcsController extends AppController{
	public $uses = array('Pc', 'User', 'SoftwareLicense');
	public $paginate = array('limit' => 10, 'order' => array('Pc.id' => 'desc'));

	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('select', $this->User->find('list', array('fields' => array('id', 'screen_name'))));
	}

	public function isAuthorized(){
		if($this->action === "index") return $this->_isLevel(2);
		return $this->_isLevel(3);
	}

	public function index(){
		$this->set('title_for_layout','PCの管理');
		$this->paginate = array(
				"Pc" => array(
						'limit' => 10,
						'order' => array('Pc.id' => 'asc')
				));
		$this->set('datas', $this->paginate('Pc'));
	}

	public function add(){
		$this->set('title_for_layout','PCの登録');
		$this->Transition->checkData("confirm");
		if($this->request->is('get')) $this->Transition->clearData();
		$this->render('input');
	}

	public function edit($id = null){
		$this->set('title_for_layout','PC情報の編集');
		if ($this->request->is('get')) {
			$this->Pc->set('id', $id);
			if(!$this->Pc->exists()) throw new NotFoundException("不正な情報です。");
			$this->Transition->clearData();
			$this->request->data = $this->Pc->read();
		}
		$this->Transition->checkData("confirm");
		$this->render('input');

	}

	public function confirm(){
		$this->request->data = $this->Transition->mergedData();

		if(array_key_exists('id', $this->data['Pc'])) $this->Transition->automate('edit', "save");
		else $this->Transition->automate('add', "save");
		$this->render('confirm');
	}

	public function save(){
		$this->request->data = $this->Transition->mergedData();
		if($this->Pc->save($this->data)) $this->Session->setFlash('PC情報が保存されました。');
		else $this->Session->setFlash('PC情報を保存できませんでした。もう一度試して下さい。');
		$this->Transition->clearData();
		$this->redirect(array('action' => 'index'));
	}

	public function delete($id = null){
		$this->set('title_for_layout','PC情報の削除');
		if ($this->request->is('post')) {
			$this->Pc->id = $id;
			if(!$this->Pc->exists()) throw new NotFoundException("不正な情報です。");

			$this->request->onlyAllow('post', 'delete');
			$name = $this->Pc->field('name');
			if ($this->Pc->delete($id, false)) $this->Session->setFlash($name.'が削除されました。');
			else $this->Session->setFlash($name.'が削除されませんでした。');
			$this->redirect(array('action' => 'index'));
		}
	}
	public function view($id = null) {
		$this->set('title_for_layout',"PC詳細情報");
		$this->request->data = $this->Pc->findById($id);
		$this->SoftwareLicense->unbindModel(array('hasMany' => array('ManageInformation')));
		$this->SoftwareLicense->bindModel(array('hasOne' => array('ManageInformation' => array('conditions' => array('pc_id' => $id)))));

		$this->paginate = array('SoftwareLicense' => array(
				'conditions' => array('ManageInformation.pc_id' => $id),
				'limit' => 5,
				'order' => array('Manufacturer.name' => 'asc', 'VersionMaster.version_name' => 'asc'),
				));
		$this->set('datas', $this->paginate('SoftwareLicense'));
	}
}
?>