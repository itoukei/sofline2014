<?php
// 仕様確認まで放置
echo $this->Form->input('SoftwareMaster.manufacturer_id', array('type' => 'select', 'options' => $select_maker, 'label' => 'メーカー'));
echo $this->Form->input("SoftwareMaster.software_name", array("label" => "ソフトウェア名"));
echo $this->Form->input("SoftwareMaster.version",array("label" => "バージョン"));
?>