<?php
require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// DB table to use
$table = 'pages';

// Table's primary key
$primaryKey = 'ID';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'ID', 'dt' => 0 ),
    array( 'db' => 'title',  'dt' => 1 ),
    array( 'db' => 'status',   'dt' => 2 ),
    array( 'db' => 'author',     'dt' => 3 ),
    array( 'db' => 'created_at',     'dt' => 4 ),
);

// SQL server connection information
$sql_details = array(
    'user' => $_ENV['DATABASE_USER_NAME'],
    'pass' =>  $_ENV['DATABASE_PASSWORD'],
    'db'   => $_ENV['DATABASE_NAME'],
    'host' => $_ENV['DATABASE_HOST']
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

sleep(2);
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);