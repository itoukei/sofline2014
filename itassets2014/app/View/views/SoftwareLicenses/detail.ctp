<table>
	<tr>
		<th><?php echo $this->Paginator->sort('SoftwareLicense.name', '識別名') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('SoftwareLicense.purchase_date', '購入日時') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('SoftwareLicense.installed', '使用数') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('SoftwareLicense.created', '作成日時') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('SoftwareLicense.modified', '更新日時') ?>&nbsp;</th>
		<th class="actions" style="vertical-align: top">操作</th>
	</tr>

	<?php foreach($datas as $data): ?>
	<tr>
		</td>
		<td><?php echo h($data['SoftwareLicense']['name']) ?></td>
		<td><?php echo h(date('Y年n月j日', strtotime($data['SoftwareLicense']['purchase_date']))) ?>
		</td>
		<td style="text-align: right"><?php echo h($data['SoftwareLicense']['installed']) ?>
		</td>
		<td><?php echo h(date('Y年n月j日', strtotime($data['SoftwareLicense']['created']))); ?>
		</td>
		<td><?php echo h(date('Y年n月j日', strtotime($data['SoftwareLicense']['modified']))); ?>
		</td>
		<td margin="left" class="actions"><?php
		echo $this->Html->link('詳細', array('action' => 'view', $data['SoftwareLicense']['id']));
		if(AuthComponent::user('authority_level') >= 2) echo $this->Html->link('使用追加', array('controller' => 'ManageInformations', 'action' => 'add', $data['SoftwareLicense']['id']));
		if(AuthComponent::user('authority_level') >= 3){
				echo $this->Html->link('編集', array('action' => 'edit', $data['SoftwareLicense']['id']));
				echo $this->Form->postLink('削除', array('action' => 'delete', $data['SoftwareLicense']['id']), null, '本当に削除しますか？');
		}
		?>
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
