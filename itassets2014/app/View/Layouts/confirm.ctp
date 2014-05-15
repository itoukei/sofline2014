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

?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo "登録情報確認"; ?>
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
		<div id="header"></div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			<h3>登録情報確認</h3>
			<?php echo $this->fetch('content'); ?>
			<?php echo $this->Form->create(); ?>
			<div class="input submit">
				<?php echo $this->Form->button("修正", array("div" => false, "onClick" => "history.back();return false", "onKeyPress" => "history.back();return false")) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $this->form->submit("確定", array("name" => "submit", 'div'=>false)); ?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
		<div id="footer"></div>
	</div>
</body>
</html>
