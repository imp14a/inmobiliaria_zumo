<?php
/*
   We always want a JSON  page to always convert an object to its representation.
   Nothing else
*/
header("Pragma: no-cache");
header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
//header("Content-Type: application/json; charset=". strtolower(Configure::read('App.encoding')));
// Fix for IE?
header('Content-type: application/json');
//header('X-JSON: '.($javascript->object($this->viewVars)));
echo json_encode($output);
?>