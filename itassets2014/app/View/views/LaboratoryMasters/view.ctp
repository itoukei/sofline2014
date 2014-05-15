<br>
<br>
<div style="width: 40%">
	<div class="registration" style="float:right">
			<?php echo $this->Html->link('編集', array('action' => 'edit', 1), array('class' => 'registration')); ?>
	</div>
	<h4>研究室マスタ情報の変更</h4>
	<br>
	<table border=1>
		<?php if(isset($this->data['LaboratoryMaster'])): ?>
		<tr>
			<td>研究室番号</td>
			<td><?php echo h($this->data['LaboratoryMaster']['laboratory_number']); ?>
				&nbsp;</td>
		</tr>
		<tr>
			<td>教授名</td>
			<td><?php echo h($this->data['LaboratoryMaster']['professor_name']); ?>
				&nbsp;</td>
		</tr>
		<tr>
			<td>教授の役職</td>
			<td><?php echo h($this->data['LaboratoryMaster']['professor_position']); ?>
				&nbsp;</td>
		</tr>
		<tr>
			<td>教授の所属領域</td>
			<td><?php echo h($this->data['LaboratoryMaster']['professor_affiliation']); ?>
				&nbsp;</td>
		</tr>
		<?php endif; ?>
	</table>
	<br>
	<h4>バックアップファイル作成</h4>

	<?php
	echo $this->Form->create(false);
	echo $this->Form->submit("ダウンロード",array('name'=>'back'));
	echo $this->Form->end();
	?>
</div>
