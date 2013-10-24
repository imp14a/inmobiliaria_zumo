<?php
/*Gmail component setup in cakephp by Shaharia Azam (shaharia.azam@gmail.com)*/

Configure::write('email.info', 'imp14a@gmail.com');
Configure::write('email.admin', 'imp14a@gmail.com');

class EmailConfig {


    public $gmail = array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'rgarcia.cejudo@gmail.com',
        'password' => ',.R1c4rd0GC.,',
        'transport' => 'Smtp'
    );
}
?>