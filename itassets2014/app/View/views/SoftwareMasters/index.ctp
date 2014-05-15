<table>
	<tr>
		<th><?php echo $this->Paginator->sort('Manufacturer.name', 'メーカー') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('SoftwareMaster.software_name', 'ソフトウェア') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('VersionMaster.version_name', 'バージョン') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('SoftwareMaster.install_limit', '使用上限') ?>&nbsp;</th>
		<th class="actions" style="vertical-align: top">操作</th>
	</tr>

	<?php foreach($datas as $data): ?>
	<tr>
		<td><?php echo h($data['Manufacturer']['name']) ?></td>
		<td><?php echo h($data['SoftwareMaster']['software_name']) ?></td>
		<td><?php echo h($data['VersionMaster']['version_name']) ?></td>
		<td style="text-align: right"><?php echo h($data['SoftwareMaster']['install_limit']) ?></td>
		<td margin="left" class="actions"><?php echo $this->Html->link('編集', array('action' => 'edit', $data['VersionMaster']['id'])) ?>
			<?php echo $this->Form->postLink('削除', array('action' => 'delete', $data['VersionMaster']['id']), null, '本当に削除しますか？'); ?>
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
