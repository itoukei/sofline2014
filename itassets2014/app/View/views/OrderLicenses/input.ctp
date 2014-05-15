<?php
if($this->action === "edit")
	echo $this->Form->input('OrderLicense.id', array('type' => 'hidden', 'value' => $this->data['OrderLicense']['id']));
echo $this->Form->input('OrderLicense.manufacturer_id', array('label' => 'メーカー', 'id' => 'maker', 'empty' => '選択', 'options' => $masters["maker"]));
echo $this->Form->input('OrderLicense.software_master_id', array('label' => '登録ソフトウェア', 'id' => 'soft', 'empty' => '選択', 'options' => $masters["select"][0]));
echo $this->Form->input('OrderLicense.version_master_id', array('label' => 'バージョン', 'id' => 'ver', 'empty' => '選択', 'options' => $masters["select"][1]));
?>
<script type="text/javascript">
//<![CDATA[
ConnectedSelect(['maker','soft','ver']);
ConnectedSelectDefault(['maker','soft','ver']);
//]]>
</script>

<?php
for($i = 1; $i <= 10; $i++) $numbers["$i"] = $i;
echo $this->Form->input("OrderLicense.number",array("label" => "個数",'empty' => '選択', 'options' => $numbers));
echo $this->Form->input("OrderLicense.price",array("label" => "単価"));
echo $this->Form->input("OrderLicense.budget_type",array("label" => "予算枠", 'empty' => '選択', 'options' => $select));
echo $this->Form->input("OrderLicense.budget_detail",array("label" => "予算枠詳細"));
echo $this->Form->input("OrderLicense.delivery_place",array("label" => "納品場所"));
echo $this->Form->input("OrderLicense.delivery_date",array("type" => "date", "label" => "納品希望日", 'dateFormat' => "YMD", 'separator' => array('年','月','日'), 'monthNames' => false));
?>