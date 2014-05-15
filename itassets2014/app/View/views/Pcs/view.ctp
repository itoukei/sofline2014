<br>
<br>
<div style="width: 40%; float: left">
	<div class="registration" style="float: right">
		<?php echo $this->Html->link('編集', array('action' => 'edit', $this->data['Pc']['id']), array('class' => 'registration')); ?>
	</div>
	<h4>PC情報</h4>
	<br>
	<table border=1 style="border-right: 1px solid;">
		<tr>
			<td>PC名</td>
			<td><?php echo h($this->data['Pc']['name']); ?> &nbsp;</td>
		</tr>

		<tr>
			<td>OS名</td>
			<td><?php echo h($this->data['Pc']['os_name']); ?> &nbsp;</td>
		</tr>

		<tr>
			<td>所持者</td>
			<td><?php echo h($select[$this->data['Pc']['user_id']]); ?> &nbsp;</td>
		</tr>

		<tr>
			<td>PC種別</td>
			<td><?php echo h($this->data['Pc']['pc_type']); ?> &nbsp;</td>
		</tr>
		<tr>
			<td>備考</td>
			<td><?php echo h($this->data['Pc']['note']); ?> &nbsp;</td>
		</tr>
		<tr>
			<td>作成日時</td>
			<td><?php echo h(date('Y年n月j日', strtotime($this->data['Pc']['created']))); ?>
				&nbsp;</td>
		</tr>
		<tr>
			<td>更新日時</td>
			<td><?php echo h(date('Y年n月j日', strtotime($this->data['Pc']['modified']))); ?>
				&nbsp;</td>
		</tr>
	</table>
</div>
<div style="width: 50%; float: right">
	<h4>所持者情報</h4>
	<br>
	<table border=1 style="border-right: 1px solid;">
		<tr>
			<td>ユーザ名</td>
			<td><?php echo h($this->data['User']['user_name']); ?> &nbsp;</td>
		</tr>
		<tr>
			<td>表示名</td>
			<td><?php echo h($this->data['User']['screen_name']); ?> &nbsp;</td>
		</tr>
		<tr>
			<td>権限レベル</td>
			<td><?php echo h($this->data['User']['authority_level']."({$level[$this->data['User']['authority_level']]})"); ?>
				&nbsp;</td>
		</tr>
		<tr>
			<td>作成日時</td>
			<td><?php echo h(date('Y年n月j日', strtotime($this->data['User']['created']))); ?>
				&nbsp;</td>
		</tr>
		<tr>
			<td>更新日時</td>
			<td><?php echo h(date('Y年n月j日', strtotime($this->data['User']['modified']))); ?>
				&nbsp;</td>
		</tr>
	</table>
</div>
<div style="width: 80%; float: left">
	<br>
	<h4>インストールソフトウェア一覧</h4>

	<table>
		<tr>
			<th><?php echo $this->Paginator->sort('Manufacturer.name', 'メーカー') ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('SoftwareMaster.software_name', 'ソフトウェア') ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('SoftwareLicense.name', '識別名') ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('SoftwareLicense.purchase_date', '購入日時') ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('ManageInformation.install_type', 'インストールタイプ') ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('SoftwareLicense.created', '作成日時') ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('SoftwareLicense.modified', '更新日時') ?>&nbsp;</th>
			<th class="actions" style="vertical-align: top">操作</th>
		</tr>

		<?php foreach($datas as $data): ?>
		<tr>
			</td>
			<td><?php echo h($data['Manufacturer']['name']) ?></td>
			<td><?php echo h($data['SoftwareMaster']['software_name'] . " " . $data['VersionMaster']['version_name']) ?>
			</td>
			<td><?php echo h($data['SoftwareLicense']['name']) ?></td>
			<td><?php echo h(date('Y年n月j日', strtotime($data['SoftwareLicense']['purchase_date']))) ?>
			</td>
			<td><?php echo ($data['ManageInformation']['install_type'] == 0) ? "サブ" : "メイン"; ?>
			</td>
			<td><?php echo h(date('Y年n月j日', strtotime($data['SoftwareLicense']['created']))); ?>
			</td>
			<td><?php echo h(date('Y年n月j日', strtotime($data['SoftwareLicense']['modified']))); ?>
			</td>
			<td margin="left" class="actions"><?php	echo $this->Html->link('詳細', array('controller' => 'SoftwareLicense', 'action' => 'view', $data['SoftwareLicense']['id'])); ?>
			</td>
		</tr>
		<?php endforeach ?>
	</table>
	<p>
		<?php echo $this->Paginator->counter(array('format' => '{:start}件目〜{:end}件目'))?>
	</p>
	<div style=floatleft: class="paging">
		<?php
		echo $this->Paginator->prev('< ' . '前のページ', array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next('次のページ' . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
</div>
