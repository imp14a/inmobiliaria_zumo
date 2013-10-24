

<ul >
<?php foreach($output as $cp): ?>
    <li id="<?php echo $cp['CP']; ?>" state="<?php echo utf8_encode($cp['StateName']); ?>" 
    	municipality="<?php echo utf8_encode($cp['MunicipalityName']); ?>"
    	city="<?php echo utf8_encode($cp['CityName']); ?>"
    	quarter="<?php echo utf8_encode($cp['QuarterName']); ?>"
    	>
     	CP: <?php echo $cp['CP']; ?> - <strong><?php echo utf8_encode($cp['QuarterName']); ?></strong>
    </li>
<?php endforeach; ?>

</ul>