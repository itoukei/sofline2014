<?php
App::import('Model', 'ConnectionManager');
class LaboratoryMastersController extends AppController{

	public $uses = array("LaboratoryMaster");

	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('select', array('情報アーキテクチャ' => '情報アーキテクチャ', '複雑系知能' => '複雑系知能'));
	}

	public function isAuthorized(){
		return $this->_isLevel(4);
	}

	public function view(){
		$this->set('title_for_layout','	研究室マスタ情報の管理');
		$this->set('id', 1);
		if ($this->request->is('post') && isset($this->data['back']))
			$this->redirect(array('action' => 'back'));
		else $this->request->data = $this->LaboratoryMaster->findById(1);
	}

	public function edit(){
		$this->set('title_for_layout','	研究室マスタ情報の編集');

		$this->Transition->checkData("confirm");
		if ($this->request->is('get')) $this->Transition->clearData();
		$this->request->data = $this->LaboratoryMaster->findById(1);
	}

	public function confirm(){
		$this->request->data = $this->Transition->mergedData();
		$this->Transition->automate("edit", "save");
	}

	public function save(){
		$this->request->data = $this->Transition->mergedData();
		if($this->LaboratoryMaster->save($this->data))
			$this->Session->setFlash('研究室マスタ情報が保存されました。');
		else $this->Session->setFlash('研究室マスタ情報を保存できませんでした。もう一度試して下さい。');
		$this->Transition->clearData();
		$this->redirect(array('action' => 'view'));
	}

	public function back(){
		$this->viewClass = 'Media';
		$db =& ConnectionManager::getDataSource('default');
		$config = $db->config;
		$zip = CACHE . 'models' . DS . 'backup-' . date('Y-m-d') . '.zip';
		$files = '';
		foreach ($db->query("SHOW TABLE STATUS") as $table){
			$file[$table["TABLES"]["Name"]] = CACHE . 'models' . DS . "{$config['database']}-{$table["TABLES"]["Name"]}.sql";
			$cmd = sprintf(
					'mysqldump -u %s -p%s -h %s %s %s > %s'
					,$config['login']
					,$config['password']
					,$config['host']
					,$config['database']
					,$table["TABLES"]["Name"]
					,$file[$table["TABLES"]["Name"]]
			);
			$output[$table["TABLES"]["Name"]] = array();
			exec($cmd, $output, $maybeError);
			$maybeError = null;
			exec($cmd, $output, $maybeError);
			if (!empty($maybeError) && !count($output)){
				$this->Session->setFlash("バックアップの取得に失敗しました。");
				$this->redirect(array('action' => 'index'));
			}

			$files .= " {$file[$table["TABLES"]["Name"]]}";
		}
		exec('rm -f ' . CACHE . 'models' . DS . 'backup-*');
		exec('zip -j ' . $zip . $files);
		exec('rm -f ' . $files);
		$parts = pathinfo($zip);
		$params = array(
				'id' => $parts['basename'],
				'name' => $parts['filename'],
				'extension' => $parts['extension'],
				'download' => true,
				'path' => $parts['dirname'].DS
		);
		$this->set($params);
	}
}
?>