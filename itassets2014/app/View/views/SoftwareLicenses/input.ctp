<?php

if($this->action === "edit")
	echo $this->Form->input('SoftwareLicense.id', array('type' => 'hidden', 'value' => $this->data['SoftwareLicense']['id']));
echo $this->Form->input('SoftwareLicense.manufacturer_id', array('label' => 'メーカー', 'id' => 'maker', 'empty' => '選択', 'options' => $masters["maker"]));
echo $this->Form->input('SoftwareLicense.software_master_id', array('label' => '登録ソフトウェア', 'id' => 'soft', 'empty' => '選択', 'options' => $masters["select"][0]));
echo $this->Form->input('SoftwareLicense.version_master_id', array('label' => 'バージョン', 'id' => 'ver', 'empty' => '選択', 'options' => $masters["select"][1]));
?>
<script type="text/javascript">
//<![CDATA[
ConnectedSelect(['maker','soft','ver']);
ConnectedSelectDefault(['maker','soft','ver']);
//]]>
</script>

<?php
echo $this->Form->input("SoftwareLicense.name",array("label" => "名前"));
echo $this->Form->input("SoftwareLicense.licese_key",array("label" => "ライセンスキー"));
echo $this->Form->input("SoftwareLicense.purchase_date",array("label" => "購入日時", 'dateFormat' => "YMD", 'separator' => array('年','月','日'), 'monthNames' => false));
echo $this->Form->input("SoftwareLicense.term",array("label" => "有効期限",'dateFormat' => "YMD", 'separator' => array('年','月','日'), 'monthNames' => false));
echo $this->Form->input("SoftwareLicense.note",array("label" => "備考"));
?>