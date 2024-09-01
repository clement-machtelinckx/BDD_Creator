<?php

require_once realpath('/vendor/autoload.php');


$db = new BDDCreator\Database('localhost', 'root', '');

$db->connect();
