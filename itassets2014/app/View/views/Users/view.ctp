<br>
<br>
<div style="width: 40%">
	<div class="registration" style="float: right">
		<?php if($this->request->controller === "Authenticates") echo $this->Html->link('パスワード変更', array('controller' => 'Users', 'action' => 'password', $this->data['User']['id']), array('class' => 'registration')); ?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link('編集', array('action' => 'edit', $this->data['User']['id']), array('class' => 'registration')); ?>
	</div>
	<h4>ユーザ情報</h4>
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
			<td>パスワード</td>
			<td>(非表示)&nbsp;</td>
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
<br>
<div style="width: 80%">
	<h4>所時PC一覧</h4>

	<table>
		<tr>
			<th><?php echo $this->Paginator->sort('Pc.name', 'PC名') ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('Pc.os_name', 'OS名') ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('Pc.pc_type', 'PC種別') ?>&nbsp;</th>

			<th class="actions" style="vertical-align: top">操作</th>
		</tr>

		<?php foreach($datas as $data): ?>
		<tr>
			<td><?php echo h($data['Pc']['name']) ?>
			</td>
			<td><?php echo h($data['Pc']['os_name']) ?>
			</td>
			<td><?php echo h($data['Pc']['pc_type']); ?>
			</td>
			<td margin="left" class="actions"><?php
			if(AuthComponent::user('authority_level') >= 3){
				echo $this->Html->link('編集', array('controller' => 'Pcs', 'action' => 'edit', $data['Pc']['id']));
				echo $this->Form->postLink('削除', array('controller' => 'Pcs', 'action' => 'delete', $data['Pc']['id']), null, '本当に削除しますか？');
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
</div>
