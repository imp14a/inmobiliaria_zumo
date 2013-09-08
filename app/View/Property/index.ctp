<?php 
    echo $this->Html->script('zumo_components');
    echo $this->Html->css('zumo_components');
?>
<div class="plainContent">
    <h1>Listado de usuarios</h3><br>   
    <table>
        <tr>
            <th>Nombre</th>
            <th>Renta</th>
            <th>Venta</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        <?php foreach ($properties as $property): ?>
        <tr>
            <td><?php echo $property['Property']['name']; ?></td>
            <td><?php echo $property['Property']['available_for_rent'] ? "Sí" : "No"; ?></td>
            <td><?php echo $property['Property']['available_for_sell'] ? "Sí" : "No"; ?></td>
            <td><?php echo $this->Html->link('editar', array('controller' => 'property', 'action' => 'add', $property['Property']['id'])); ?>
            <td>
                <?php echo $this->Form->postLink(
                    'borrar',
                    array('action' => 'delete', $property['Property']['id']),
                    array('confirm' => 'Desea eliminar la propiedad?'));
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <a class="activeButton" href="/inmobiliaria_zumo/index.php/property/add/">AGREGAR PROPIEDAD</a>
    </table>
</div>