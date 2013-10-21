<?php 
    echo $this->Html->script('zumo_components');
    echo $this->Html->css('zumo_components');
    App::uses('CakeNumber', 'Utility');
?>
<div class="plainContent">
    <h1>Listado de Propiedades</h3>
    <?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>  
    <br>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Renta</th>
            <th>Venta</th>
            <th>Estado</th>
            <th>Municipio</th>
            <th>Precio de Renta</th>
            <th>Precio de Venta</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        <?php foreach ($properties as $property): ?>
        <tr>
            <td><?php echo $property['Property']['name']; ?></td>
            <td class="center"><?php echo $property['Property']['available_for_rent'] ? "Sí" : "No"; ?></td>
            <td class="center"><?php echo $property['Property']['available_for_sell'] ? "Sí" : "No"; ?></td>
            <td><?php echo $property['PropertyAddress']['state']; ?></td>
            <td><?php echo $property['PropertyAddress']['municipality']; ?></td>
            <td class="right"><?php echo $property['PropertyPaymentInformation']['rent_price'] ? CakeNumber::currency($property['PropertyPaymentInformation']['rent_price']) : "--"; ?></td>
            <td class="right"><?php echo $property['PropertyPaymentInformation']['sale_price'] ? CakeNumber::currency($property['PropertyPaymentInformation']['sale_price']) : "--"; ?></td>            
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
        <a class="activeButton" href="/inmobiliaria_zumo/index.php/property/add/">AGREGAR PROPIEDAD</a><a class="activeButton" href="/inmobiliaria_zumo/index.php/inmobiliariazumo/panelAdministration">CANCELAR</a>
    </table>
</div>