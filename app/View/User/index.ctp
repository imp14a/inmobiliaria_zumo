<?php 
    echo $this->Html->script('zumo_components');
    echo $this->Html->css('zumo_components');
?>
<div class="plainContent">
    <h1>Listado de usuarios</h3><br>   
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Usuario</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['User']['first name']; ?></td>
            <td><?php echo $user['User']['last_name']; ?></td>
            <td><?php echo $user['User']['username']; ?></td>
            <td><?php echo $this->Html->link('editar', array('controller' => 'user', 'action' => 'add', $user['User']['id'])); ?>
            <td>
                <?php echo $this->Form->postLink(
                    'borrar',
                    array('action' => 'delete', $user['User']['id']),
                    array('confirm' => 'Desea eliminar el usuario?'));
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <a class="activeButton" href="/inmobiliaria_zumo/index.php/user/add/">AGREGAR USUARIO</a>
    </table>
</div>