<br>
<br>
<div style="width: 100%;">
	<div style="width: 40%; float: left">
		<div class="registration" style="float: right">
			<?php echo $this->Html->link('編集', array('action' => 'edit', $this->data['SoftwareLicense']['id']), array('class' => 'registration')); ?>
		</div>
		<h4>ソフトウェアライセンス情報</h4>
		<br>
		<table border=1 style="border-right: 1px solid;">
			<tr>
				<td>ソフトウェア完全名</td>
				<td><?php echo h($masters['maker'][$this->data['SoftwareLicense']['manufacturer_id']]) . " " .
						h($masters['soft'][$this->data['SoftwareLicense']['software_master_id']]). " " .
					h($masters['ver'][$this->data['SoftwareLicense']['version_master_id']]); ?>
					&nbsp;</td>
			</tr>
			<tr>
				<td>識別名</td>
				<td><?php echo h($this->data['SoftwareLicense']['name']); ?> &nbsp;</td>
			</tr>
			<tr>
				<td>ライセンスキー</td>
				<td><?php echo h($this->data['SoftwareLicense']['licese_key']); ?>
					&nbsp;</td>
			</tr>
			<tr>
				<td>購入日時</td>
				<td><?php echo ($this->data['SoftwareLicense']['purchase_date']==0) ? '(未入力)' : h(date('Y年n月j日', strtotime($this->data['SoftwareLicense']['purchase_date']))); ?>
					&nbsp;</td>
			</tr>
			<tr>
				<td>有効期限</td>
				<td><?php echo ($this->data['SoftwareLicense']['term']==0) ? '(未入力)' : h(date('Y年n月j日', strtotime($this->data['SoftwareLicense']['term']))); ?>
					&nbsp;</td>
			</tr>
			<tr>
				<td>使用数</td>
				<td><?php echo h($this->data['SoftwareLicense']['installed']); ?> &nbsp;</td>
			</tr>
			<tr>
				<td>備考</td>
				<td><?php echo h($this->data['SoftwareLicense']['note']); ?> &nbsp;</td>
			</tr>
			<tr>
				<td>作成日時</td>
				<td><?php echo h(date('Y年n月j日', strtotime($this->data['SoftwareLicense']['created']))); ?>
					&nbsp;</td>
			</tr>
			<tr>
				<td>更新日時</td>
				<td><?php echo h(date('Y年n月j日', strtotime($this->data['SoftwareLicense']['modified']))); ?>
					&nbsp;</td>
			</tr>
		</table>
	</div>
	<?php if($this->data['SoftwareLicense']['order_license_id'] != null): ?>
	<div style="width: 50%; float: right">
		<h4>ソフトウェア仮登録情報</h4>
		<br>
		<table border=1 style="border-right: 1px solid;">
			<tr>
				<td>登録ソフトウェア完全名</td>
				<td><?php echo h($masters['maker'][$this->data['OrderLicense']['manufacturer_id']]) . " " .
						h($masters['soft'][$this->data['OrderLicense']['software_master_id']]). " " .
					h($masters['ver'][$this->data['OrderLicense']['version_master_id']]); ?>
					&nbsp;</td>
			</tr>

			<tr>
				<td>個数</td>
				<td><?php //echo h($this->data['OrderLicense']['number']); ?> &nbsp;</td>
			</tr>

			<tr>
				<td>単価</td>
				<td><?php echo h($this->data['OrderLicense']['price']); ?> &nbsp;</td>
			</tr>

			<tr>
				<td>予算枠</td>
				<td><?php echo h($select[$this->data['OrderLicense']['budget_type']]); ?>
					&nbsp;</td>
			</tr>

			<tr>
				<td>予算枠詳細</td>
				<td><?php echo h($this->data['OrderLicense']['budget_detail']); ?>
					&nbsp;</td>
			</tr>

			<tr>
				<td>納品場所</td>
				<td><?php echo h($this->data['OrderLicense']['delivery_place']); ?>
					&nbsp;</td>
			</tr>

			<tr>
				<td>納品希望日</td>
				<td><?php echo h(date('Y年n月j日', strtotime($date))); ?> &nbsp;</td>
			</tr>
		</table>
	</div>
	<?php endif; ?>
</div>

<div style="width: 80%; float: left">
<br>
	<h4>ライセンス管理情報一覧</h4>

	<table>
		<tr>
			<th><?php echo $this->Paginator->sort('Pc.pc_id', 'インストールPC') ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('User.screen_name', 'PC所持者') ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('ManageInformation.install_type', 'インストールタイプ') ?>&nbsp;</th>
			<th class="actions" style="vertical-align: top">操作</th>
		</tr>

		<?php foreach($datas as $data): ?>
		<tr>
			<td><?php echo h($data['Pc']['name']) ?>
			</td>
			<td><?php echo h($data['User']['screen_name']) ?>
			</td>
			<td><?php echo ($data['ManageInformation']['install_type'] == 0) ? "サブ" : "メイン"; ?>
			</td>
			<td margin="left" class="actions"><?php  ?>
				<?php
				if(AuthComponent::user('authority_level') >= 3 || AuthComponent::user('id') == $data['ManageInformation']['user_id']){
					echo $this->Html->link('編集', array('controller' => 'ManageInformations', 'action' => 'edit', $data['ManageInformation']['id']));
					echo $this->Form->postLink('削除', array('controller' => 'ManageInformations', 'action' => 'delete', $data['ManageInformation']['id']), null, '本当に削除しますか？');
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
