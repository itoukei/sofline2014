<?php
class OrderLicense extends AppModel{
	public $belongsTo = array("Manufacturer", "SoftwareMaster", "VersionMaster");
}
?>