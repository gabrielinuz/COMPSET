<?php
/**
* Copyright (c) 2013 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

/*MESSAGES*/
define('CT_DATABASE_CONNECTION_ERROR', 'Error on Database connection! system message: ');
define('CT_DATABASE_TRANSACTION_ERROR', '¡Error on SQL Transaction! system message: ');

/*DATABASE CONNECTION FOR SQLITE*/
define('CT_DATABASE_ENGINE', 'sqlite');
define('CT_DATABASE_FILE_PATH', 'database/db.sqlite');
define('CT_DATABASE_CHARSET', 'utf8');

/*DATABASE CONNECTION FOR MYSQL*/
// define('CT_DATABASE_ENGINE', 'mysql');
// define('CT_DATABASE_HOST', 'localhost');
// define('CT_DATABASE_NAME', '****');
// define('CT_DATABASE_USER', '****');
// define('CT_DATABASE_PASS', '****');
// define('CT_DATABASE_CHARSET', 'utf8');

/*DATABASE CONNECTION FOR POSTGRESQL*/
// define('CT_DATABASE_ENGINE', 'pgsql');
// define('CT_DATABASE_HOST', 'localhost');
// define('CT_DATABASE_NAME', '****');
// define('CT_DATABASE_USER', '****');
// define('CT_DATABASE_PASS', '****');
// define('CT_DATABASE_CHARSET', 'utf8');
?>