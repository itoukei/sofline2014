<?php
echo $this->Form->input('LaboratoryMaster.id', array('type' => 'hidden', 'value' => 1));
echo $this->Form->input("LaboratoryMaster.laboratory_number", array("label" => "研究室番号"));
echo $this->Form->input("LaboratoryMaster.professor_name", array("label" => "教授名"));
echo $this->Form->input("LaboratoryMaster.professor_position", array("label" => "教授の役職"));
echo $this->Form->input("LaboratoryMaster.professor_affiliation", array('label' => '教授の所属領域', 'type' => 'select', 'options' => $select, 'empty' => '選択'));
?>