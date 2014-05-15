<?php
class SoftwareLicense extends AppModel{
	public $belongsTo = array("OrderLicense", "Manufacturer", "SoftwareMaster", "VersionMaster");
	public $hasMany = array("ManageInformation");

	public $validate = array();

	public function getTotal(){
		// 	保管，使用中，未使用を仮想フィールドに設定
		$this->virtualFields = array(
				'keeps' => 'count("SoftwareLicense.version_master_id")',
				'used' => 'count(SoftwareLicense.installed > 0 or null)',
				'unused' => 'count("SoftwareLicense.version_master_id") - count(SoftwareLicense.installed > 0 or null)',
		);

		return array(
				'group' => 'SoftwareLicense.version_master_id',
				'fields' => array('VersionMaster.id', 'VersionMaster.version_name', 'Manufacturer.name', 'SoftwareMaster.software_name', 'keeps', 'used', 'unused'),
		);
	}

}
?>