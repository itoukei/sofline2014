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
			<div class="registration">
				<?php //echo $this->Html->link('戻る', '#',  array('onClick' => "history.back(); return false;", 'class'=>'registration'));?>
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			<div class="<?php echo "{$c} view"; ?>">
				<div class="top">
					<div class="title"><?php echo $title_for_layout; ?></div>
					<br>
				</div>
				<?php echo $this->fetch('content'); ?>
			</div>
			<div class="actions">
				<?php echo $this->element('menu');?>
			</div>
		<div id="footer">

		</div>
	</div>
</body>
</html>
