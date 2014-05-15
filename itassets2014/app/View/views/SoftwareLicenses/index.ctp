<table>
	<tr>
		<th><?php echo $this->Paginator->sort('Manufacturer.name', 'メーカー') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('SoftwareMaster.software_name', 'ソフトウェア') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('VersionMaster.version_name', 'バージョン') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('SoftwareLicense.keeps', '保管') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('SoftwareLicense.used', '使用中') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('SoftwareLicense.unused', '未使用') ?>&nbsp;</th>
		<?php if($this->request->controller === 'SoftwareLicenses'): ?>
		<th class="actions" style="vertical-align: top">操作</th>
		<?php endif; ?>
	</tr>
	<?php foreach($datas as $data): ?>
	<tr>
		<td><?php echo h($data['Manufacturer']['name']) ?></td>
		<td><?php echo h($data['SoftwareMaster']['software_name']) ?></td>
		<td><?php echo h($data['SoftwareMaster']['software_name'] . " " . $data['VersionMaster']['version_name']) ?></td>
		<td><?php echo h($data['SoftwareLicense']['keeps']) ?></td>
		<td><?php echo h($data['SoftwareLicense']['used']) ?></td>
		<td><?php echo h($data['SoftwareLicense']['unused']) ?></td>
		<?php if($this->request->controller === 'SoftwareLicenses'): ?>
		<td margin="left" class="actions"><?php echo $this->Html->link('詳細', array('action' => 'detail', $data['VersionMaster']['id'])) ?>
		</td>
		<?php endif; ?>
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
