<table>
	<tr>
		<th><?php echo $this->Paginator->sort('Pc.name', 'PC名') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('Pc.os_name', 'OS名') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('User.screen_name', '所持者') ?>&nbsp;</th>
		<th><?php echo $this->Paginator->sort('Pc.pc_type', 'PC種別') ?>&nbsp;</th>
		<th class="actions" style="vertical-align: top">操作</th>
	</tr>

	<?php foreach($datas as $data): ?>
	<tr>
		<td><?php echo h($data['Pc']['name']) ?>
		</td>
		<td><?php echo h($data['Pc']['os_name']) ?>
		</td>
		<td><?php echo h($data['User']['screen_name']) ?>
		</td>
		<td><?php echo h($data['Pc']['pc_type']); ?>
		</td>
		<td margin="left" class="actions"><?php
			echo $this->Html->link('詳細', array('action' => 'view', $data['Pc']['id']));
			if(AuthComponent::user('authority_level') >= 3){
				echo $this->Html->link('編集', array('action' => 'edit', $data['Pc']['id']));
				echo $this->Form->postLink('削除', array('action' => 'delete', $data['Pc']['id']), null, '本当に削除しますか？');
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
