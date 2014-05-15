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

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $title_for_layout; ?>
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
			<?php echo $this->Html->script('jquery'); ?>
			<?php echo $this->Html->script('SubmitControl'); ?>
			<?php
				if($this->request->controller === "SoftwareLicenses" || $this->request->controller === "SoftwareMasters" ||
					$this->request->controller === "OrderLicenses" || $this->request->controller === "ManageInformations")
						echo $this->Html->script('ConnectedSelect');
			?>
			<script type='text/javascript'>
			//<![CDATA[
				window.onload = function(){SubmitControl(document.getElementsByTagName("input"));}
			//]]>
			</script>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<h3>
				<?php echo $title_for_layout ?>
			</h3>
			<?php echo $this->Form->create(false); ?>
			<fieldset>
				<?php echo $this->fetch('content'); ?>
			</fieldset>
			<div class='input submit'>
				<?php echo $this->Form->button("戻る", array("div" => false, "onClick" => "history.back();return false", "onKeyPress" => "history.back();return false")) . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $this->form->submit('送信', array('div'=>false)); ?>
			</div>
			<?php echo $this->Form->end(); ?>
			<div id="footer"></div>
		</div>

</body>
</html>
