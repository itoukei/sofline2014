<h3>ログイン情報</h3>
<div style="text-align: center">
	<h1 style="font-size: 120%;">
		<b> <?php echo(AuthComponent::user('screen_name') . ': ' . $level[AuthComponent::user('authority_level')]) ?>
		</b>
	</h1>
	<br>
	<ul>
		<?php if(AuthComponent::user('authority_level') >= 2): ?>
			<li><?php echo $this->Html->link('ユーザ情報', '/Authenticates/view', array('class' => 'button')) ?></li>
		<?php endif; ?>
		<li><?php echo $this->Html->link('ログアウト', '/Authenticates/logout', array('class' => 'button')) ?></li>
	</ul>
</div>
<hr>
<br>
<h3>操作</h3>
<ul>
	<li><?php echo $this->Html->link('ライセンス管理', '/SoftwareLicenses', array('class' => 'button')) ?></li>
	<?php if(AuthComponent::user('authority_level') >= 4): ?>
		<li><?php echo $this->Html->link('仮登録管理', '/OrderLicenses', array('class' => 'button')) ?></li>
		<li><?php echo $this->Html->link('マスタ管理', '/SoftwareMasters', array('class' => 'button')) ?></li>
		<li><?php echo $this->Html->link('ユーザ管理', '/Users', array('class' => 'button')) ?></li>
	<?php endif; ?>
	<?php if(AuthComponent::user('authority_level') >= 2): ?>
		<li><?php echo $this->Html->link('PC管理', '/Pcs', array('class' => 'button')) ?></li>
	<?php endif; ?>
</ul>
