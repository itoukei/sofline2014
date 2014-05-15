<table>
	<tr>
		<th><?php echo $this->Paginator->sort('SoftwareMaster.software_name', 'ソフトウェア') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort("OrderLicense.number", "個数") ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort("OrderLicense.price", "単価") ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort("OrderLicense.budget_type", "予算枠") ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort("OrderLicense.budget_detail", "予算枠詳細") ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort("OrderLicense.delively_place", "納品場所") ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort("OrderLicense.delively_date", "納品希望日") ?>&nbsp;</th>
		<th class="actions" style="vertical-align: top">操作</th>
	</tr>
	<?php foreach($datas as $data): ?>
	<tr>
		<td><?php echo h($data['SoftwareMaster']['software_name'] . " " . $data['VersionMaster']['version_name']) ?></td>
		<td><?php echo h($data['OrderLicense']['number']) ?></td>
		<td><?php echo h($data['OrderLicense']['price']) ?></td>
		<td><?php echo h($data['OrderLicense']['budget_type']) ?></td>
		<td><?php echo h($data['OrderLicense']['budget_detail']) ?></td>
		<td><?php echo h($data['OrderLicense']['delivery_place']) ?></td>
		<td><?php echo h($data['OrderLicense']['delivery_date']) ?></td>
		<td margin="left" class="actions"><?php echo $this->Html->link('編集', array('action' => 'edit', $data['OrderLicense']['id'])) ?>
			<?php //if(AuthComponent::user('authority_level') >= 3)
					echo $this->Form->postLink('削除', array('action' => 'delete', $data['OrderLicense']['id']), null, '本当に削除しますか？'); ?>
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
