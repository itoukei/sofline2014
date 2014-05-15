<?php
class Pc extends AppModel{
	public $order = array('name' => 'asc');
	public $belongsTo = array('User');
}
?>
