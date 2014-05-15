<dl>
	<dt>登録ソフトウェア完全名</dt>
	<dd>
		<?php echo h($masters['maker'][$this->data['SoftwareLicense']['manufacturer_id']]) . " " .
				h($masters['soft'][$this->data['SoftwareLicense']['software_master_id']]). " " .
				h($masters['ver'][$this->data['SoftwareLicense']['version_master_id']]); ?>
		&nbsp;
	</dd>

	<dt>識別名</dt>
	<dd>
		<?php echo h($this->data['SoftwareLicense']['name']); ?>
		&nbsp;
	</dd>

	<dt>ライセンスキー</dt>
	<dd>
		<?php echo h($this->data['SoftwareLicense']['licese_key']); ?>
		&nbsp;
	</dd>

	<dt>購入日時</dt>
	<dd>
		<?php echo h(date('Y年n月j日', strtotime($date[0]))); ?>
		&nbsp;
	</dd>

	<dt>有効期限</dt>
	<dd>
		<?php echo h(date('Y年n月j日', strtotime($date[1]))); ?>
		&nbsp;
	</dd>

	<dt>備考</dt>
	<dd>
		<?php echo h($this->data['SoftwareLicense']['note']); ?>
		&nbsp;
	</dd>
</dl>
