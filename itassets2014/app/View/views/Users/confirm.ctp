<dl>
	<dt>ユーザ名</dt>
	<dd>
		<?php echo h($this->data['User']['user_name']); ?>
		&nbsp;
	</dd>
	<dt>表示名</dt>
	<dd>
		<?php echo h($this->data['User']['screen_name']); ?>
		&nbsp;
	</dd>

	<dt>権限レベル</dt>
	<dd>
		<?php echo h($this->data['User']['authority_level']."({$level[$this->data['User']['authority_level']]})"); ?>
		&nbsp;
	</dd>
</dl>