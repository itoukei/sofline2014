<h3>ユーザログイン</h3>
<?php echo $this->Form->create('User'); ?>
<div class="abc">
	<span class="ab"> <?php echo $this->Form->label('user_name', 'ユーザ名', array('label' => false, 'div' => false, 'style' => 'width:50%;display:inline')); ?>
	</span> <span class="ac"> <?php echo $this->Form->input('user_name', array('label' => false, 'div' => false, 'style' => 'width:100%')); ?>
	</span>
</div>
<div class="xyz">
	<span class="xy"> <?php echo $this->Form->label('password', 'パスワード', array('label' => false, 'div' => false, 'style' => 'width:50%;display:inline')); ?>
	</span> <span class="xz"> <?php echo $this->Form->input('password', array('label' => false, 'div' => false, 'type' => 'password', 'style' => 'width:100%')); ?>
	</span>
</div>
<div class="button">
	<?php echo $this->Form->submit('ログイン', array('div' => false)); ?>
</div>