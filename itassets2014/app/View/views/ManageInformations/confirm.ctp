<dl>
	<dt>所持者</dt>
	<dd>
		<?php echo h($list['user'][$this->data['ManageInformation']['user_id']]); ?>
		&nbsp;
	</dd>

	<dt>インストールPC</dt>
	<dd>
		<?php echo h($list['pc'][$this->data['ManageInformation']['pc_id']]); ?>
		&nbsp;
	</dd>

	<dt>インストールタイプ</dt>
	<dd>
		<?php echo h($list['type'][$this->data['ManageInformation']['install_type']]); ?>
		&nbsp;
	</dd>
</dl>