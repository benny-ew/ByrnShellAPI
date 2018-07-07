<?php
return [
	'fetch' => PDO::FETCH_CLASS,
	'default' => env('DB_CONNECTION'),
	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/
	'connections' => [
		'shelldb' => [
			'driver' => 'pgsql',
			'host' => env('DB_HOST'),
			'port' => env('DB_PORT'),
			'database' => env('DB_DATABASE'),
			'username' => env('DB_USERNAME'),
			'password' => env('DB_PASSWORD'),
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
		],
		'employeedb' => [
			'driver' => 'pgsql',
			'host' => env('DB2_HOST'),
			'port' => env('DB2_PORT'),
			'database' => env('DB2_DATABASE'),
			'username' => env('DB2_USERNAME'),
			'password' => env('DB2_PASSWORD'),
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
		],
	],
	/*
	|--------------------------------------------------------------------------
	| Migration Repository Table
	|--------------------------------------------------------------------------
	|
	| This table keeps track of all the migrations that have already run for
	| your application. Using this information, we can determine which of
	| the migrations on disk haven't actually been run in the database.
	|
	*/
	'migrations' => 'migrations',
];