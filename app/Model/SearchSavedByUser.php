<?php

class SearchSavedByUser extends AppModel {

	public $name = 'SearchSavedByUser';
	public $useTable = 'search_saved_by_user';

    public $belongsTo = 'User';

}

?>
