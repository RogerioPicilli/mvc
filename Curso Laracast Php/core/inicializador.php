<?php 

$config = require 'config.php';

require 'core/Router.php';

require 'Task.php';
require 'core/database/Connection.php';
require 'core/database/QueryBuilder.php';


$pdo = Connection::make($config['database']);
$query = new QueryBuilder($pdo);