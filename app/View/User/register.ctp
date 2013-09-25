
<?php 
    echo $this->Html->css('zumo_components');
    echo $this->Html->css('zumo_login');
    echo $this->Html->script('zumo_components');
?>

<div class="loginContent">
    <h3>REGISTRARSE</h3>
    <p>Recibe en tu correo electrónico noticias sobre propiedades que podrían interesarte de acuerdo  a los filtros de las búsquedas que guardes. Este servicio es gratuito y puede ser dado de baja cuando tú lo decidas.</p>

    <?php echo $this->Form->create();?>
        <label>Nombre Usuario</label>
        <div class="input text">
            <?php echo $this->Form->input('User.username',array('label'=>false)); ?>
        </div>
        <label>Correo electrónico</label>
        <div class="input email">
            <?php echo $this->Form->input('User.email',array('type'=>'email','label'=>false)); ?>
        </div>
        <label>Contraseña (mínimo 6 cacteres)</label>
        <div class="input password">
            <?php echo $this->Form->password('User.password'); ?>
        </div>
        <label>Confirmar Contraseña</label>
        <div class="input password">
            <?php echo $this->Form->password('User.password_confirm'); ?>
        </div>
        <div class=\"submit\">
            <input type="submit" class="activeButton" value="REGISTRARSE">
            <input type="button" class="lightwindow_action activeButton" rel="deactivate" value="CANCELAR">
        </div>
    <?php echo $this->Form->end();?>
</div>