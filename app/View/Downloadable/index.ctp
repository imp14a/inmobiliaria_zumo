<?php 
    echo $this->Html->script('zumo_components');
    echo $this->Html->css('zumo_components');
?>
<div class="plainContent">
    <h1>Listado de descargables</h3>
    <?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>  
    <br>
    <table>
        <tr>
            <th>Nombre de archivo</th>
            <th>T&iacute;tulo</th>
            <th>Descripci&oacute;n</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        <?php foreach ($downloadables as $download): ?>
        <tr>
            <td><?php echo $download['Downloadable']['file_name']; ?></td>
            <td><?php echo $download['Downloadable']['title']; ?></td>
            <td><?php echo $download['Downloadable']['description']; ?></td>
            <td><?php echo $this->Html->link('editar', array('controller' => 'Downloadable', 'action' => 'upload', $download['Downloadable']['id'])); ?>
            <td>
                <?php echo $this->Form->postLink(
                    'borrar',
                    array('action' => 'delete', $download['Downloadable']['id']),
                    array('confirm' => 'Desea eliminar el archivo?'));
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <a class="activeButton" href="/index.php/Downloadable/upload/">AGREGAR DESCARGABLE</a><a class="activeButton" href="/index.php/InmobiliariaZumo/panelAdministration">CANCELAR</a>
    </table>
</div>