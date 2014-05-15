<?php
class VersionMaster extends AppModel{
	public $belongsTo = array("SoftwareMaster");

	//public $virtualFields = array('full_name' => 'CONCAT(SoftwareMaster.software_name, " ", VersionMaster.version_name)');
}
?>