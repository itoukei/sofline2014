<?php
if($this->action === "edit")
	echo $this->Form->input('Pc.id', array('type' => 'hidden', 'value' => $this->data['Pc']['id']));
echo $this->Form->input('Pc.name',array('label' => 'PC名'));
echo $this->Form->input('Pc.os_name',array('label' => 'OS名'));
echo $this->Form->input('Pc.user_id', array('label' => '所持者', 'type' => 'select', 'options' => $select, 'empty' => 'ユーザ選択'));
echo $this->Form->input('Pc.pc_type', array('label' => 'PC種別', 'type' => 'select', 'options' => array('研究室備品' => '研究室備品', '私物' => '私物'), 'empty' => '選択'));
echo $this->Form->input('Pc.note',array('label' => '備考'));
?>