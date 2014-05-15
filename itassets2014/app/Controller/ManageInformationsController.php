<?php
class ManageInformationsController extends AppController{
	public $uses = array('ManageInformation', 'Pc', 'User');
	public $paginate = array('limit' => 10, 'order' => array('ManageInformation.id' => 'desc'));

	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('select', $this->Pc->find('list', array('fields' => array('id', 'name', 'user_id'))));
		$this->set('list', array(
				'user' => $this->User->find('list', array('fields' => array('id', 'screen_name'))),
				'pc' => $this->Pc->find('list'),
				'type' => array('1' => 'メイン', '0' => 'サブ')
		));
	}

	public function isAuthorized(){
		return $this->_isLevel(2);
	}

	public function add($id = null){
		$this->set('title_for_layout','ライセンス管理情報の登録');

		if(!$this->_isLevel(4)) $this->redirect(array('action' => 'index'));
		$this->set('id', $id);
		$this->Transition->checkData("confirm");
		if($this->request->is('get')) $this->Transition->clearData();
		$this->render('input');
	}

	public function edit($id = null){
		$this->set('title_for_layout','ライセンス管理情報の編集');
		$this->Transition->checkData("confirm");
		if($this->request->is('get')) {
			if(!$this->ManageInformation->exists($id)) throw new NotFoundException("不正な情報です。");
			$this->Transition->clearData();
		}
		$this->request->data = $this->ManageInformation->findById();
		$this->render('input');

	}

	public function confirm(){
		$this->request->data = $this->Transition->mergedData();

		if(array_key_exists('id', $this->data['ManageInformation'])) $this->Transition->automate('edit', "save");
		else $this->Transition->automate('add', "save");
		$this->render('confirm');
	}

	public function save(){
		$this->request->data = $this->Transition->mergedData();
		if($this->ManageInformation->save($this->data)) $this->Session->setFlash('ライセンス管理情報が保存されました。');
		else $this->Session->setFlash('ライセンス管理情報を保存できませんでした。もう一度試して下さい。');
		$this->Transition->clearData();
		$count = $this->ManageInformation->find('count', array('conditions' => array('software_license_id' => $this->data['ManageInformation']['software_license_id'])));
		$this->ManageInformation->SoftwareLicense->updateAll(array('installed' => $count), array('SoftwareLicense.id' => $this->data['ManageInformation']['software_license_id']));
		$this->redirect(array('controller' => 'SoftwareLicenses', 'action' => 'detail',
				 $this->ManageInformation->SoftwareLicense->field('version_master_id',
				 		array('id' => $this->data['ManageInformation']['software_license_id']))));
	}

	public function delete($id = null){
		$this->set('title_for_layout','ライセンス管理情報の削除');
		if ($this->request->is('post')) {
			$this->ManageInformation->id = $id;
			if(!$this->ManageInformation->exists()) throw new NotFoundException("不正な情報です。");

			$this->request->onlyAllow('post', 'delete');
			$name = $this->ManageInformation->field('name');
			if ($this->ManageInformation->delete($id, false)) $this->Session->setFlash($name.'が削除されました。');
			else $this->Session->setFlash($name.'が削除されませんでした。');
			$this->redirect(array('action' => 'index'));
		}
	}
}