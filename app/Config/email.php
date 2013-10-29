<?php
/*Gmail component setup in cakephp by Shaharia Azam (shaharia.azam@gmail.com)*/

Configure::write('email.info', 'info@zumoinmobiliaria.com.mx');
Configure::write('email.admin', 'admin@zumoinmobiliaria.com.mx');
Configure::write('email.contact', 'contacto@zumoinmobiliaria.com.mx');

class EmailConfig {


    public $zumomail = array(
        'host' => 'mail.zumoinmobiliaria.com.mx',
        'port' => 25,
        'username' => 'info',
        'password' => '4tAz69QW',
        'transport' => 'Smtp',
        'tls' => true
    );
}
?>