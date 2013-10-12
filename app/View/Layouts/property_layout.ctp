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
		echo $this->Html->css('inmobiliaria_zumo');
		echo $this->Html->css('lightwindow');
		echo $this->fetch('css');
		echo $this->Html->script('prototype');
		echo $this->Html->script('scriptaculous/scriptaculous');
		echo $this->Html->script('hover_efect_buttons');
		echo $this->Html->script('lightwindow');
		echo $this->fetch('script');

	?>
	<style>
	.properties_submenu li{
		margin-top: 0;
	}
	</style>
</head>
<body>
	<div id="header">
		<?php echo $this->Html->link($this->Html->div('logo','')
			,array('controller' => 'InmobiliariaZumo', 'action' => 'index'),
			array('escape'=>false)); ?>
		<div class="userGroupButtons">
			<?php echo $this->Session->read('Auth.User') ? "<label>Hola ".$this->Session->read('Auth.User.username')."</label>" : $this->Html->link('INICIAR SESIÓN' ,array('controller' => 'User', 'action' => 'login'),
				array('id'=>"login",'class'=>"lightwindow", 'title'=>"Login","params"=>
				"lightwindow_width=290,lightwindow_height=200,lightwindow_type=page,lightwindow_iframe_embed=true"));?>
			|
			<?php echo $this->Session->read('Auth.User') ? $this->Html->link('CERRAR SESIÓN' ,array('controller' => 'User', 'action' => 'logout')) : $this->Html->link('REGISTRARSE' ,array('controller' => 'User', 'action' => 'register'),
				array('id'=>"register",'class'=>"lightwindow", 'title'=>"Register","params"=>
				"lightwindow_width=290,lightwindow_height=380,lightwindow_type=page"));?>
		</div>
	</div>
	<div id="container">
		<div class="navigationbar leftbar">
			<ul>
				<li><?php echo $this->Html->link($this->Html->div('button properties','<span class="title">PROPIEDADES</span>')
					,array('controller' => 'Property', 'action' => 'simple_search'),
					array('escape'=>false)); ?>
					<ul class="properties_submenu">
						<li>
							<?php echo $this->Html->link('BÚSQUEDA' ,array('controller' => 'Property', 'action' => 'simple_search'),
							array('class'=>isset($simple_search)?'active':''));?>
						</li>
						<li>
							<?php echo $this->Html->link('BÚSQUEDA EN MAPA' ,array('controller' => 'Property', 'action' => 'map_search'),array('class'=>isset($map_search)?'active':''));
							?>
						</li>
						<!-- TODO poner mis busquedas cuando este activo -->
						<li>
							<?php echo $this->Html->link('MIS BUSQUEDAS' ,array('controller' => 'Property', 'action' => 'user_searchs'),array('class'=>isset($user_searchs)?'active':''));
							?>
						</li>
					</ul>
				</li>
				<li><?php echo $this->Html->link($this->Html->div('button news','<span class="title">NOTICIAS</span>')
					,array('controller' => 'InmobiliariaZumo', 'action' => 'news'),
					array('escape'=>false)); ?> 
				</li>
				<li><?php echo $this->Html->link($this->Html->div('button downloadables','<span class="title">DESCARGABLES</span>')
					,array('controller' => 'InmobiliariaZumo', 'action' => 'downloadables'),
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
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
<script type="text/javascript">
</script>
</html>