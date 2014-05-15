<dl>
	<dt>PC名</dt>
	<dd>
		<?php echo h($this->data['Pc']['name']); ?>
		&nbsp;
	</dd>

	<dt>OS名</dt>
	<dd>
		<?php echo h($this->data['Pc']['os_name']); ?>
		&nbsp;
	</dd>

	<dt>所持者</dt>
	<dd>
		<?php echo h($select[$this->data['Pc']['user_id']]); ?>
		&nbsp;
	</dd>

	<dt>PC種別</dt>
	<dd>
		<?php echo h($this->data['Pc']['pc_type']); ?>
		&nbsp;
	</dd>

	<dt>備考</dt>
	<dd>
		<?php echo h($this->data['Pc']['note']); ?>
		&nbsp;
	</dd>
</dl>