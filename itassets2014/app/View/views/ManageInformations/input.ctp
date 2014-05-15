<?php
if($this->action === "edit")
	echo $this->Form->input('ManageInformation.id', array('type' => 'hidden', 'value' => $this->data['ManageInformation']['id']));
echo $this->Form->input('ManageInformation.software_license_id', array('type' => 'hidden', 'value' => $id));
echo $this->Form->input('ManageInformation.user_id',array('id' => 'user', 'label' => 'PC所持者', 'options' => $list['user'], 'empty' => 'ユーザ選択'));
echo $this->Form->input('ManageInformation.pc_id',array('id' => 'pc', 'label' => 'インストールPC', 'options' => $select, 'empty' => '選択'));
?>
<script type="text/javascript">
//<![CDATA[
ConnectedSelect(['user','pc']);
ConnectedSelectDefault(['user', 'pc']);
//]]>
</script>
<?php
echo $this->Form->input('ManageInformation.install_type',array('label' => 'インストールタイプ', 'type' => 'select', 'options' => $list['type'], 'empty' => '選択'));
?>