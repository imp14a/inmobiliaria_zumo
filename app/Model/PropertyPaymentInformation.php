<?php

class PropertyPaymentInformation extends AppModel {

	public $name = 'PropertyPaymentInformation';
	public $useTable = 'property_payment_information';

    public $belongsTo = 'Property';

}

?>
