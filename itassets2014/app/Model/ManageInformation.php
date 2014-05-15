<?php
class ManageInformation extends AppModel{
	public $belongsTo = array("Pc", "User",
			"SoftwareLicense" => array(
					"counterChache" => array(
							'installed' =>
							array('ManageInformation.install_type' => '1')
					))
);
}
?>