<?php
class SoftwareLicensesController extends AppController{
	public $uses = array('SoftwareLicense', 'Manufacturer', 'SoftwareMaster', 'VersionMaster', 'Pc');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('masters', array(
				'maker' => $this->Manufacturer->find("list"),
				'select' => array(
						$this->SoftwareMaster->find("list", array('fields' => array('id', 'software_name', 'manufacturer_id'))),
						$this->VersionMaster->find("list", array('fields' => array('id', 'version_name', 'software_master_id')))
				 ),
				'soft' => $this->SoftwareMaster->find("list", array('fields' => array('id', 'software_name'))),
				'ver' => $this->VersionMaster->find("list", array('fields' => array('id', 'version_name'))),
				));
		$this->paginate = array(
				'limit' => 10,
				'order' => array('Manufacturer.name' => 'asc', 'VersionMaster.version_name' => 'asc'),
				'recursive' => 1
		);
	}

	public function isAuthorized(){
		return ($this->action !== "index" && $this->action !== "detail") ? $this->_isLevel(2) : $this->_isLevel(1);
	}

	public function index(){
		$this->set('title_for_layout','ソフトウェアライセンス一覧');

		// ソフトウェア使用状況の取得
		$this->paginate += $this->SoftwareLicense->getTotal();

		$this->set('datas', $this->paginate());
	}

	public function detail($id = null){
		$this->layout = 'index';
		$this->VersionMaster->id = $id;
		if(!$this->VersionMaster->exists()) throw new NotFoundException("不正な情報です。");

		$this->set('id', $id);
		$master = $this->VersionMaster->read();

		$this->set('title_for_layout', $master['SoftwareMaster']['software_name'] . " " .
				$master['VersionMaster']['version_name'] . "のライセンス情報一覧");
		$this->paginate += array('conditions' => array('SoftwareLicense.version_master_id' => $id));
		$this->set('datas', $this->paginate('SoftwareLicense'));
	}

	public function add(){
		$this->set('title_for_layout','ソフトウェアライセンス情報の追加');
		$this->Transition->checkData("confirm");
		if($this->request->is('get')) $this->Transition->clearData();
		$this->render('input');
	}

	public function edit($id = null){;
		$this->set('title_for_layout','ソフトウェアライセンス情報の編集');
		$this->Transition->checkData("confirm");
		if($this->request->is('get')){
			if(!$this->SoftwareLicense->exists($id)) throw new NotFoundException("不正な情報です。");
			$this->Transition->clearData();
		}
		$this->request->data = $this->SoftwareLicense->findById($id);
		$this->render('input');
	}

	public function confirm(){
		$this->request->data = $this->Transition->mergedData();

		$this->set('date', array(
			$this->SoftwareLicense->deconstruct('purchase_date', $this->data['SoftwareLicense']['purchase_date']),
			$this->SoftwareLicense->deconstruct('term', $this->data['SoftwareLicense']['term'])
		));
		if(array_key_exists('id', $this->data['SoftwareLicense'])) $this->Transition->automate('edit', "save");
		else $this->Transition->automate('add', "save");
		$this->render('confirm');
	}

	public function save(){
		$this->request->data = $this->Transition->mergedData();
		if($this->SoftwareLicense->save($this->data)) $this->Session->setFlash('ソフトウェアライセンス情報が保存されました。');
		else $this->Session->setFlash('ソフトウェアライセンス情報を保存できませんでした。もう一度試して下さい。');
		$this->Transition->clearData();
		if(array_key_exists('id', $this->data['SoftwareLicense'])) $this->redirect(array('action' => 'detail', $this->data['SoftwareLicense']['software_master_id']));
		else $this->redirect(array('action' => 'index'));
	}

	public function delete($id = null){
		if ($this->request->is('post')){
			$this->SoftwareLicense->id = $id;
			if(!$this->SoftwareLicense->exists()) throw new NotFoundException("不正な情報です。");

			$this->request->onlyAllow('post', 'delete');
			$name = $this->SoftwareLicense->read();
			if ($this->SoftwareLicense->delete($id, false)) $this->Session->setFlash($name["SoftwareMaster"]["software_name"] .  " " . $name['VersionMaster']['version_name'] . 'が削除されました。');
			else $this->Session->setFlash($name["SoftwareMaster"]["software_name"] .  " " . $name['VersionMaster']['version_name'] . 'が削除されませんでした。');
			$this->redirect(array('action' => 'detail',$name["SoftwareMaster"]['id']));
		}
	}

	public function view($id = null){
		$this->set('title_for_layout',"ソフトウェアライセンス詳細情報");
		$this->request->data = $this->SoftwareLicense->findById($id);
		$this->paginate = array(
				"ManageInformation" => array(
						'conditions' => array('ManageInformation.software_license_id' => $id),
						'limit' => 5,
						'order' => array('ManageInformation.id' => 'asc')
				));
		$this->set('id', $id);
		$this->set('datas', $this->paginate('ManageInformation'));
	}
}
?>