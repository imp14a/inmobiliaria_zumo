<?php
/*Gmail component setup in cakephp by Shaharia Azam (shaharia.azam@gmail.com)*/

Configure::write('email.info', 'info@server.zumoinmobiliaria.mx');
Configure::write('email.admin', 'admin@server.zumoinmobiliaria.mx');

class EmailConfig {


    public $zumomail = array(
        'host' => 'mail.zumoinmobiliaria.mx',
        'port' => 25,
        'username' => 'info@zumoinmobiliaria.mx',
        'password' => ',.Inf0rm4c10n.,',
        'transport' => 'Smtp'
    );
}
?>