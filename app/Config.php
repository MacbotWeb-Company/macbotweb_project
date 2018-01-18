<?php

define('BASE_URL', 'http://localhost/mb_app/'); # Defini files to path
define('DEFAULT_CONTROLLER', 'index'); # Controller by default
define('DEFAULT_LAYOUT', 'default');

/* START DATES BY DEFAULT*/
$endDate   = date('d-M-Y', strtotime('-2 day'));
$startDate = date('d-M-Y' , strtotime('-3 month'));
define('DEFAULT_START_DATE', $startDate);
define('DEFAULT_END_DATE', $endDate);


define('APP_NAME', 'Macbot Web');
define('APP_SLOGAN', 'Mi primer framework php y mvc');
define('APP_CONPANY', 'MacBot Web Company');
define('SESSION_TIME', 60);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'macbot_db');
define('DB_CHAR', 'utf8');




?>