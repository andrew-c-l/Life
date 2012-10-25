<?php
include_once(LIBRARY . 'Zend/Db.php');
include_once(LIBRARY . 'Zend/Db/Table/Abstract.php');
include_once(LIBRARY . 'Zend/Db/Table.php');
include_once(LIBRARY . 'Zend/Db/Adapter/Abstract.php');
include_once(LIBRARY . 'Zend/Db/Adapter/Pdo/Abstract.php');
include_once(LIBRARY . 'Zend/Db/Adapter/Pdo/Mysql.php');
include_once(LIBRARY . 'Zend/Db/Profiler.php');
include_once(LIBRARY . 'Zend/Db/Select.php');
include_once(LIBRARY . 'Zend/Db/Expr.php');
include_once(LIBRARY . 'Zend/Loader.php');
include_once(LIBRARY . 'Zend/Db/Statement/Interface.php');
include_once(LIBRARY . 'Zend/Db/Statement.php');

$db = Zend_Db::factory(
	'Pdo_Mysql', array(
	    'host'     => $dbhost,
	    'username' => $dbuser,
	    'password' => $dbpass,
	    'dbname'   => $dbname
));

Zend_Db_Table::setDefaultAdapter($db);