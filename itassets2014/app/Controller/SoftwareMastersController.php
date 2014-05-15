<?php
class SoftwareMastersController extends AppController{

	public $uses = array('VersionMaster', 'Manufacturer','SoftwareMaster');
	public $paginate = array(
			'limit' => 10,
			'order' => array('SoftwareMaster.id' => 'asc'),
			);

	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function isAuthorized(){
		return $this->_isLevel(4);
	}

	public function index(){
		$this->set('title_for_layout','マスタ管理');
		$this->VersionMaster->bindModel(array('belongsTo' => array('Manufacturer' =>
				array('conditions' => ('Manufacturer.id = SoftwareMaster.manufacturer_id'),
						'foreignKey' => false))));
		$this->set('datas', $this->paginate());
	}

	public function add(){
		$this->set('title_for_layout','マスタの追加');
		$this->set('select_maker', $this->Manufacturer->find('list'));

		if(!empty($this->data)){
			if(isset($this->data['confirm'])) {
				$this->render('confirm');
			} elseif(isset($this->data['submit'])){
				if($this->SoftwareMaster->save($this->data)) $this->Session->setFlash('マスタ情報が保存されました。');
				else $this->Session->setFlash('マスタ情報を保存できませんでした。もう一度試して下さい。');
				$this->redirect(array('action' => 'index'));
			} elseif(!isset($this->data['rewrite'])) $this->redirect(array('action' => 'index'));
		}
	}

	public function edit($id = null){
		$this->set('title_for_layout','マスタ情報の編集');
		$this->set( 'select_maker', $this->Manufacturer->find( 'list', array(
				'fields' => array( 'id', 'name'),
				'order' => array('name' => 'asc')
		)));

		$this->set( 'select_soft', $this->SoftwareMaster->find( 'list', array(
				'fields' => array( 'id', 'software_name'),
				'order' => array('software_name' => 'asc')
		)));

		$this->set( 'select_ver', $this->SoftwareMaster->find( 'list', array(
				'fields' => array('id', 'version')
		)));

		if ($this->request->is('get')) {
			$this->SoftwareMaster->set('id', $id);
			if(!$this->SoftwareMaster->exists()) throw new NotFoundException("不正な情報です。");

			$this->request->data = $this->SoftwareMaster->read();
		} else{
			if(isset($this->data['confirm'])) {
				$this->render('confirm');
			} elseif(isset($this->data['submit'])){
				if($this->SoftwareMaster->save($this->data)) $this->Session->setFlash('マスタ情報が保存されました。');
				else $this->Session->setFlash('マスタ情報を保存できませんでした。もう一度試して下さい。');
				$this->redirect(array('action' => 'index'));
			} elseif(!isset($this->data['rewrite'])) $this->redirect(array('action' => 'index'));
		}
	}

	public function delete($id = null){
		if ($this->request->is('post')) {
			if(!$this->SoftwareMaster->exists($id)) throw new NotFoundException("不正な情報です。");

			$this->request->onlyAllow('post', 'delete');
			if ($this->SoftwareMaster->delete($id, false)) $this->Session->setFlash('マスタ情報が削除されました。');
			else $this->Session->setFlash('マスタ情報が削除されませんでした。');
			$this->redirect(array('action' => 'index'));
		}
	}
}