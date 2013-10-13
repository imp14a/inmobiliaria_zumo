
<?php 
    echo $this->Html->css('zumo_components');
    echo $this->Html->css('zumo_login');
    echo $this->Html->script('zumo_components');
?>

<div class="loginContent">
    <h3>REGISTRARSE</h3>
    <p>Recibe en tu correo electr&oacute;nico noticias sobre propiedades que podr&iacute;an interesarte de acuerdo  a los filtros de las b&uacute;squedas que guardes. Este servicio es gratuito y puede ser dado de baja cuando t&uacute; lo decidas.</p>

    <?php echo $this->Form->create('User');?>
        <label>Nombre usuario</label>
        <div class="input text">
            <?php echo $this->Form->input('username',array('label'=>false)); ?>
        </div>
        <label>Correo electr&oacute;nico</label>
        <div class="input email">
            <?php echo $this->Form->input('email',array('type'=>'email','label'=>false)); ?>
        </div>
        <label>Contrase&ntilde;a (m&iacute;nimo 6 cacteres)</label>
        <div class="input password">
            <?php echo $this->Form->input('password',array('label'=>false));/*, 'error' => array(
            'minlength' => __('Debe ingresar por lo menos 6 caracteres.', true)));*/ ?>
        </div>
        <label>Confirmar Contrase&ntilde;a</label>
        <div class="input password">
            <?php echo $this->Form->input('password_confirm', array('label'=>false,'type' => 'password'));/*, 'error' => array(
            'checkpasswords' => __('DLas contraseñas no coinciden.', true)));*/ ?>
        </div>
        <div class="submit" style="margin-left: 10px;">
            <input type="submit" class="activeButton" value="REGISTRARSE">
            <input type="button" class="lightwindow_action activeButton" rel="deactivate" value="CANCELAR">
        </div>
    <?php echo $this->Form->end();?>
    <?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
</div>