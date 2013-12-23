<?php
/**
 * @Project 'Denuncie'
 * @Author Leandro de Souza Araujo
 * Projeto desenvolvido para servir de plataforma para denúncias na internet.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$templateDescription = __d('developer', 'Denuncie App - Powered CakePHP');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $templateDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->css('estilo');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id='full-header'>
		<div id="header">
			<div id='logomarca'>
				<?= 
					$this->Html->link(
						$this->Html->image('logomarca.png', array('alt' => $templateDescription, 'border' => '0')),
						array('controller' => 'index', 'action' => 'index'),
						array('escape' => false)
					);
				?>
			</div>
			<div id='menu'>
				<ul>
					<li class='item-menu'><?= $this->Html->link('Home', array('controller' => 'index', 'action' => 'index')); ?></li>
					<li class='item-menu'><?= $this->Html->link('Ranking', array('controller' => 'denuncias', 'action' => 'ranking')); ?></li>
					<li class='item-menu'><?= $this->Html->link('Cadastro', array('controller' => 'users', 'action' => 'add')); ?></li>
					<?php if(!AuthComponent::user('id')){ ?>
					<li class='item-menu-special'><?= $this->Html->link('Log in', array('controller' => 'users', 'action' => 'login')); ?></li>
					<?php }else{ ?>
					<li class='item-menu-special'><?= $this->Html->link('Log out', array('controller' => 'users', 'action' => 'logout')); ?></li>
					<?php } ?>
				</ul>
			</div>			
		</div>	
	</div>
	<?php if(AuthComponent::user('id')){ ?>
		<div id='user-logged-bar'>
			<p> 
				Seja bem vindo (a) <?= AuthComponent::user('username'); ?> &nbsp; |
				<?= $this->Html->link('Minhas Denúncias', array('controller' => 'denuncias', 'action' => 'all')); ?>
				| <?= $this->Html->link('Denunciar', array('controller' => 'denuncias', 'action' => 'add')); ?>
			</p>
		</div>
	<?php } ?>
	<div id="content">

		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>
	</div>
	<div id="footer">
		<h3>Denuncie!</h3>
		<p>Todos os direitos reservados</p>
		<?php echo $this->Html->link(
				$this->Html->image('cake.power.gif', array('alt' => $templateDescription, 'border' => '0')),
				'http://www.cakephp.org/',
				array('target' => '_blank', 'escape' => false)
			);
		?>
	</div>
	<?php /* echo $this->element('sql_dump');*/  ?>
</body>
</html>
