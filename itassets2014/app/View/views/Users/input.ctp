<?php
if($this->action === "edit")
	echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->data['User']['id']));
echo $this->Form->input("User.user_name", array("label" => "ユーザ名"));
echo $this->Form->input("User.screen_name", array("label" => "表示名"));
if($this->action === "add") echo $this->Form->input("User.password", array("label" => "パスワード"));
if($this->request->controller !== "Authenticates" && AuthComponent::user('authority_level') >= 4)
	 echo $this->Form->input("User.authority_level",
		array('type' => 'select', 'options' => array('4' => '4(管理ユーザ)', '3' => '3(研究室管理ユーザ)', '2' => '2(研究室一般ユーザ)', '1' => '1(研究室外ユーザ)'), 'label' => '権限レベル'));
else{
		echo $this->Form->input("User.authority_level",
		array('type' => 'select', 'options' => array('4' => '4(管理ユーザ)', '3' => '3(研究室管理ユーザ)', '2' => '2(研究室一般ユーザ)', '1' => '1(研究室外ユーザ)'), 'label' => '権限レベル', 'disabled' => true));
		echo $this->Form->input('User.authority_level', array('type' => 'hidden', 'value' => $this->data['User']['authority_level']));
}
?>