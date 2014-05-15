<?php
class OrderLicensesController extends AppController{
	public $uses = array('OrderLicense', 'Manufacturer', 'SoftwareMaster', 'VersionMaster', 'Pc');

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
				//'pc', $this->Pc->find('list')
		));
		$this->set('select', array("1" => "一般研究費", "2" => "奨学寄附金", "3" => "特別研究費", "4" => "共同研究費", "5" => "受託研究費", "3" => "科研費"));
	}

	public function isAuthorized(){
		return $this->_isLevel(2);
	}

	public function index(){
		$this->set('title_for_layout','仮登録ライセンス一覧');

		$this->paginate = array(
				"OrderLicense" => array(
						'conditions' => array("OrderLicense.delivered_flag" => 0),
						'limit' => 10,
						'order' => array('OrderLicense.created' => 'asc')
				));
		$this->set('datas', $this->paginate('OrderLicense'));
	}

	public function add(){
		$this->set('title_for_layout','仮登録ライセンス情報の追加');
		$this->Transition->checkData("confirm");
		if($this->request->is('get')) $this->Transition->clearData();
		$this->render('input');
	}

	public function edit($id = null){;
		$this->set('title_for_layout','仮登録ライセンス情報の編集');
		$this->Transition->checkData("confirm");
		if($this->request->is('get')) {
			if(!$this->OrderLicense->exists($id)) throw new NotFoundException("不正な情報です。");
			$this->Transition->clearData();

		}
		$this->request->data = $this->OrderLicense->findById($id);
		$this->render('input');
	}

	public function confirm(){
		$this->request->data = $this->Transition->mergedData();

		$this->set('date', $this->OrderLicense->deconstruct('delivery_date', $this->data['OrderLicense']['delivery_date']));
		if(array_key_exists('id', $this->data['OrderLicense'])) $this->Transition->automate('edit', "save");
		else $this->Transition->automate('add', "save");
		$this->render('confirm');
	}

	public function save(){
		$this->request->data = $this->Transition->mergedData();
		if($this->OrderLicense->save($this->data)) $this->Session->setFlash('仮登録ライセンス情報が保存されました。');
		else $this->Session->setFlash('仮登録ライセンス情報を保存できませんでした。もう一度試して下さい。');
		$this->Transition->clearData();
		if(array_key_exists('id', $this->data['OrderLicense'])) $this->redirect(array('controller' => 'SoftwareLicense', 'action' => 'detail', $this->data['OrderLicense']['software_master_id']));
		else $this->redirect(array('action' => 'index'));
	}

	public function delete($id = null){
		if ($this->request->is('post')){
			$this->OrderLicense->id = $id;
			if(!$this->OrderLicense->exists()) throw new NotFoundException("不正な情報です。");

			$this->request->onlyAllow('post', 'delete');
			$name = $this->OrderLicense->read();
			if ($this->OrderLicense->delete($id, false)) $this->Session->setFlash($name["SoftwareMaster"]["software_name"] .  " " . $name['VersionMaster']['version_name'] . 'が削除されました。');
			else $this->Session->setFlash($name["SoftwareMaster"]["software_name"] .  " " . $name['VersionMaster']['version_name'] . 'が削除されませんでした。');
			$this->redirect(array('action' => 'detail',$name["SoftwareMaster"]['id']));
		}
	}
}
?>