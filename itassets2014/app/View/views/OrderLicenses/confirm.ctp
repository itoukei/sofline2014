<dl>
	<dt>登録ソフトウェア完全名</dt>
	<dd>
		<?php echo h($masters['maker'][$this->data['OrderLicense']['manufacturer_id']]) . " " .
				h($masters['soft'][$this->data['OrderLicense']['software_master_id']]). " " .
				h($masters['ver'][$this->data['OrderLicense']['version_master_id']]); ?>
		&nbsp;
	</dd>

	<dt>個数</dt>
	<dd>
		<?php echo h($this->data['OrderLicense']['number']); ?>
		&nbsp;
	</dd>

	<dt>単価</dt>
	<dd>
		<?php echo h($this->data['OrderLicense']['price']); ?>
		&nbsp;
	</dd>

	<dt>予算枠</dt>
	<dd>
		<?php echo h($select[$this->data['OrderLicense']['budget_type']]); ?>
		&nbsp;
	</dd>

	<dt>予算枠詳細</dt>
	<dd>
		<?php echo h($this->data['OrderLicense']['budget_detail']); ?>
		&nbsp;
	</dd>

	<dt>納品場所</dt>
	<dd>
		<?php echo h($this->data['OrderLicense']['delivery_place']); ?>
		&nbsp;
	</dd>

	<dt>納品希望日</dt>
	<dd>
		<?php echo h(date('Y年n月j日', strtotime($date))); ?>
		&nbsp;
	</dd>
</dl>