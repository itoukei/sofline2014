<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$c = $this->request->controller;
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
		<?php if(AuthComponent::user('authority_level') >= 4): ?>
			<div class="registration">
				<?php
				echo $this->Html->link('研究室マスタ', array('controller' => 'LaboratoryMasters', 'action' => 'view'),
						  array('class' => 'registration')); ?>
			</div>
		<?php endif; ?>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>
			<div class="<?php echo "{$c} index"; ?>">
				<div class="top">
					<?php
					// 権限レベル2以上でライセンス管理情報にアクセスした場合及び権限レベル3以上でアクセスした場合
					if(($c === "ManageInformations" && AuthComponent::user('authority_level') >= 2) ||
						 (AuthComponent::user('authority_level') >= 3)):
					?>
					<div class="registration" style="float: right">
						<?php
							if($c === "ManageInformations" ) echo $this->Html->link('登録', array('action' => 'add', $id),  array('class'=>'registration'));
							else echo $this->Html->link('登録', array('action' => 'add'),  array('class'=>'registration'));
						?>
					</div>
					<?php endif; ?>
					<div class="title"><?php echo $title_for_layout; ?></div>
					<br>
				</div>
				<?php echo $this->fetch('content'); ?>
			</div>
			<div class="actions">
				<?php echo (AuthComponent::user()) ? $this->element('menu') : $this->element('authMenu'); ?>
			</div>
		<div id="footer">

		</div>
	</div>
</body>
</html>
