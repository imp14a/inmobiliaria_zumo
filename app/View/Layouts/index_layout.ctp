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
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('inmobiliaria_zumo', 'Inmobiliaria Zumo');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->Html->css('inmobiliaria_zumo_index');
		echo $this->Html->css('inmobiliaria_zumo');
		echo $this->fetch('css');
		echo $this->Html->script('prototype');
		echo $this->Html->script('scriptaculous/scriptaculous');
		echo $this->Html->script('hover_efect_buttons');
		echo $this->fetch('script');
	?>
	<style>
	.navigationbar ul li:first-child{
		margin-top: 130px;
	}
	</style>
</head>
<body>
	<div id="container">
		<div class="navigationbar leftbar">
			<ul>
				<li><?php echo $this->Html->link($this->Html->div('button properties','<span class="title">PROPIEDADES</span>')
					,array('controller' => 'Property', 'action' => 'simple_search'),
					array('escape'=>false)); ?>
				</li>
				<li><?php echo $this->Html->link($this->Html->div('button news','<span class="title">NOTICIAS</span>')
					,array('controller' => 'InmobiliariaZumo', 'action' => 'news'),
					array('escape'=>false)); ?> 
				</li>
				<li><?php echo $this->Html->link($this->Html->div('button downloadables','<span class="title">DESCARGABLES</span>')
					,array('controller' => 'Downloadable', 'action' => 'view'),
					array('escape'=>false)); ?>
				</li>
			</ul>
		</div>
		<div class="navigationbar rightbar">
			<ul>
				<li><?php echo $this->Html->link($this->Html->div('button about','<span class="title">¿POR QUÉ ZUMO?</span>')
					,array('controller' => 'InmobiliariaZumo', 'action' => 'about'),
					array('escape'=>false)); ?>
				</li>
				<li><?php echo $this->Html->link($this->Html->div('button alliances','<span class="title">ALIANZAS</span>')
					,array('controller' => 'InmobiliariaZumo', 'action' => 'alliances'),
					array('escape'=>false)); ?> 
				</li>
				<li><?php echo $this->Html->link($this->Html->div('button contact','<span class="title">CONTACTO</span>')
					,array('controller' => 'InmobiliariaZumo', 'action' => 'contact'),
					array('escape'=>false)); ?>
				</li>
			</ul>
		</div>
		<div id="content">
			<div class='logo_vertical'>
				
			</div>
			<div class='indexinfo'>
				<style>
				.container{
					display: inline-block;
					width: auto;
					font-size: 16px;
					line-height: 22px;
				}
				</style>
				<div class="container" style="width: 780px;">
					<span> Somos una organizaci&oacute;n de profesionales inmobiliarios con productos y servicios especializados que cubren las</span>
					<div class="marker" data-maker-order="1"></div>
				</div>
				<div class="container">
					<span>necesidades de personas que desean vender, comprar o rentar una vivienda.</span>
					<div class="marker" data-maker-order="2"></div>
				</div>
				<div>
					<span>Brindamos asesor&iacute;a y representaci&oacute;n profesional a quienes desean realizar transacciones inmobiliarias.</span>
					<div class="marker" data-maker-order="3"></div>
				</div>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
